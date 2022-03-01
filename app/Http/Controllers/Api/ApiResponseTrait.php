<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait

{
    public function response($data=null,$msg=null,$status=null){
        $array=[
            'data'=>$data,
            'message'=>$msg,
            'status'=>$status,
        ];
        return response($array);
    }
}
