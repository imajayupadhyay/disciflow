<?php

namespace App\Services;

use App\Models\BudgetAlert;
use App\Models\Transaction;
use App\Models\Budget;
use App\Mail\BudgetAlertMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class BudgetAlertService
{
    /**
     * Check all active alerts and trigger if conditions are met
     */
    public function checkAllAlerts()
    {
        $alerts = BudgetAlert::where('is_active', true)
            ->with(['customer', 'budget.category', 'category'])
            ->get();

        foreach ($alerts as $alert) {
            $this->checkAndTriggerAlert($alert);
        }
    }

    /**
     * Check a specific alert and trigger if conditions are met
     */
    public function checkAndTriggerAlert(BudgetAlert $alert)
    {
        // Skip if alert was recently triggered based on frequency
        if (!$this->shouldCheckAlert($alert)) {
            return false;
        }

        $triggered = false;
        $currentValue = 0;
        $alertMessage = '';

        switch ($alert->alert_type) {
            case 'budget_exceeded':
                [$triggered, $currentValue, $alertMessage] = $this->checkBudgetExceeded($alert);
                break;

            case 'category_spending':
                [$triggered, $currentValue, $alertMessage] = $this->checkCategorySpending($alert);
                break;

            case 'daily_spending':
                [$triggered, $currentValue, $alertMessage] = $this->checkDailySpending($alert);
                break;

            case 'transaction_threshold':
                [$triggered, $currentValue, $alertMessage] = $this->checkTransactionThreshold($alert);
                break;
        }

        if ($triggered) {
            $this->triggerAlert($alert, $alertMessage, $currentValue);
            return true;
        }

        return false;
    }

    /**
     * Check if budget exceeded alert should trigger
     */
    protected function checkBudgetExceeded(BudgetAlert $alert)
    {
        if (!$alert->budget) {
            return [false, 0, ''];
        }

        $budget = $alert->budget;
        $spent = $budget->spent;
        $budgetAmount = $budget->amount;

        if ($alert->condition_type === 'percentage') {
            $percentage = ($spent / $budgetAmount) * 100;
            if ($percentage >= $alert->threshold_value) {
                $message = sprintf(
                    'Your "%s" budget has reached %.1f%% (%.2f of %.2f)',
                    $budget->category->name,
                    $percentage,
                    $spent,
                    $budgetAmount
                );
                return [true, $percentage, $message];
            }
        } else {
            if ($spent >= $alert->threshold_value) {
                $message = sprintf(
                    'Your "%s" budget spending has reached $%.2f',
                    $budget->category->name,
                    $spent
                );
                return [true, $spent, $message];
            }
        }

        return [false, 0, ''];
    }

    /**
     * Check if category spending alert should trigger
     */
    protected function checkCategorySpending(BudgetAlert $alert)
    {
        if (!$alert->category) {
            return [false, 0, ''];
        }

        $period = $this->getPeriodDates($alert->frequency);

        $spent = Transaction::where('customer_id', $alert->customer_id)
            ->where('category_id', $alert->category_id)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$period['start'], $period['end']])
            ->sum('amount');

        if ($spent >= $alert->threshold_value) {
            $message = sprintf(
                'Your "%s" category spending has reached $%.2f this %s',
                $alert->category->name,
                $spent,
                $alert->frequency
            );
            return [true, $spent, $message];
        }

        return [false, $spent, ''];
    }

    /**
     * Check if daily spending alert should trigger
     */
    protected function checkDailySpending(BudgetAlert $alert)
    {
        $today = Carbon::today();

        $spent = Transaction::where('customer_id', $alert->customer_id)
            ->where('type', 'expense')
            ->whereDate('transaction_date', $today)
            ->sum('amount');

        if ($spent >= $alert->threshold_value) {
            $message = sprintf(
                'Your total spending today has reached $%.2f',
                $spent
            );
            return [true, $spent, $message];
        }

        return [false, $spent, ''];
    }

    /**
     * Check if single transaction threshold alert should trigger
     */
    protected function checkTransactionThreshold(BudgetAlert $alert)
    {
        // This is checked when a transaction is created
        // This method is called from the transaction creation event
        return [false, 0, ''];
    }

    /**
     * Trigger an alert and send email if enabled
     */
    protected function triggerAlert(BudgetAlert $alert, string $message, $currentValue)
    {
        // Update alert status
        $alert->update([
            'is_triggered' => true,
            'last_triggered_at' => now()
        ]);

        // Send email if enabled
        if ($alert->send_email && $alert->customer && $alert->customer->email) {
            try {
                Mail::to($alert->customer->email)
                    ->send(new BudgetAlertMail($alert, $alert->customer, $message, $currentValue));
            } catch (\Exception $e) {
                \Log::error('Failed to send budget alert email: ' . $e->getMessage());
            }
        }
    }

    /**
     * Check if alert should be checked based on frequency and last trigger
     */
    protected function shouldCheckAlert(BudgetAlert $alert)
    {
        if (!$alert->last_triggered_at) {
            return true;
        }

        $lastTriggered = Carbon::parse($alert->last_triggered_at);
        $now = Carbon::now();

        switch ($alert->frequency) {
            case 'once':
                return false; // Never check again if already triggered

            case 'daily':
                return $lastTriggered->diffInDays($now) >= 1;

            case 'weekly':
                return $lastTriggered->diffInWeeks($now) >= 1;

            case 'monthly':
                return $lastTriggered->diffInMonths($now) >= 1;

            default:
                return true;
        }
    }

    /**
     * Get period start and end dates based on frequency
     */
    protected function getPeriodDates(string $frequency)
    {
        $now = Carbon::now();

        switch ($frequency) {
            case 'daily':
                return [
                    'start' => $now->copy()->startOfDay(),
                    'end' => $now->copy()->endOfDay()
                ];

            case 'weekly':
                return [
                    'start' => $now->copy()->startOfWeek(),
                    'end' => $now->copy()->endOfWeek()
                ];

            case 'monthly':
                return [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth()
                ];

            default:
                return [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth()
                ];
        }
    }

    /**
     * Check single transaction against transaction threshold alerts
     */
    public function checkTransactionAgainstAlerts($transaction)
    {
        $alerts = BudgetAlert::where('customer_id', $transaction->customer_id)
            ->where('alert_type', 'transaction_threshold')
            ->where('is_active', true)
            ->get();

        foreach ($alerts as $alert) {
            if ($transaction->amount >= $alert->threshold_value) {
                $message = sprintf(
                    'A transaction of $%.2f was recorded in "%s" category',
                    $transaction->amount,
                    $transaction->category->name ?? 'Unknown'
                );
                $this->triggerAlert($alert, $message, $transaction->amount);
            }
        }
    }
}
