<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'customer_id',
        'category_id',
        'type',
        'amount',
        'transaction_date',
        'description',
        'payment_method'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BudgetCategory::class, 'category_id');
    }
}
