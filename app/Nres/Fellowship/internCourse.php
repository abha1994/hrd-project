<?php

namespace App\Nres\fellowship;

use Illuminate\Database\Eloquent\Model;

class internCourse extends Model
{
	protected $table ='intern_course_details';
   protected $fillable = array('candidate_id','course_id','year_completion','marks_percentage','pass_status','institute','stream');
    public $timestamps = false;
}
