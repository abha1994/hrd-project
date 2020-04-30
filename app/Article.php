<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table ='articles';
    protected $primaryKey ='id';
    protected $fillable = array('category_id','title','author','show_date','image','description','status','user_id','slug',
        'visit_count','aslug','subcategory_id');

    // public function category(){

    //    $this->hasMny('App\Article','category_id');
    // }
   

   public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

    public function user(){

        return $this->belongsTo('App\User','user_id');
    }

    
   
}
