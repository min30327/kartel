<?php 
namespace App\Notifications;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerRegister extends Notification implements ShouldQueue
{
    use Queueable;
    public $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('【'. config('app.name') .'】会員登録の完了') 
            ->greeting( $this->customer->name . '様、ありがとうございます。') 
            ->line(config('app.name') . 'への会員登録が完了しました。')
            ->line('下記リンクからログインしてください。')
            ->action('ログイン', config('frontend.url').'/login');
    }
}