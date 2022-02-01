<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\Register;
use App\Notifications\Subscribe;
use App\Notifications\UnSubscribe;
use App\Notifications\OviceEmail;
use App\Notifications\OviceRegistered;

use App\Notifications\CustomPasswordReset; 
use App\Notifications\CustomPasswordResetComplete;

use App\Notifications\Client\VerifyEmail;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Cashier\Billable;

use Carbon\Carbon;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes , Billable;

    // use \Rutorika\Sortable\SortableTrait;
    // protected static $sortableField = 'order';

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'stripe_id',
        'card_brand',
        'card_last_four',
        'trial_ends_at',
        'discord_id',
        'joined_at',
        'ovice_email',
        'ovice_registered',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }    


    public function sendEmailUserRegister($user)
    {
        $this->notify(new Register($user,false));
    }

    public function sendEmailSubscribe($user)
    {
        $this->notify(new Subscribe($user,false));
    }


    public function sendEmailUnSubscribe($user)
    {
        $this->notify(new UnSubscribe($user,false));
    }

    public function sendEmailOviceEmail($user)
    {
        $this->notify(new OviceEmail($user,false));
    }

    public function sendEmailOviceRegistered($user)
    {
        $this->notify(new OviceRegistered($user));
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordReset($token));
    }

    public function sendPasswordResetCompleteNotification()
    {
        $this->notify(new CustomPasswordResetComplete());
    }



    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value)->timezone("Asia/Tokyo");
        return $date->format('Y年m月d日');
    }
    public function getUpdatedAtAttribute($value){
        $date = Carbon::parse($value)->timezone("Asia/Tokyo");
        return $date->format('Y/m/d H:i');
    }
}