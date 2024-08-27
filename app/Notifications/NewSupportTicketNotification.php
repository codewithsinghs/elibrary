<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSupportTicketNotification extends Notification
{
    use Queueable;

    protected $ticket;
    /**
     * Create a new notification instance.
     */
    public function __construct($ticket)
    {
        //
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            // ->line('The introduction to the notification.')
            // ->action('Notification Action', url('/'))
            // ->line('Thank you for using our application!');
            ->subject('New Support Ticket')
            ->line('A new support ticket has been submitted.')
            ->line('Category: ' . $this->ticket->category)
            ->line('Subject: ' . $this->ticket->subject)
            ->line('Ticket ID: ' . $this->ticket->ticket_id)
            ->action('View Ticket', route('admin.support.index'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }


    //     use App\Notifications\NewSupportTicketNotification;

    // $ticket->save();

    // // Notify admins about new ticket
    // Notification::route('mail', config('mail.admin_email'))
    //     ->notify(new NewSupportTicketNotification($ticket));
}
