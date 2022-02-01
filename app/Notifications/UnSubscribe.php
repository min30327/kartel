<?php 
namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UnSubscribe extends Notification implements ShouldQueue
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
                ->subject('【'. config('app.name') .'】KARTEL退会のご連絡') 
                ->greeting( 'KARTELからの退会がありました。') 
                ->line( $this->user->name . '様の退会を受け付けました。')
                ->line('下記リンクから確認してください。')
                ->action('管理画面へ', config('frontend.url').'/admin');
        }else{
            return (new MailMessage)
                ->subject('【'. config('app.name') .'】KARTEL退会完了のご連絡') 
                ->greeting( $this->user->name . '様、ありがとうございます。') 
                ->line('KARTELへの退会が完了しました。')
                ->line('またのご利用を心よりお待ち申し上げております。');
        }
    }
}