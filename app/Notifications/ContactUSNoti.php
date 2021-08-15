<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ContactUSNoti extends Notification
{
    use Queueable;
    
    private $contact_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact_id)
    {
        $this->contact_id = $contact_id;
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
        
        $name=$this->contact_id->Name;
        $email=$this->contact_id->Email;
        $phone=$this->contact_id->Phone;
        $message=$this->contact_id->Message;
      

        return (new MailMessage)
                    ->subject($email) 
                    ->greeting('Hello!')
                    ->line(new HtmlString('You have new message from: <strong>' . $name . '</strong>'))
                    ->line(new HtmlString('Email: <strong>' . $email . '</strong>'))
                    ->line(new HtmlString('Phone: <strong>' . $phone . '</strong>'))
                    ->line(new HtmlString('Message: <strong>' . $message . '</strong>'))
                    ->line('Thank you!');
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
