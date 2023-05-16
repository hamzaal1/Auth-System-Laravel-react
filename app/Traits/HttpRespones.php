<?php

namespace App\HttpRespones;

trait HttpRespones{
    protected function success($data=[],$message=null,$code=200){
        return response()->json([
            'data'=>$data,
            'message'=>$message,
            'status'=>$code
        ],$code);
    }

    protected function error($data=[],$message=null,$code){
        return response()->json([
            'data'=>$data,
            'message'=>$message,
            'status'=>$code
        ],$code);
    }
}

?>