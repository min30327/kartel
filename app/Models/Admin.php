<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\AdminPasswordReset; 
use App\Notifications\AdminPasswordResetComplete; 
use App\Notifications\AdminRegister;

use App\Notifications\Register;
use App\Notifications\Subscribe;
use App\Notifications\UnSubscribe;
use App\Notifications\OviceEmail;

use App\Notifications\Client\VerifyEmail;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Admin extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;


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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminPasswordReset($token));
    }

    public function sendPasswordResetCompleteNotification()
    {
        $this->notify(new AdminPasswordResetComplete());
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendEmailAdminRegister($admin)
    {
        $this->notify(new AdminRegister($admin));
    }

    public function sendEmailUserRegister($user)
    {
        $this->notify(new Register($user,true));
    }


    public function sendEmailSubscribe($user)
    {
        $this->notify(new Subscribe($user,true));
    }


    public function sendEmailUnSubscribe($user)
    {
        $this->notify(new UnSubscribe($user,true));
    }

    public function sendEmailOviceEmail($user)
    {
        $this->notify(new OviceEmail($user,true));
    }

    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value)->timezone("Asia/Tokyo");
        return $date->format('Y/m/d');
    }
    public function getUpdatedAtAttribute($value){
        $date = Carbon::parse($value)->timezone("Asia/Tokyo");
        return $date->format('Y/m/d H:i');
    }
}