<?php

namespace App\shortterm\Admin;

use Illuminate\Database\Eloquent\Model;

class nrestParticipants extends Model
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
   	'countrycd',
   	'statecd',
   	'districtcd',
    'category',
   	'aadhar',
   	'institute_id',
    'user_id',
   	'mobile',
	'upload_aadhar',
	'student_image',
   );

}
