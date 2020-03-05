<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPostNotify extends Notification
{
    use Queueable;
    protected $submit_properties;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($submit_properties)
    {
        $this->submit_properties=$submit_properties;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hellow Viwers')
                    ->subject($this->submit_properties->name)
                    ->line('New Post By'.$this->submit_properties->user->name)
                    ->action('Click here to view the News', route('product.show',$this->submit_properties->id))
                    ->line('Na Dekhle Chram Miss');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}