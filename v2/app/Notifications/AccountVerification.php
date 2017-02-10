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
			->greeting("Dear {$this->user->first_name},")			
			->line('Thank you for creating an account on SmartSchool !')
			->line("There's just one more step before you can have access to all SmartSchool resources: You need to activate your account.")
			->line('After you activate your account, you will have full access to SmartSchool resources. You will receive occasional email from SmartSchool about some information.')					
			->action('Activate your Account', config('app.url').'activate?email='.$this->user->email.'&verify_token='.$this->user->verify_token)
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
