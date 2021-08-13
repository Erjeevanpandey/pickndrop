<?php
namespace app\classes;

use app\classes\Todo;
use Illuminate\Database\Eloquent\Model as Eloquent;
class Customer extends Eloquent
{
   protected $fillable = [
       'full_name', 'email', 'address','latitude','longitude'
   ];
  
 }