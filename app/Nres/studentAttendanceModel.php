<?php

namespace App\Nres;

use Illuminate\Database\Eloquent\Model;

class studentAttendanceModel extends Model
{
   protected $table ='candidate_attendence';
   protected $primaryKey ='attendence_id';
   public $timestamps = false;
   protected $fillable = array('institute_id','student_id','scheme_code','month_atten','year_atten','working_days','holidays','present_days','absent_days','remarks','leave_approved_days','total_days');

}
