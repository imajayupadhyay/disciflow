<?php

namespace App\Console\Commands;

use App\Services\BudgetAlertService;
use Illuminate\Console\Command;

class CheckBudgetAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'budget:check-alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all active budget alerts and send notifications if triggered';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking budget alerts...');

        $alertService = new BudgetAlertService();
        $alertService->checkAllAlerts();

        $this->info('Budget alerts check completed!');

        return Command::SUCCESS;
    }
}
