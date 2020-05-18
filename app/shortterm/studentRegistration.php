<?php

namespace App\shortterm;

use Illuminate\Database\Eloquent\Model;

class studentRegistration extends Model
{
   protected $table ='studentregistrations';
   protected $primaryKey ='id';
   public $timestamps = false;
   protected $fillable = array(
   	'firstname',
    'middlename',
    'lastname',
   	'gender',
   	'address',
   	'dob',
   	'pincode',
   	'country',
   	'state',
   	'distric',
    'category',
   	'aadhar',
   	'institute_id',
    'user_id',
   	'mobile',
	'upload_aadhar',
	'student_image',
   );

}
