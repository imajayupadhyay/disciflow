<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentMethod extends Model
{
    protected $fillable = [
        'customer_id',
        'name',
        'type',
        'color',
        'icon'
    ];

    /**
     * Get the customer that owns the payment method
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
