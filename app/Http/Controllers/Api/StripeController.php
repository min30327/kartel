<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Exceptions\HttpResponseException;
use \Stripe\Stripe;

class StripeController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:users');
    }
    // 課金を実行
    public function subscribe(Request $request) {

        if(!$request->user()->subscribed('default')) {

            $payment_method = $request->payment_method;
            
            $plan = config('stripe.plan');
            $request->user()->newSubscription('default', $plan)->create($payment_method);
            $request->user()->load('subscriptions');

            $admin = Admin::find( 1 );
            $admin->sendEmailSubscribe($request->user());
            if($request->user()){
                $request->user()->sendEmailSubscribe($request->user());
            }
        }

        return $this->status();

    }

    // 課金をキャンセル
    public function cancel(Request $request) {

        $request->user()
        ->subscription('default')
        ->cancel();

        $admin = Admin::find( 1 );
        $admin->sendEmailUnSubscribe($request->user());
        if($request->user()){
            $request->user()->sendEmailUnSubscribe($request->user());
        }
        return $this->status();

    }

    // キャンセルしたものをもとに戻す
    public function resume(Request $request) {

        $request->user()
        ->subscription('default')
        ->resume();


        $admin = Admin::find( 1 );
        $admin->sendEmailSubscribe($request->user());
        if($request->user()){
            $request->user()->sendEmailSubscribe($request->user());
        }
        
        return $this->status();

    }

    // // プランを変更する
    // public function change_plan(Request $request) {

    //     $plan = $request->plan;
    //     $request->user()
    //         ->subscription('default')
    //         ->swap($plan);
    //     return $this->status();

    // }

    // カードを変更する
    public function update_card(Request $request) {

        $payment_method = $request->payment_method;
        $request->user()
        ->updateDefaultPaymentMethod($payment_method);
        return $this->status();

    }

    // 課金状態を返す
    public function status() {

        $status = 'unsubscribed';
        $user = auth()->user();
        $details = [];
        if($user->subscribed('default')) { // 課金履歴あり

            if($user->subscription('default')->cancelled()) {  // キャンセル済み

                $status = 'cancelled';

            } else {    // 課金中

                $status = 'subscribed';

            }

            $subscription = $user->subscriptions->first(function($value){

                return ($value->name === 'default');

            })->only('ends_at', 'stripe_plan');
            
            $details = [
                'end_date' => ($subscription['ends_at']) ? $subscription['ends_at']->format('Y-m-d') : null,
                'plan' => \Arr::get(config('services.stripe.plans'), $subscription['stripe_plan']),
                'card_last_four' => $user->card_last_four
            ];

        }

        return [
            'status' => $status,
            'details' => $details
        ];

    }
    
}
