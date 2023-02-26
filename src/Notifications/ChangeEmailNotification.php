<?php

namespace Vxize\Lavx\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\URL;

class ChangeEmailNotification extends Notification
{
    use Queueable;

    public $email;  // user_id and new email address

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
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
        return 
            (new MailMessage)
                ->subject(__('lavx::email.verify_email_subject'))
                ->line(__('lavx::email.verify_email_click'))
                ->action(__('lavx::email.verify_email'), $this->makeEmailChangeLink())
                ->line(__('lavx::email.change_email_ignore'));
    }

    protected function makeEmailChangeLink()
    {
        return URL::temporarySignedRoute(
            'change_email_verify',
            now()->addMinutes(60),
            [
                'email' => $this->email,
            ]
        );
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
