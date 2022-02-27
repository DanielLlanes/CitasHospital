<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StaffResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
            $this->token = $token;
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
           ->greeting(\Lang::get('Dear'). ' '. ucfirst($notifiable->name))
           ->subject(str_replace('_', " ", config('app.name', 'Laravel')).' - ' .\Lang::get('Reset Password Notification'))
           ->line(\Lang::get('You are receiving this email because we received a password reset request for your account.'))
           ->action(\Lang::get('Admin Reset Password'), url(config('app.url').route('staff.password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
           ->line(\Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
           ->line(\Lang::get('If you did not request a password reset, no further action is required.'))
           ->salutation('Regards');
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
