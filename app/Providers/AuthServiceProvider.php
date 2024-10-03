<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
      VerifyEmail::toMailUsing(function (object $notifiable, string $url){
        return (new MailMessage)
          ->subject('Verifique sua conta!')
          ->greeting('Seja bem vindo!')
          ->line('Clique no botão abaixo para verificar sua conta e acessar o sistema.')
          ->action('Verificar sua conta', $url)
          ->salutation('Agradecimentos, ' . env('APP_NAME'));
      });
    }
}
