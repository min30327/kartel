<?php 
namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OviceEmail extends Notification implements ShouldQueue
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
                ->subject('【'. config('app.name') .'】oViceホワイトリスト登録のお願い') 
                ->greeting( 'oVice用メールアドレスの変更がありました。') 
                ->line( $this->user->name . '様のoVice用メールアドレスの変更がありました。')
                ->line( 'メールアドレス： ' .$this->user->ovice_email . 'のホワイトリスト登録をお願いします。')
                ->line('下記リンクから確認してください。')
                ->action('管理画面へ', config('frontend.url').'/admin');
        }else{
            return (new MailMessage)
                ->subject('【'. config('app.name') .'】oViceメールアドレスの変更完了') 
                ->greeting( 'oVice用メールアドレスの変更を受け付けました。') 
                ->line('ホワイトリスト登録完了までしばらくお待ち下さい。')
                ->action('ダッシュボードへ', config('frontend.url').'/dashboard');
        }
    }
}