<?php

namespace App\Nres;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
     protected $table = 'bankdetails';
     protected $fillable = array(
     	'student_id','institute_id','bank_cname','registration_candidate_id','scheme_code','bank_name','branch_name','account_number','rtgs','neft','ifsc_code','micr_code','pan','aadhar_no','account_type','bank_phone_number','bank_mobile','bank_email' ,'bank_phone'

     );
}
