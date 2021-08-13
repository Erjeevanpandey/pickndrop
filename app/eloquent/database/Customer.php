<?php
require "../../../bootstrap.php";
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('customers', function ($table) {
       $table->increments('id');
       $table->string('full_name');
       $table->string('email')->unique();
       $table->string('address');
       $table->string('customerimage')->nullable();
       $table->string('latitude');
       $table->string('longitude');
        $table->integer('user_id')->unsigned();
       $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
       $table->rememberToken();
       $table->timestamps();
   });