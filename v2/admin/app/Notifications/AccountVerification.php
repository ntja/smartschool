<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountVerification extends Notification
{
    use Queueable;

	private $user;
	
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
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
        return (new MailMessage)
			->subject('Account Verification')
			->greeting("Hello {$this->user->first_name},")			
			->line("Thank you for joining ! We're glad to have you as a community member and we're stocked for you to start exploring our resources.")
			->line('All you need to do is activate your account.')					
			->action('Activate your Account', config('app.url').'activate?email='.$this->user->email.'&verify_token='.$this->user->verify_token)
			->line('You will receive occasional emails from SmartSchool.')
			->line('We hope you will enjoy using SmartSchool !');					
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
            
        ];
    }
}
