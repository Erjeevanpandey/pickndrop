<?php
require "bootstrap.php";
use app\classes\User;
require_once "routes.php";
define('JWT_SECRET', 'RG2PdBQEHoxjKnX88OF65QHa2lkfRMOw');

// $user = User::Create([    'name' => "Jeevan Pandey",    'email' => "pandeyjeevan284@gmail.com",    'password' => password_hash("123456",PASSWORD_BCRYPT), ]);
// print_r($user->todo()->create([
//    'todo' => "Working with Eloquent Without PHP",
//    'category' => "eloquent",
//    'description' => "Testing the work using eloquent without laravel"
//    ]));

$route = new Route();
$route->route();
// $user = User::where('id',4)->first();
// echo "<pre>";
// foreach ($user->todo as $key => $todo) {
	
// print_r($todo->todo);
// }