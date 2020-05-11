<?php

namespace App\Nref\admin;

use Illuminate\Database\Eloquent\Model;

class pfms_detail extends Model
{
    protected $table = 'pfms_details';
    protected $fillable = array('institute_id','student_id','full_name','gender','address_1','mobile_no','countrycd','statecd','districtcd','bank_name','ifsc_code','account_no','aadhar_no','pin_code');
}
