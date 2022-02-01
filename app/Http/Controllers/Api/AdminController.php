<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminController extends Controller
{
    
    public function __construct() 
    {
        $this->middleware('auth:users', ['except' => ['index','show']]);
    }

    public function index(Request $request)
    {
    
        $page = $request->get('page');
        $order = $request->get('order');
        $trashed = ($request->get('trashed')) ? (int) $request->get('trashed') : false ;
        $limit = ($request->get('limit')) ? (int) $request->get('limit') : 30;
        $display = $request->get('display') ? $request->get('display') : false;

        $get = $request->get('get') ? $request->get('get') : false;
        
        $query = User::query();
        $query->orderBy("order");
        if($trashed){
            $query->onlyTrashed();
        }
        if($display){
            $query->where("display" ,"0");
        }
        if($get == 'all'){
            $users = $query->get();
        }else{
            $users = $query->paginate($limit);
        }

        

        if($get == 'all'){
            $users = $query->get();
        }
        foreach($users as $user){
            $user->links = json_decode( $user->links, 1 );
            $user->display = (int) $user->display;
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

    public function update(UsersRequest $request, $id)
    {
 
        $user = User::find($id);
        $user->fill($request->all())->save();
        
        $user = User::find($id);
        $user->links = json_decode( $user->links, 1 );
        return $this->sendResponse( "OK" , $user, "プロフィールを更新しました。");

    }


    

    public function order(Request $request , $id){
        $method = $request->get('method');
        $neighbor = $request->get('neighbor');

        $user = User::find($id);
        $positionEntity = User::find($neighbor);

        if(!$user||!$positionEntity){
            
            $this->sendResponse( 'NG' , [] , '並び替えに失敗しました。');
        }
        if($method=="before"){
            $user->moveBefore($positionEntity);
        }elseif($method=="after"){
            $user->moveAfter($positionEntity);
        }

        $user = User::find($id);
        $user->links = json_decode( $user->links, 1 );
        return $this->sendResponse("OK" , $user , "ユーザーを並び替えました。");
    }

    public function softDelete(Request $request,$id){
        if($id == 1){
            $this->sendResponse( 'NG' , [] , 'このユーザーは削除できません。');
        }
        $user = User::find($id);
        $user->delete();
        return $this->sendResponse("OK" , [] , "ユーザーを削除しました。");
    }
    
    public function destroy(Request $request,$id){
        if($id == 1){
            
            $this->sendResponse( 'NG' , [] , 'このユーザーは削除できません。');
        }
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return $this->sendResponse("OK" , [] , "ユーザーを完全に削除しました。");
    }

    public function restore(Request $request,$id){
        if($id == 1){
            $this->sendResponse( 'NG' , [] , 'このユーザーは削除できません。');
        }
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return $this->sendResponse("OK" , [] , "ユーザーを復元しました。");
    }

    
}
