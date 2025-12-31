<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudgetCategory extends Model
{
    protected $fillable = [
        'customer_id',
        'name',
        'type',
        'icon',
        'color'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'category_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'category_id');
    }
}
