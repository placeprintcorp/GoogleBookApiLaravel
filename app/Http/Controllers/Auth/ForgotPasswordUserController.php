<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Menu;
use App\Models\Banner;
use App\Models\Pages;
use App\Models\PageBlocks;
use App\Models\AssignBlocks;
use App\Models\PageMeta;
use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class ForgotPasswordUserController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;



     public function showLinkRequestForm()
    {
      $data=[];
     
 $data['page'] = Pages::where('slug', 'landing_page')->where('is_active', 1)->with(['page_blocks'=>function($query) {
            $query->where('is_active', 1)->with('assign_block')->orderBy('order')->get();
        }])->first();
 //print_r($data['page']->id);die;
 $data['page_meta']= PageMeta::where('page_id', $data['page']->id)->first();
  $data['settings']='';
  $setting=Settings::first();
  if(in_array($data['page']->id, json_decode($setting->page_id,true))){
   $data['settings']=$setting;  
  }
 
 $data['menu_items'] = $this->getMenu();
 return view('auth.passwords.email',$data);
    }

 protected function getMenu(){
  $sqlxx = Menu::where('status',0)->get(); 
$data=[];
  $key = [];
foreach($sqlxx->unique('parent_id') as $row) {
  if (!empty($row['parent_id'])) {
  $key[] =$row['parent_id'];
}
}
  Session()->put('key',$key);
  $this->generate_multilevel_menus($parent_id=null,$key);
  $data['menus'] = $this->generate_multilevel_menus($parent_id=null,$key); 
  $data['menus'] = str_replace('<ul class="submenu dropdown-menu"></ul>', '',$data['menus']);
  $sqlex = Menu::get();
 $data['menu'] = '';
foreach ($sqlex as $key => $row) {
$data['menu'] .= '<option value="'.$row['id'].'">'.$row['title'].'</option>';
}
return $data;
}

public function generate_multilevel_menus($parent_id=null)
{

$menu = '';
  $sql = '';
  if( is_null($parent_id) ){
$sql = Menu::where('parent_id',null)->where('status',0)->orderBy('sort', 'asc')->get();
  }
  else{
  $sql = Menu::where('parent_id',$parent_id)->where('status',0)->orderBy('sort', 'asc')->get();  

   }
   $i=0;
  foreach($sql as $key=> $row) {

$daff = Session()->get('key');
    if( $row['page'] ){ 
      if (in_array($row['id'],$daff))
          {
            $i++;
            if($row['parent_id']==null){
          $menu .= '<li class="nav-item dropdown" >
          <a class="nav-link dropdown-toggle" title="'.$row['atitle'].'" href="'.$row['page'].'" data-toggle="dropdown">'.$row['title'].'</a>';
        }else{
        $menu .= '<li><a class="dropdown-item" href="'.$row['page'].'">'.$row['title'].' &raquo</a>'; 
        }
          }else{
            if($row['parent_id']==null){
                      
              $listing = Menu::where('parent_id',$parent_id)->where('status',0)->orderBy('sort', 'asc')->get()->min('sort');
                if($listing == $row['sort']){

              $menu .= '<li class="nav-item" > <a class="nav-link" title="'.$row['atitle'].'" href="'.$row['page'].'"> '.$row['title'].' </a> </li>
              

              ';
            }else{
              
              $menu .= '<li class="nav-item"> <a class="nav-link" title="'.$row['atitle'].'" href="'.$row['page'].'"> '.$row['title'].' </a> </li>';
            }
        }else
        {

        if($i>=1){
        $menu .= '<li class=""><a class="dropdown-item" title="'.$row['atitle'].'" href="'.$row['page'].'">'.''.$row['title'].'</a>';
        }else{
          $menu .= '<li class=""><a class="dropdown-item" title="'.$row['atitle'].'" href="'.$row['page'].'">'.$row['title'].'</a>';
        }
          

        }
      }
  }
    else{
      $menu .= '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" title="'.$row['atitle'].'" href="'.$row['page'].'" data-toggle="dropdown">'.$row['title'].'</a>';
  }
  if($row['parent_id']==null){
    $menu .= '<ul class="dropdown-menu">'.$this->generate_multilevel_menus($row['id'],$parent_array=$daff).'</ul>';
  }else{
  $menu .= '<ul class="submenu dropdown-menu">'.$this->generate_multilevel_menus($row['id'],$parent_array=$daff).'</ul>'; 
  } 
    $menu .= '</li>'; 
  
    
  }
  return $menu;
}


public function send_link_forget_password(Request $request)
{

$this->validator($request->all())->validate();

$user = User::where('email',$request->email);

$token=md5(rand().time().$request->email);

if (!empty($user)) {
$user->update([
'forgot_password_token'=>$token,

]);








$url = url('passwordresetform',$token);

Mail::send('mail.password',['url'=>$url], function ($m) use ($request) {
$m->from('brstdev981@gamil.com', 'Freebettors');
$m->to($request->email, 'ForgotPassword')
->subject('Forgot Password');



});


return back()->with('success','Please Check Your E-mail');

}else{
return back()->with('error','Failed To send Reset Password Link .Try Again?');

}



}
protected function validator(array $data)
{
return Validator::make($data, [
'email' => 'required|email|max:255',
]);
}

public function passwordresetform($token)
{
  $data=[];
     
 $data['page'] = Pages::where('slug', 'landing_page')->where('is_active', 1)->with(['page_blocks'=>function($query) {
            $query->where('is_active', 1)->with('assign_block')->orderBy('order')->get();
        }])->first();
 //print_r($data['page']->id);die;
 $data['page_meta']= PageMeta::where('page_id', $data['page']->id)->first();
  $data['settings']='';
  $setting=Settings::first();
  if(in_array($data['page']->id, json_decode($setting->page_id,true))){
   $data['settings']=$setting;  
  }
 
 $data['menu_items'] = $this->getMenu();
   $data['token'] = $token;
$user = User::where('forgot_password_token',$token)->count();
if ($user>0) {

    return view('auth.passwords.reset',$data);

}else{

    return redirect('/login')->with('error','Password Reset Link Has Expired.');
}
}
public function submitforget(Request $request)
{ 

$this->validatorcc($request->all())->validate();

$user = User::where(['forgot_password_token'=>$request->token])->count();
if ($user>0) {

$datarest = User::where(['forgot_password_token'=>$request->token])->update([
    'password' => bcrypt($request->password),
    'forgot_password_token' => null,
]);



return redirect('/login')->with('success','Password Successfully Reset.');

}else{

   return redirect('/login')->with('error','Password Reset Link Has Expired.'); 
}
}
  protected function validatorcc(array $data)
    {
        return Validator::make($data, [
           // 'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }
}
