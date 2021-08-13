<?php
namespace app\api;
use app\classes\User as Model;
use \Firebase\JWT\JWT;

class UserController
{
  public function login(){
    // print_r($_POST);

  	 $email = $_POST['email'];  
     $password = $_POST['password'];  

     // print_r($password);
        //to prevent from mysqli injection  
      	$user = Model::where('email',$email)->first();
        // print_r($user);
      	if ($user) {
          $db_password = $user->password;
          $userId = $user->id;
          if(password_verify($password,$db_password)){
            // $bytes = random_bytes(20);
            // $api= (bin2hex($bytes));
            // print_r($api);
            $secret_key = JWT_SECRET;
            $issuer_claim = "pickndrop.com.np"; // this can be the servername
            $audience_claim = "THE_AUDIENCE";
            $issuedat_claim = time(); // issued at
            $notbefore_claim = $issuedat_claim + 10; //not before in seconds
            $expire_claim = $issuedat_claim + 3600; // expire time in seconds
            $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email
        ));
            $jwt = JWT::encode($token, $secret_key);
            // Model::where('id',$userId)->update(['api_key'=>$api]);
            // $user = Model::where('id',$userId)->first();
      		print_r(json_encode(['status'=>'success','data'=>$user,'token'=>$jwt,"expireAt" => $expire_claim]));
          die;
          }else{
          print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Invalid email or password']));
          die;
          }
      	}else{
      		print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Invalid email or password']));
          die;

      	}
  }
 }