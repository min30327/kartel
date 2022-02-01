<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Cookie;

class DiscordController extends Controller
{
    
    public function __construct() {

        $this->api_base = config('discord.api_base');
        $this->guild_id = config('discord.guild_id');
        $this->access_token = config('discord.access_token');
        $this->client_id = config('discord.client_id');
        $this->client_secret = config('discord.client_secret');
        $this->redirect_url = config('discord.redirect_url');
    }

    public function auth(Request $request ){
        $response = [];
        
        if(!array_key_exists('auth__token_User',$_COOKIE)){
            return redirect('/login');
        }
        if($_COOKIE['auth__token_User']=='false'){
            return redirect('/login');  
        }

        $client_id = $this->client_id;
        $redirect_url = $this->redirect_url;

        $auth_url = '/oauth2/authorize';
        $params = "?client_id=${client_id}&redirect_uri=${redirect_url}&response_type=code&scope=guilds.join+identify";

        $url = $this->api_base . $auth_url .$params;
        
        header('Location: ' . $url);
        exit;
    }

    /**
     * Discord guild に joinさせるメソッド
     * Cookie内のauth__token_Userがなければログイン画面へリダイレクトさせる
     * oauth2でDiscordのaccess_tokenを取得し、それを元にuser_idを取得。
     * user_idとguilds_idを元にguildに追加する。
     */
    public function join(Request $request){

        if(!array_key_exists('auth__token_User',$_COOKIE)){
            return redirect('/login');
        }
        if($_COOKIE['auth__token_User']=='false'){
            return redirect('/login');  
        }
        if($request->get('error')){
            return redirect('/login');  
        }
        $code = $request->get('code');
        if(!empty($code)){

            $auth_url = '/v6/oauth2/token';
            $url = $this->api_base . $auth_url;

            $headers = [
                'Content-Type:application/x-www-form-urlencoded'
            ];
            $body = http_build_query([
                "grant_type" => "authorization_code",
                "code" =>  $code,
                "client_id" => $this->client_id,
                "client_secret" => $this->client_secret,
                "redirect_uri" =>  $this->redirect_url,
                "scope" => "email identify"
            ]);
            $oauth_result = self::request($url, "POST", $body, $headers);
            
            if(array_key_exists("access_token",(array) $oauth_result)){
                $user_token = $oauth_result["access_token"];
                $token_result = self::_get_access_token($user_token);
                if(array_key_exists('auth__token_User',$_COOKIE)){
                    $headers = [
                        'Authorization: ' . $_COOKIE['auth__token_User']
                    ];
                    $url = config('app.url') .'/api/Users/me';
                    $auth_data = self::request($url, "GET", null , $headers);
                    if($auth_data){
                        $user = User::find($auth_data['id']);
                        if($user){
                            $user->discord_id = $token_result['id'];
                            $user->save();
                        }
                    }
                }
                if(array_key_exists("id",$token_result)){
                    $join_result = self::_guild_join($user_token,$token_result['id']);
                  
                    if(array_key_exists("joined_at", (array) $join_result)){
                        
                        if($auth_data){
                            $user = User::find($auth_data['id']);
                            if($user){
                                $user->joined_at = $join_result['joined_at'];
                                $user->save();
                                return redirect('/dashboard?joined='.$user->discord_id);
                            }
                        }
                    }
                }
            }
            return redirect('/dashboard');   
        }
    }

    public function kick(Request $request , $id){

        $user = User::find($id);
        if(!$user){
            return redirect('/dashboard');
        }
        if(!empty($user->discord_id)){
            $result = self::_guild_kick($user->discord_id);
 
            $user->joined_at = "";
            $user->discord_id = "";
            $user->save();
            return redirect('/dashboard?withdrawal='.$user->id);
        }

        return redirect('/dashboard');
    }
    private function _get_access_token($token){
        $headers = [
            "Content-Type: application/x-www-form-urlencoded",
            'Authorization: Bearer ' . $token
        ];
        $get_user_url = '/users/@me';
        $url = $this->api_base . $get_user_url;
        return self::request($url, "GET", null, $headers);
    }

    private function _guild_join($token,$user_id){
           
        $headers = [
            "Content-Type: application/json",
            'Authorization: Bot ' . $this->access_token
        ];
        $guild_id = $this->guild_id;

        $url = $this->api_base . "/guilds/${guild_id}/members/${user_id}";
        $body = json_encode([
            "access_token" => $token
        ]);
        return self::request($url, "PUT", $body, $headers);
    }

    private function _guild_kick($user_id){
           
        $headers = [
            "Content-Type: application/json",
            'Authorization: Bot ' . $this->access_token
        ];
        $guild_id = $this->guild_id;
        $url = $this->api_base . "/guilds/${guild_id}/members/${user_id}";
        
        return self::request($url, "DELETE", null , $headers);
    }

    private static function request($url, $method, $body, $headers) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        //Locationをたどる
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
        //最大何回リダイレクトをたどるか
        curl_setopt($curl,CURLOPT_MAXREDIRS,10);
        //リダイレクトの際にヘッダのRefererを自動的に追加させる
        curl_setopt($curl,CURLOPT_AUTOREFERER,true);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
     
        if (!empty($body)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        }
     
        $responseJsonText = curl_exec($curl);
        $body = json_decode($responseJsonText , true);
     
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl); // curlの処理終わり
     
        return $body;
    }
}
