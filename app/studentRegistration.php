<?php

namespace App;

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
   	'course',
   	'country',
   	'state',
   	'distric',
   	//'bankName',
   	//'accountNo',
   	//'ifscCode',
   	'gate_neet',
   	'highest_qulification',
   	'aadhar',
   	'bankMandate',
   	'publication',
   	'nref_id',
   	'mobile',
   	'email_id');

}
