<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\UsersRequest;
use Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use \Stripe\Stripe;

class UsersController extends Controller
{
    
    public function __construct() 
    {
        $this->middleware('auth:users', ['except' => ['index','show','counts','ovice_register','ovice_unregister']]);
    }

    public function index(Request $request)
    {
    
        $page = $request->get('page');
        $limit = ($request->get('limit')) ? (int) $request->get('limit') : 10;
        
        $get = $request->get('get') ? $request->get('get') : false;
        

        $query = User::query();
        
        if($get == 'all'){
            $users = $query->get();
        }else{
            $users = $query->paginate($limit);
        }
            
        foreach ($users as $key => $user) {
            $user['status'] = '';
            if($user->subscribed('default')) { // 課金履歴あり

                if($user->subscription('default')->cancelled()) {  // キャンセル済み
    
                    $user['status'] = 'cancelled';
    
                } else {    // 課金中
    
                    $user['status'] = 'subscribed';
    
                }
            }
        }
        return $this->sendResponse( "OK" , $users );
    }

    public function show($id)
    {
        
        $user = User::find($id);
        if(!$user){
            
            return $this->sendResponse( "NG" , []);
        }
        $user->links = json_decode( $user->links, 1 );
        $user->display = (int) $user->display;
        return $this->sendResponse( "OK" , $user);
    }

    // public function store(Request $request)
    // {
    //     $validator = $this->validator($request->all());

    //     if ($validator->fails()) {
    //         $this->throwValidationException(
    //             $request, $validator
    //         );
    //     }

    //     $user = new User;
    //     $user->fill($request->all());
    //     $user->password = bcrypt($request->password);
    //     $user->save();
    
    //     return $this->sendResponse( User::with('avatar')->find($user->id) , "ユーザーを追加しました。");
    // }

    public function counts()
    {

        $query = User::query();
        $users = $query->get();
        $counts = [
            "member" => 0,
            "ovice_registered" => 0,
            "ovice_unregistered" => 0,
            "withdrawal" => 0,
        ];
        foreach ($users as $key => $user) {
            
            
            if($user->subscribed('default')) { // 課金履歴あり

                if($user->subscription('default')->cancelled()) {  // キャンセル済み
    
                    $counts['withdrawal'] ++;
    
                } else {    // 課金中
    
                    $counts['member'] ++;

                    if($user["ovice_registered"]!="") {
                        $counts['ovice_registered'] ++;
                    }else{
                        $counts['ovice_unregistered'] ++;
                    }
    
                }
            }
        }
        return $this->sendResponse( "OK" , $counts, "");
    }

    public function ovice_register(Request $request, $id)
    {

        $user = User::find($id);
        $user->ovice_registered = 1;
        $user->save();
        
        if($user){
            $user->sendEmailOviceRegistered($user);
        }
        return $this->sendResponse( "OK" , $user, "oVice登録情報を更新しました。");

    }

    public function ovice_unregister(Request $request, $id)
    {

        $user = User::find($id);
        $user->ovice_registered = "";
        $user->save();

        return $this->sendResponse( "OK" , $user, "oVice登録情報を更新しました。");

    }

    public function update(UsersRequest $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'ovice_email' => 'required|string|email|max:100',
        ]);

        if($validator->fails()){
            $response['data']    = [];
            $response['status']  = 'NG';
            $response['summary'] = '入力に誤りがあります。';
            $response['errors']  = $validator->errors()->toArray();

            throw new HttpResponseException(
                response()->json( $response, 422 )
            );
        } 
        
        $user = User::find($id);

        if($user->ovice_email != $request['ovice_email']){

            $admin = Admin::find( 1 );
            $admin->sendEmailOviceEmail($request->user());
            if($request->user()){
                $request->user()->sendEmailOviceEmail($request->user());
            }
            if($user->ovice_registered){
                $user->ovice_registered = "";
            } 
        }

        $user->fill($request->all())->save();
        
        return $this->sendResponse( "OK" , $user, "プロフィールを更新しました。");

    }

    

    // public function order(Request $request , $id){
    //     $method = $request->get('method');
    //     $neighbor = $request->get('neighbor');

    //     $user = User::find($id);
    //     $positionEntity = User::find($neighbor);

    //     if(!$user||!$positionEntity){
            
    //         $this->sendResponse( 'NG' , [] , '並び替えに失敗しました。');
    //     }
    //     if($method=="before"){
    //         $user->moveBefore($positionEntity);
    //     }elseif($method=="after"){
    //         $user->moveAfter($positionEntity);
    //     }

    //     $user = User::find($id);
    //     $user->links = json_decode( $user->links, 1 );
    //     return $this->sendResponse("OK" , $user , "ユーザーを並び替えました。");
    // }

    // public function softDelete(Request $request,$id){
    //     if($id == 1){
    //         $this->sendResponse( 'NG' , [] , 'このユーザーは削除できません。');
    //     }
    //     $user = User::find($id);
    //     $user->delete();
    //     return $this->sendResponse("OK" , [] , "ユーザーを削除しました。");
    // }
    
    // public function destroy(Request $request,$id){
    //     if($id == 1){
            
    //         $this->sendResponse( 'NG' , [] , 'このユーザーは削除できません。');
    //     }
    //     $user = User::onlyTrashed()->find($id);
    //     $user->forceDelete();
    //     return $this->sendResponse("OK" , [] , "ユーザーを完全に削除しました。");
    // }

    // public function restore(Request $request,$id){
    //     if($id == 1){
    //         $this->sendResponse( 'NG' , [] , 'このユーザーは削除できません。');
    //     }
    //     $user = User::onlyTrashed()->find($id);
    //     $user->restore();
    //     return $this->sendResponse("OK" , [] , "ユーザーを復元しました。");
    // }

    
}
