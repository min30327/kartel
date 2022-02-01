<?php 
namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Subscribe extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;
    public $isAdmin;

    public function __construct($user,$isAdmin)
    {
        $this->user = $user;
        $this->isAdmin = $isAdmin;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        if($this->isAdmin){
            return (new MailMessage)
                ->subject('【'. config('app.name') .'】KARTEL入会完了のご連絡') 
                ->greeting( 'KARTELに登録がありました。') 
                ->line( $this->user->name . '様の入会が完了しました。')
                ->line('下記リンクから確認してください。')
                ->action('管理画面へ', config('frontend.url').'/admin');
        }else{
            return (new MailMessage)
                ->subject('【'. config('app.name') .'】KARTEL入会完了のご連絡') 
                ->greeting( $this->user->name . '様、ありがとうございます。') 
                ->line('KARTELへの入会が完了しました。')
                ->line('下記リンクから各サービスへ参加してください。')
                ->action('ダッシュボードへ', config('frontend.url').'/dashboard');
        }
    }
}