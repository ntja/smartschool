<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user){
        $this->user = $user;
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
        //var_dump($notifiable);die();
        $url = url("/accounts/verify?email={$this->user->email}&verify_token={$this->user->token}");
        return(new MailMessage)
            ->greeting('Hello! '.$this->user->first_name.' '.$this->user->last_name.',' )
            ->line('Please verify your email address so we know that it really you !' )
            ->action('Verify my email', $url )
            ->line('Thank you for using SmartSchool!');

        //return (new MailMessage)
          //          ->line('The introduction to the notification.')
            //        ->action('Notification Action', 'https://laravel.com')
              //      ->line('Thank you for using our application!');
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
