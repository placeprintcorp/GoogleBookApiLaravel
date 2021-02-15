<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Userbooklist;
use Validator;

use App\Http\Controllers\Controller;
class SiteController extends Controller
{
      public function __construct()
    {
       
        $this->successStatus = 200;
        $this->successNoContant = 204;
        $this->errorStatus = 400;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userbookslist(Request $request)
    {
    $input = $request->all();
    $validator = Validator::make($input,[
            'user_id' => 'required',
      ]);
    if ($validator->passes()) {
       $userlist=Userbooklist::where('user_id',$request->user_id)->orderby('sort','ASC')->get();

       $data=[];  
        if(count($userlist)>0){

        foreach ($userlist as $key => $val) {

          $user_data['user_id'] = $val->user_id;
          $user_data['book_data'] = json_decode($val->book_data,true);
          $data[]=$user_data;
          }

          return response()->json(['success' => '1', 'data'=>$data],$this->successStatus); 
        }else{
          return response()->json(['error'=>'1','msg'=>'Data not found.' ],$this->errorStatus);
        }
  
    
      }else{

        return response()->json(['error' => '1', 'msg'=> $validator->errors()], $this->errorStatus);
      }


   	} 	

   	 
}
