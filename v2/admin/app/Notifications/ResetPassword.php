<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

	private $user, $secret;
	
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $secret)
    {
        $this->user = $user;
		$this->secret = $secret;
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
			->subject('Reset Password')
			->greeting("Hello {$this->user->first_name},")			
			->line('We heard you need a password reset. Click on the button below and you will be redirected to a secured page from which you can set a new password')
			->action('Reset Password', config('app.url').'reset-password?key='.$this->secret)
			->line('If you ignore this message, your password won\'t be changed.')
			->line('If you didn\'t try to reset your password let us know '.config('app.url').'contact-us');
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
