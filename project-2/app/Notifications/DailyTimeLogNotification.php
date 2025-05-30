<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DailyTimeLogNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $timeLog;

    /**
     * Create a new notification instance.
     */
    public function __construct($timeLog)
    {
        $this->timeLog = $timeLog;
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
            ->subject('Your time log is running over 8 hours')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You have a time log that has been running for more than 8 hours.')
            ->line('Project: ' . $this->timeLog->project->title)
            ->line('Start Time: ' . $this->timeLog->start_time->format('Y-m-d H:i'))
            ->action('Check Time Log', Route('time.log.index'))
            ->line('Please end the time log if it is completed.');
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
}
