<?php

namespace App\Notifications;

use App\Models\CareSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CareScheduleNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $careSchedule;

    public function __construct(CareSchedule $careSchedule)
    {
        $this->careSchedule = $careSchedule;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Plant Care Reminder')
            ->line("It's time to {$this->careSchedule->care_type} your {$this->careSchedule->plant->name}.")
            ->line("Last performed: {$this->careSchedule->last_performed_date->format('Y-m-d')}")
            ->line("Due date: {$this->careSchedule->next_due_date->format('Y-m-d')}")
            ->action('Mark as Done', url('/care-schedules/' . $this->careSchedule->id . '/complete'))
            ->line('Thank you for taking care of your plants!');
    }

    public function toDatabase($notifiable): DatabaseMessage
    {
        return new DatabaseMessage([
            'message' => "It's time to {$this->careSchedule->care_type} your {$this->careSchedule->plant->name}.",
            'care_schedule_id' => $this->careSchedule->id,
            'plant_id' => $this->careSchedule->plant_id,
            'care_type' => $this->careSchedule->care_type,
            'due_date' => $this->careSchedule->next_due_date->format('Y-m-d'),
        ]);
    }
}
