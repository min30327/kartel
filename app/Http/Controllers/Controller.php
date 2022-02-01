<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse( $status , $data , $summary = "" ){

        $response['status']  = $status;
        $response['summary'] = $summary;
        if($status == "OK"){
            $response['data']    = $data;
            return new JsonResponse( $response , 201 );
        }else if($status == "NG"){
            $response['errors'] = $data;
            throw new HttpResponseException(
                new JsonResponse( $response, 422 )
            );
        }else if($status == "NOT FOUND"){
            $response['errors'] = $data;
            throw new HttpResponseException(
                new JsonResponse( $response, 404 )
            );
        }
    }
}
