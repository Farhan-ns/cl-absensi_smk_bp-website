<?php

namespace App\Notifications;

use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveSubmitted extends Notification
{
    use Queueable;

    protected $leave;
    protected $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Leave $leave, string $message)
    {
        $this->leave = $leave;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'leave_id' => $this->leave->id,
            'message' => $this->message,
            'date' => now()->setTimezone('Asia/Jakarta')->format('d-m-Y'),
        ];
    }
}
