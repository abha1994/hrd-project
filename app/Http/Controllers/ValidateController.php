<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ValidateController extends Controller
{
    public function validateemail(Request $request){
        //echo 'amresh';
        $data = $request->email_id;
         
        if($data){
            $result =DB::table('registration')->where('email_id',$data)->count();

            if($result>0){
                return Response::json('Email id all ready exit in database');
            }else{
                return Response::json('<span style="color:green">Congratulation email id not exit in database</span>');   
            }
        }
      
    }
}
