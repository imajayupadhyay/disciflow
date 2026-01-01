<?php

namespace App\Mail;

use App\Models\BudgetAlert;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BudgetAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $alert;
    public $customer;
    public $alertMessage;
    public $currentValue;

    /**
     * Create a new message instance.
     */
    public function __construct(BudgetAlert $alert, Customer $customer, string $alertMessage, $currentValue = null)
    {
        $this->alert = $alert;
        $this->customer = $customer;
        $this->alertMessage = $alertMessage;
        $this->currentValue = $currentValue;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '⚠️ Budget Alert: ' . $this->alert->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.budget-alert',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
