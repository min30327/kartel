<?php 
namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Register extends Notification implements ShouldQueue
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
                ->subject('【'. config('app.name') .'】KARTELに登録がありました。') 
                ->greeting( 'KARTELに登録がありました。') 
                ->line( $this->user->name . '様の会員登録が完了しました。')
                ->line('下記リンクから確認してください。')
                ->action('管理画面へ', config('frontend.url').'/admin');
        }else{
            return (new MailMessage)
                ->subject('【'. config('app.name') .'】会員登録の完了') 
                ->greeting( $this->user->name . '様、ありがとうございます。') 
                ->line(config('app.name') . 'への会員登録が完了しました。')
                ->line('下記リンクからログインしてください。')
                ->action('ログイン', config('frontend.url').'/login');
        }
    }
}