<?php 
namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerPasswordReset extends Notification implements ShouldQueue
{
    use Queueable;
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('【'. config('app.name') .'】パスワードのリセット') 
            ->greeting('パスワードのリセット') 
            ->line('下記リンクをクリックして、パスワードをリセットしてください。')
            ->action('パスワードのリセット',
                config('frontend.url')  . '/admin' .config('frontend.reset_pass_url') . $this->token
            );
    }
}