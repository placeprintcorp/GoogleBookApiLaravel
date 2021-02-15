<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userbooklist;

class SiteController extends Controller
{
  

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data=[];
    	  $headers = array(
    		'Accept: application/json',
    		'Content-Type: application/json',
			);
    	$url="https://www.googleapis.com/books/v1/volumes?q=flowers&key=AIzaSyCKby3QWs1pKt0wQnpWD-VJXuFccOAoQf4";
   		$ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $response = curl_exec($ch);
      $satusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

     // echo '<pre>';print_r(json_decode($response, true));echo'</pre>';die;
      
      
      $err = curl_error($ch);

      curl_close($ch);

      if ($err) {
       $data['error']= "Error #:" . $err;
      } else {
        $data['result']= json_decode($response,true);
      }
      if(isset(auth()->user()->id)){
           $data['userlist']=Userbooklist::where('user_id',auth()->user()->id)->orderby('sort','ASC')->get(); 	
      }


    	return view('index',$data);

   	} 	

   	     /**
     * Add book in personal list.
     *
     * @return \Illuminate\Http\Response
     */
    public function addbook(Request $request)
    {
    	$res='';
    	if(!empty($request->user_id)){
    		$count=Userbooklist::where('user_id',$request->user_id)->count();
    		
    		$request->merge([ 'sort' => $count]);
    		$get=Userbooklist::where('book_id',$request->book_id)->where('user_id',$request->user_id)->first();
    		if(!empty($get)){
    		$res='3A';
    		$arr=explode(',',$request->order);
    		$j=0;
       
        $ids=[];
        foreach ($arr as $value) {
        $get=Userbooklist::where('user_id',$request->user_id)->where('sort',$value)->first();
        if(!empty($get)){
         $ids[]=$get->id; 
        }
        
        }
        if(!empty($ids)){
    		foreach ($ids as $val) {
        Userbooklist::where('id',$val)->update(['sort'=>$j]); 
     
          $j++;         
        }
      }
        
    		}else{
    			
    		$resp=Userbooklist::create($request->all());
    		$arr=explode(',',$request->order);
    		$i=0;
    		$ids=[];
        foreach ($arr as $value) {
          if(!empty($get)){
         $ids[]=$get->id; 
        }
        
        }
        if(!empty($ids)){
        foreach ($ids as $val) {
        Userbooklist::where('id',$val)->update(['sort'=>$i]); 
     
          $i++;         
        }
      }
    		
    		$res=[$resp->id,$count];	
    		}


    	}else{
    	$res='2A';	
    	}
    	return $res;
   	} 


    /**
     * Delete a user list of the item.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletebook(Request $request)
    {

      if(!empty($request->id)){
        Userbooklist::where('id',$request->id)->delete();
       return true; 
      }
    }

         /**
     * Sort book list.
     *
     * @return \Illuminate\Http\Response
     */
    public function sortbook(Request $request)
    {
      $data='';
        $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
      );
      if(!empty($request->sort)){
      $url="https://www.googleapis.com/books/v1/volumes?q=flowers&orderBy=$request->sort&key=AIzaSyCKby3QWs1pKt0wQnpWD-VJXuFccOAoQf4";
      }else{
      $url="https://www.googleapis.com/books/v1/volumes?q=flowers&key=AIzaSyCKby3QWs1pKt0wQnpWD-VJXuFccOAoQf4";
      }
      
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $response = curl_exec($ch);
      $satusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

     //echo '<pre>';print_r(json_decode($response, true));echo'</pre>';die;
      
      
      $err = curl_error($ch);

      curl_close($ch);

      if ($err) {
       $data= '';
      } else {
        $data= json_decode($response,true);
      }
      $html="";
        $author= '';
        $subtitle='';
         $amount='';
           $ava='';
           $previewLink='';
      if(!empty($data)){
        foreach ($data['items'] as $item) {
          $image='';
          if(isset($item['volumeInfo']['imageLinks']['thumbnail'])){ 
            $image= $item['volumeInfo']['imageLinks']['thumbnail'];
           }
           if(isset($item['volumeInfo']['subtitle'])){
            $subtitle= $item['volumeInfo']['subtitle']; 
          }
          if(isset($item['volumeInfo']['authors'])){ 
            $author= implode(',',$item['volumeInfo']['authors']); 
          }
          if(isset($item['saleInfo']['listPrice'])){ 
            $amount= $item['saleInfo']['listPrice']['amount'];
            }else{ 
            $amount= $item['saleInfo']['saleability'];
            }

            if(isset($item['accessInfo']['epub']['isAvailable']) && $item['accessInfo']['epub']['isAvailable']==1){
             $ava= 'Yes'; 
           }else{ 
             $ava= 'No';
             }
            if(isset($item['volumeInfo']['previewLink'])){ 
              $previewLink=$item['volumeInfo']['previewLink']; 
            }
          $html.='<div class="col-md-3 mb-2 listitems"  book="'.$item['id'].'" id="">
                                            <a href="#" id="" class="close2"></a>
                                            <input type="hidden" value="'.htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8').'"/>
                                            <div class="card p-2" >
                                                <img style="height:30vh; padding: 10px;"src="'.$image.'">

                                                <h6 class="tube-title p-2"><a href="#" onclick="showModal(\'' . $item['id'] . '\')">'.substr($item['volumeInfo']['title'],0,20).'</a></h6>
                                                 
                                                 


                                                   <div class="modal-mask" id="'.$item['id'].'" style="display: none;"><div class="modal-wrapper"><div role="document" class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" data-dismiss="modal" aria-label="Close" class="close" onclick="hideModal(\'' . $item['id'] . '\')"><span aria-hidden="true">×</span></button></div> <div class="modal-body"><center><img src="'.$image.'" style="height: 40vh; padding: 10px;"></center> <h3>'.$item['volumeInfo']['title'].'</h3> <p>'.$subtitle.'</p> <ul><li><b>Authors:</b> <span>'.$author.'</span></li> <li><b>Price:</b> <span> '.$amount.'  </span></li> <li><b>Availablity:</b> <span>'.$ava.' </span></li> <li><b>Preview Link:</b> <a onclick="window.open(this.href); return false;" href="'.$previewLink.'">Preview Link</a></li></ul></div></div></div></div></div>
                                            </div>

                                        </div>';
        }
      }

      return $html;

    } 
}
