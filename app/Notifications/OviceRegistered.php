<?php 
namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OviceRegistered extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        
        return (new MailMessage)
            ->subject('【'. config('app.name') .'】oViceメールアドレスの登録完了のご連絡') 
            ->greeting( 'oViceホワイトリストの登録が完了いたしました。') 
            ->line( 'さっそくオフィスへ出社してみましょう。') 
            ->action('ダッシュボードへ', config('frontend.url').'/dashboard');
    
    }
}