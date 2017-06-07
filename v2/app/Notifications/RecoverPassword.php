<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Session;

class RecoverPassword extends Notification
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
        $user_language = Session::get('sm_applocale');
        if($user_language == 'fr'){
            return (new MailMessage)
			->subject('Mot de passe re-initialisé')
			->greeting("Chèr(e) {$this->user->first_name},")			
			->line('Vous avez re-initialisez votre mot de passe oublié. Veuillez vous connecter pour accéder à la plateforme')
			->action('Connexion', config('app.url').'login')
			->line('Trouvez du plaisir à apprendre avec SmartSchool !');
        }else {
            return (new MailMessage)
			->subject('Password Updated')
			->greeting("Dear {$this->user->first_name},")			
			->line('You\'ve just reset your forgotten password. Please login to continue using our Platform')
			->action('Login', config('app.url').'login')
			->line('We hope you enjoy using SmartSchool !');
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
