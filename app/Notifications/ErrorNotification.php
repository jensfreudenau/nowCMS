<?php

namespace App\Notifications;

use App\Exceptions\ImportException;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ErrorNotification extends Notification
{
    use Queueable;

    protected ImportException $exception;

    /**
     * Create a new notification instance.
     */
    public function __construct(ImportException $exception)
    {
        $this->exception = $exception;
        dump($this->exception);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Application Error Notification')
            ->line('An error occurred in your application:')
            ->line('Message: ' . $this->exception->getMessage())
            ->line('File: ' . $this->exception->getFile())
            ->line('Line: ' . $this->exception->getLine())
            ->line($this->exception->getTraceAsString())
            ->line('Please check your application logs for more details.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
