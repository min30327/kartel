<?php 
namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerPasswordResetComplete extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('【'. config('app.name') .'】パスワードのリセットが完了しました。') 
            ->greeting('パスワードリセットの完了') 
            ->line('パスワードをリセットしました。下記リンクよりログインしてください。')
            ->action('ログイン',
                config('frontend.url') . '/admin/login'
            );
    }
}