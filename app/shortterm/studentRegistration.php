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
	'participant_status',
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
	'email_id',
	'upload_aadhar',
	'student_image',
   );

}
