<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;
    /**
     * Create a new notification instance.
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
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
        $url = 'http://controle_tarefas.test/password/reset/'.$this->token.'?email='.$this->email;
        return (new MailMessage)
            ->subject(Lang::get('Atualização de Senha'))
            ->greeting(Lang::get('Olá '.$this->name.','))
            ->line(Lang::get('Você está recebendo este e-mail pois nós recebemos uma requisição para alterar a senha da sua conta.'))
            ->action(Lang::get('Click aqui para Alterar a Senha'), $url)
            ->line(Lang::get('O link de Alteração de senha irá expirar em :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Caso você não tenha solicitado essa alteração, nenhuma ação é necessária.'));
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
