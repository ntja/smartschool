<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Session;

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
         $user_language = Session::get('sm_applocale');
        if($user_language == 'fr'){
            return (new MailMessage)
			->subject('Re-initialisation du mot de passe')
			->greeting("Bonjour {$this->user->first_name},")			
			->line('Nous avons appris que vous avez besoin de re-initialiser votre mot de passe. Cliquez sur le bouton ci-dessous et vous serez redirigez sur une page sécurisé où vous pourez enregistrer un nouveau mot de passe')
			->action('Reset Password', config('app.url').'reset-password?key='.$this->secret)
			->line('Si vous ignorez ce message votre mot de passe ne sera pas re-initialisé.')
			->line('Si vous n \'avez pas essayé de re-initialiser votre mot de passe faites nous savoir '.config('app.url').'contact-us');
        }  else {
            return (new MailMessage)
			->subject('Reset Password')
			->greeting("Hello {$this->user->first_name},")			
			->line('We heard you need a password reset. Click on the button below and you will be redirected to a secured page from which you can set a new password')
			->action('Reset Password', config('app.url').'reset-password?key='.$this->secret)
			->line('If you ignore this message, your password won\'t be changed.')
			->line('If you didn\'t try to reset your password let us know '.config('app.url').'contact-us');
        }
        
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
