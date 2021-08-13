<?php
namespace app\api;
use \Firebase\JWT\JWT;

class AuthController
{
  public function auth(){
    

    try {

		$jwt = $_GET['token'] ?? '';
	// $arr = explode(" ", $authHeader);
  	// $jwt = $arr[1];
  		if($jwt){
        $decoded = JWT::decode($jwt, JWT_SECRET, array('HS256'));
        return $decode['data']['id'];
    	}else{
    		  http_response_code(401);

    echo json_encode(array(
        "message" => "Access denied.",
    ));
    die;
    	}
        // print_r($decoded);
        // die;
        // Access is granted. Add code of the operation here 

        // echo json_encode(array(
        //     "message" => "Access granted:",
        //     "error" => $e->getMessage()
        // ));

    }catch (Exception $e){

    http_response_code(401);

    echo json_encode(array(
        "message" => "Access denied.",
    ));
    die;
	}
}
}