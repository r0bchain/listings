<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase; 
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Bus\Queueable;
use App\Models\User;


class VerifyEmail extends VerifyEmailBase
{ 
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(         
        private User $user
        
    ){}

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
                    ->subject('Please Confirm Your Email Address')
                    ->greeting('Hello ' .$this->user->name. '!')
                    ->line('Thank you for registering. Please click the button below to verify your email address.')
                    ->action('Verify Email Address', $verificationUrl)
                    ->line('If you did not create an account, no further action is required.');
    }
}