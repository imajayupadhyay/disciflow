<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    protected $fillable = [
        'customer_id',
        'category_id',
        'amount',
        'period',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    protected $appends = ['spent', 'remaining', 'percentage'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BudgetCategory::class, 'category_id');
    }

    public function getSpentAttribute()
    {
        return Transaction::where('customer_id', $this->customer_id)
            ->where('category_id', $this->category_id)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$this->start_date, $this->end_date ?? now()])
            ->sum('amount');
    }

    public function getRemainingAttribute()
    {
        return max(0, $this->amount - $this->spent);
    }

    public function getPercentageAttribute()
    {
        if ($this->amount == 0) return 0;
        return ($this->spent / $this->amount) * 100;
    }
}
