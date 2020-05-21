<?php

namespace App\Nref;

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
		'course_id',
		'gender',
		'address',
		'dob',
		'doj',
		'pincode',
		'course',
		'countrycd',
		'statecd',
		'districtcd',
		'experience',
		'candidate_declaration',
		'student_image',
		'commiteedocument',
		'category',
		'gate',
		'net',
		'gate_neet',
		'highest_qulification',
		'aadhar',
		'bankMandate',
		'publication',
		'institute_id',
		'user_id',
		'mobile',
		'email_id',
   );

}
