<?php
namespace app\api;
use app\classes\Customer;
use app\api\AuthController;
class CustomerController
{
  public function __construct(){
     
      echo 'test';
      die;
  }
  public function index(){
    // print_r($_POST);

  	 
  }

  public function store(){
    try{
$userid =  AuthController::auth();
       $full_name = $_POST['full_name'];  
       $email = $_POST['email']; 
       $address=$_POST['address'];
       $latitude=$_POST['latitude'];
       $longitude=$_POST['longitude'];
       $custimer_insert=array();
       $customer_insert=array(
        'full_name'=>$full_name,
        'email'=>$email,
        'address'=>$address,
        'latitude'=>$latitude,
        'longitude'=>$longitude,
        'user_id'=>$userid
       );

        if ($data = Customer::insert($customer_insert)) {
                print_r(json_encode(['status'=>'success','data'=>$data]));
                die;
            }
        } catch (\Exception $e) {
            print_r(json_encode(['status'=>'error','data'=>[],'message'=>$e->getMessage()]));
            die;
        }

    }

    public function edit($id){
      try{
        $userid = AuthController::auth();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $post = Customer::where('id',$id)->first();
        if($userid != $post->user_id){
          print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unauthorized']));
           die;
        }
      $full_name = $_POST['full_name'];  
       $email = $_POST['email']; 
       $address=$_POST['address'];
       $latitude=$_POST['latitude'];
       $longitude=$_POST['longitude'];
       $customer_update=array();
        $customer_update=array(
        'full_name'=>$full_name,
        'email'=>$email,
        'address'=>$address,
        'latitude'=>$latitude,
        'longitude'=>$longitude,
        
       );

       if($id && Customer::where('id',$id)->update($customer_update) ){
         print_r(json_encode(['status'=>'success','message'=>'Successful']));
                die;
       }else{
           print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unable To Update']));
           die;
       }

      }

      }catch (\Exception $e) {
          print_r(json_encode(['status'=>'error','data'=>[],'message'=>$e->getMessage()]));
            die;

      }
    }

    public function delete($id){
      
      $userid =  AuthController::auth();
         if($id ){
          $post = Customer::where('id',$id)->first();
        if($userid != $post->user_id){
          print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unauthorized']));
           die;
        }
        if(Customer::where('id',$id)->delete()){

         print_r(json_encode(['status'=>'success','message'=>'Successful']));
                die;
        }else{
            print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unable To Delete']));
           die;

        }
       }else{
           print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unable To Delete']));
           die;
       }
        
      
    }

    public function distance() {
      $userid =  AuthController::auth();
      // print_r($_SERVER);
      $latitude=$_POST['latitude'];
      $longitude=$_POST['longitude'];
        $radius=0.5;
        $distance_cal=Customer::selectRaw("*,IFNULL(( 6371 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( latitude ) ) ) ),0) AS distance
      ")->having( 'distance', '<=', $radius)->orderBy('distance','ASC')->get();
         if($distance_cal ){
         print_r(json_encode(['status'=>'success', 'data'=>$distance_cal,'message'=>'Successful']));
                die;
       }else{
           print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unable']));
           die;
       }

      }

 }