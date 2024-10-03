<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUser extends Notification
{
    use Queueable;

    private $new_user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $new_user)
    {
      $this->new_user = $new_user;
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
        ->subject('Nova conta foi criada')
        ->greeting('Olá!')
        ->line('Um novo usuário se cadastrou com o seguinte email: ' . $this->new_user->email)
        ->action('Aprovar usuário', route('admin.users.approve', $this->new_user->id))
        ->salutation('Agradecimentos, ' . env('APP_NAME'));
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
