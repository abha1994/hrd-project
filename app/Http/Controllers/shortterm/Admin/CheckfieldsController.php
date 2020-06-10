<?php

namespace App\Http\Controllers\Shortterm\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use DateTime,Session;
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Mail\Message;
use Validator,Redirect;

  class CheckfieldsController extends Controller
  {  
      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
      
      }

      /**
       *  Show the Upload Form List.
       *
       * @index
       */
      
       public function index(Request $request)  { 

    
               if(isset($request['user_id'])) {
                 
                 $logID=$request['user_id'];  
                      
                  }

                else {

                     $logID=Auth::id();    
                  
                     }

       $dvalue=DB::table('short_term_program')
          ->leftJoin('user_credential','user_credential.id','=','short_term_program.user_id')
          ->where('short_term_program.status_id','3')
          ->where('short_term_program.scheme_code','4')->get();


          $sdata= DB::table('short_term_program')->where('user_id',$logID)->get()->first();

           if(!empty($sdata))
           $data= DB::table('check_fields')
         ->where('short_term_id',$sdata->short_term_id)->get()->first();


          return view('backend.shortterm.Admin.checkfields.create',compact('data','dvalue'));
      }
    
    

   
    

        public function store(Request $request)
      {
               try {
                        $records = $request->all();
       
                       if(isset($records['checklist']) && $records['checklist']!= null) {
             
                            foreach ($records['checklist'] as $key=>$inf){  
                                 $arr[]=$inf; 
                            }

                            $dec=json_encode($arr);
                    }

                     
                      $user_id = Auth::user()->id;

                      $shortterm_user=$records['officerid'];

      
                     $recrd= DB::table('short_term_program')
                     ->where('user_id',$shortterm_user)->get()->first();

                                  
                     if(!empty($recrd)) {

                           $records1['short_term_id']=$recrd->short_term_id;
        
                         }

                          else {

                                 return redirect()
                                ->route('report-check.index',['user_id' => $shortterm_user])
                                ->with('success','SHORTTERM ID DO NOT EXIST');       
                               } 

    


           
            if(isset($dec)) { 

            $records1['value']=$dec;
             
            }
             
             else {

                   DB::table('check_fields')
                   ->where('short_term_id',$records1['short_term_id'])->delete();

                       return redirect()
                       ->route('report-check.index',['user_id' => $shortterm_user])
                      ->with('success','Records Deleted');                                                            
             }
            
   
            $records1['officer_id']=$user_id;     // if officer id logged user
       
            
      
            $records1['created_date']=date("Y-m-d h:i:s");
       
          
      if(isset($records['update']) && $records['update']==1 && $records1['officer_id']==$user_id) {

         DB::table('check_fields')
         ->where('short_term_id',$records1['short_term_id'])->update($records1);
      }

      else {

      DB::table('check_fields')->insert($records1);  
     
        }
      
        if(isset($shortterm_user) && !empty($shortterm_user)) {

           return redirect()
            ->route('report-check.index',['user_id' => $shortterm_user])
           ->with('success','Records Updated');

         }

         else {

            return redirect()
            ->route('report-check.index')
           ->with('success','Records Updated');

         }
    }
    catch(\Illuminate\Database\QueryException $ex) {
       dd('Message', $ex->getMessage());
    }

        
      }

    
   }
