<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BudgetAlert extends Model
{
    protected $fillable = [
        'customer_id',
        'name',
        'alert_type',
        'budget_id',
        'category_id',
        'condition_type',
        'threshold_value',
        'condition_operator',
        'frequency',
        'is_active',
        'is_triggered',
        'last_triggered_at',
        'send_email'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_triggered' => 'boolean',
        'send_email' => 'boolean',
        'threshold_value' => 'decimal:2',
        'last_triggered_at' => 'datetime'
    ];

    /**
     * Get the customer that owns the alert
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the budget associated with the alert
     */
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    /**
     * Get the category associated with the alert
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BudgetCategory::class);
    }
}
