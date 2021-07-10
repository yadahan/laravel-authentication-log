<?php

namespace KeyShang\AuthenticationLog\Notifications;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use KeyShang\AuthenticationLog\AuthenticationLog;

class NewDevice extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The authentication log.
     */
    public AuthenticationLog $authenticationLog;

    /**
     * Create a new notification instance.
     *
     * @param AuthenticationLog $authenticationLog
     * @return void
     */
    public function __construct(AuthenticationLog $authenticationLog)
    {
        $this->authenticationLog = $authenticationLog;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        return $notifiable->notifyAuthenticationLogVia();
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @throws Exception
     */
    public function toMail($notifiable): MailMessage
    {
        /** @var Carbon $loginAt */
        $loginAt = $this->authenticationLog->login_at;
        $loginAt = $loginAt->setTimezone('UTC');
        $subject = trans('authentication-log::new_device.subject', ['app' => config('app.name')]);
        if (gettype($subject) !== 'string') {
            throw new Exception('Translate subject error');
        }

        return (new MailMessage)
            ->subject($subject)
            ->markdown('authentication-log::emails.new_device', [
                'account' => $notifiable,
                'loginAt' => $loginAt.' UTC',
                'ipAddress' => $this->authenticationLog->ip_address,
                'browser' => $this->authenticationLog->user_agent,
            ]);
    }
}
