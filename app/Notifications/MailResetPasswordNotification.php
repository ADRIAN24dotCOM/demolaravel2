<?php

namespace App\Notifications;
//namespace Illuminate\Auth\Passwords;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailResetPasswordNotification extends Notification
{
    use Queueable;
    protected $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
        //
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
    public function toMail( $notifiable ) {
        //$link = url( "/password/reset/?token=" . $this->token );
     
        return ( new MailMessage )
        //->view('reset.emailer')
           ->from('adrianph24@gmail.com')
           ->subject('Cambio de contraseña' )
           ->line( "Estimado usuario" )
           ->action( 'enlace para cambiar contraseña', url(config('app.url').route('password.reset', $this->token, false)) )
           //->attach('reset.attachment')
           ->line( 'gracias ' );
           

           /*
          ->subject(Lang::getFromJson('Reset Password Notification'))
          ->line(Lang::getFromJson('You are receiving this email because we received a password reset request for your account.'))
          ->action(Lang::getFromJson('Reset Password'), url(config('app.url').route('password.reset', $this->token, false)))
          ->line(Lang::getFromJson('If you did not request a password reset, no further action is required.'));
          */
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
