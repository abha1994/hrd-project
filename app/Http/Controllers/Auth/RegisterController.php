<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Mail;
use App\Mail\RegisterForm;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo = '/auth/regiserThank';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        if($data['category_id']==3){
            return Validator::make($data, [
                'category_id' => ['required','not_in:0'],
                'CaptchaCode' => ['required','valid_captcha'],
                'institute_name' => ['required','string','min:5','max:99'],
                'pan' => ['required','regex:/[A-Za-z]{5}[0-9]{4}[A-Za-z]/'],
                'institute_reg_no' =>['required','max:30'],
                'institute_addres' => ['required'],
                'email_id' => ['required', 'string', 'email', 'max:45', 'unique:registration'],
                'pincode'=> ['required','numeric','min:6'],
                'state' => ['required','not_in:0'],
                'distric' => ['required','not_in:0'],
            
        ]);

        }else{

            return Validator::make($data, [
                'category_id' => ['required','not_in:0'],
                'CaptchaCode' => ['required','valid_captcha'],
                'gender' => ['required','not_in:4'],
                'dob' => ['required'],
                'first_name' =>['required','string','min:4','max:44'],
                'email_id' => ['required', 'string', 'email', 'max:45', 'unique:registration'],
                'mobile_no' => ['required', 'numeric', 'unique:registration'],
                'state' => ['required','not_in:0'],
                'distric' => ['required','not_in:0'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        }
        exit();
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
		$transactionResult = DB::transaction(function() use ($data) {
        $date = date('Y-m-d H:i:s');
        if($data['category_id']==3){
                   
            $candidatename = $data['institute_name'];//strtolower(substr($data['institute_name'],0,5));
            $email_id= $data['email_id'];
            ////dd($candidatename);

        }else if($data['category_id']==2){
                    
            $candidatename = $data['first_name'];//strtolower(substr($data['first_name'],0,5));
            $email_id= $data['email_id'];

        }else{
            $candidatename = $data['first_name'];//strtolower(substr($data['first_name'],0,5));
            $email_id= $data['email_id'];
        }
        $registrationData = array(
            'category_id' => $data['category_id'],
            'institute_name' =>$data['institute_name'],
            'pan'=>$data['pan'],
            'institute_reg_no'=>$data['institute_reg_no'],
            'institute_addres'=>$data['institute_addres'],
            'gender'=>$data['gender'],
            'dob'=> date('Y-m-d', strtotime($data['dob'])),
            'first_name'=>$data['first_name'],
            'middle_name'=>$data['middle_name'],
            'last_name'=>$data['last_name'],
            'email_id'=>$data['email_id'],
            'mobile_no'=>$data['mobile_no'],
            'countrycd' => '99',
            'statecd'=>$data['state'],
            'districtcd'=>$data['distric'],
            'gender'=>$data['gender'],
            'registration_date'=>$date,
            'pincode' => $data['pincode'],
            'email_varified' => 0
        );
         //dd($registrationData);
         DB::table('registration')->insert($registrationData); 
         //$id = DB::getPdo()->lastInsertId();
        $emailid =$data['email_id'];
        $candidatename = $candidatename;

        Mail::to($data['email_id'])->send(new RegisterForm($candidatename,$email_id));

        return view('auth.regiserThank',compact($emailid,$candidatename));

        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
		
		});
	   return $transactionResult;
    }
}
