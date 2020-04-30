<?php

namespace App\Nres\fellowship;

use Illuminate\Database\Eloquent\Model;

class fellowsolarreferences extends Model
{

    protected $fillable = array('fellowship_id','name_ref','email_ref','mobile_ref');
    public $timestamps = false;
}
