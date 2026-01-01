<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    /**
     * Submit a support ticket
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|in:getting-started,account,technical,feature,other',
            'message' => 'required|string|max:5000',
        ]);

        // Get the authenticated customer if logged in
        $customer = Auth::guard('customer')->user();

        // Create the support ticket
        $ticket = SupportTicket::create([
            'customer_id' => $customer ? $customer->id : null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'new'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your support request has been submitted successfully! We\'ll get back to you soon.',
            'ticket' => [
                'id' => $ticket->id,
                'subject' => $ticket->subject_label,
                'status' => $ticket->status_label,
                'created_at' => $ticket->created_at->format('F d, Y h:i A')
            ]
        ], 201);
    }

    /**
     * Get all support tickets for the authenticated customer
     */
    public function getCustomerTickets()
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $tickets = SupportTicket::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($ticket) {
                return [
                    'id' => $ticket->id,
                    'name' => $ticket->name,
                    'email' => $ticket->email,
                    'subject' => $ticket->subject,
                    'subject_label' => $ticket->subject_label,
                    'message' => $ticket->message,
                    'status' => $ticket->status,
                    'status_label' => $ticket->status_label,
                    'admin_notes' => $ticket->admin_notes,
                    'created_at' => $ticket->created_at->format('F d, Y h:i A'),
                    'updated_at' => $ticket->updated_at->format('F d, Y h:i A')
                ];
            });

        return response()->json([
            'success' => true,
            'tickets' => $tickets
        ]);
    }

    /**
     * Get all support tickets (for admin)
     */
    public function getAllTickets()
    {
        // TODO: Add admin authentication check

        $tickets = SupportTicket::with('customer')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($ticket) {
                return [
                    'id' => $ticket->id,
                    'customer_name' => $ticket->customer ? $ticket->customer->name : null,
                    'name' => $ticket->name,
                    'email' => $ticket->email,
                    'subject' => $ticket->subject,
                    'subject_label' => $ticket->subject_label,
                    'message' => $ticket->message,
                    'status' => $ticket->status,
                    'status_label' => $ticket->status_label,
                    'admin_notes' => $ticket->admin_notes,
                    'created_at' => $ticket->created_at->format('F d, Y h:i A'),
                    'updated_at' => $ticket->updated_at->format('F d, Y h:i A')
                ];
            });

        return response()->json([
            'success' => true,
            'tickets' => $tickets
        ]);
    }

    /**
     * Update ticket status (for admin)
     */
    public function updateStatus(Request $request, $id)
    {
        // TODO: Add admin authentication check

        $validated = $request->validate([
            'status' => 'required|string|in:new,in_progress,resolved,closed',
            'admin_notes' => 'nullable|string|max:5000'
        ]);

        $ticket = SupportTicket::findOrFail($id);

        $ticket->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $ticket->admin_notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket updated successfully',
            'ticket' => [
                'id' => $ticket->id,
                'status' => $ticket->status,
                'status_label' => $ticket->status_label,
                'admin_notes' => $ticket->admin_notes
            ]
        ]);
    }
}
