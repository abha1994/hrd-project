<?php

namespace App\shortterm\Admin;

use Illuminate\Database\Eloquent\Model;

class nrestBankDetails extends Model
{
   protected $table ='bankdetails';
   protected $primaryKey ='id';
   public $timestamps = false;
   protected $fillable = array(
   'student_id',
   'institute_id',
   'registration_candidate_id',
   'scheme_code',
   'bank_name',
   'branch_name',
   'account_number',
   'rtgs',
   'neft',
   'ifsc_code',
   'micr_code',
   'pan',
   'aadhar_no',
   'account_type',
   'bank_mobile',
   'bank_email',
   'candidate_phone',
   'user_id',
   'participant_address',
   'bank_address',
   'pfms_code',
   );

}
