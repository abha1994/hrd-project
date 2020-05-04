<?php

namespace App\Nres\fellowship;

use Illuminate\Database\Eloquent\Model;

class education extends Model
{
	protected $table ='educations';
   protected $fillable = array('fellowship_id','courseid','institute','stream','passstatus','yearcompletion','markspercentage');
    public $timestamps = false;
}
