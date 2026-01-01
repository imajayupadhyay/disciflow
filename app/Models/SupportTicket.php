<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportTicket extends Model
{
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'subject',
        'message',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the customer that submitted the ticket
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the subject label for display
     */
    public function getSubjectLabelAttribute(): string
    {
        $labels = [
            'getting-started' => 'Getting Started',
            'account' => 'Account & Billing',
            'technical' => 'Technical Issue',
            'feature' => 'Feature Request',
            'other' => 'Other'
        ];

        return $labels[$this->subject] ?? ucfirst($this->subject);
    }

    /**
     * Get the status label for display
     */
    public function getStatusLabelAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }
}
