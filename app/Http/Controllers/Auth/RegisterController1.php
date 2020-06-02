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
        //dd($data['category_id']);
        //dd($data);
        if($data['category_id']==3){
            //dd($data);
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
                'distric' => ['required','not_in:Select'],           
            ]);

        }else if ($data['category_id']==4) {
          //  dd($data);
            return Validator::make($data, [
                'category_id' => ['required','not_in:0'],
                'CaptchaCode' => ['required','valid_captcha'],
                'ngo_name' => ['required','string','min:5','max:50'],
                'pan' => ['required','regex:/[A-Za-z]{5}[0-9]{4}[A-Za-z]/'],
            'uin_no' =>['required','regex:/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/'],
                //'gst_number' =>['required','max:30'],
                'ngo_address' => ['required'],
                'email_id' => ['required', 'string', 'email', 'max:45', 'unique:registration'],
                //'pin_code'=> ['required','numeric','min:6'],
                 'mobile_no' => ['required', 'numeric', 'unique:registration'],
                'state' => ['required','not_in:0'],
                'distric' => ['required','not_in:Select'],           
            ]);
            
        }else if ($data['category_id']==5) {
           // dd($data);
            return Validator::make($data, [
                'category_id' => ['required','not_in:0'],
                'CaptchaCode' => ['required','valid_captcha'],
                'company_name' => ['required','string','min:5','max:50'],
                //'pan' => ['required','regex:/[A-Za-z]{5}[0-9]{4}[A-Za-z]/'],
                'tin_number' =>['required','max:11'],
                'gst_number' =>['required','regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/'],
                'address' => ['required'],
                'email_id' => ['required', 'string', 'email', 'max:45', 'unique:registration'],
                'pin_code'=> ['required','numeric','min:6'],
                'mobile_no' => ['required', 'numeric', 'unique:registration'],
                'state' => ['required','not_in:0'],
                'distric' => ['required','not_in:Select'],           
            ]);
        }else{
           // dd($data);
            return Validator::make($data, [
                'category_id' => ['required','not_in:0'],
                'CaptchaCode' => ['required','valid_captcha'],
                'gender' => ['required','not_in:4'],
                'dob' => ['required'],
                'first_name' =>['required','string','min:4','max:44'],
                'email_id' => ['required', 'string', 'email', 'max:45', 'unique:registration'],
                'mobile_no' => ['required', 'numeric', 'unique:registration'],
                'state' => ['required','not_in:0'],
                'distric' => ['required','not_in:Select'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
        
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        //dd($data);
		$transactionResult = DB::transaction(function() use ($data) {
        $date = date('Y-m-d H:i:s');
        if($data['category_id']==3){
                   
            $candidatename = $data['institute_name'];//strtolower(substr($data['institute_name'],0,5));
            $email_id= $data['email_id'];
            $address = $data['address']; 
            ////dd($candidatename);

        }else if($data['category_id']==2){
                    
            $candidatename = $data['first_name'];//strtolower(substr($data['first_name'],0,5));
            $email_id= $data['email_id'];
             $address = $data['address'];

        }else if($data['category_id']==4){
                    
            $candidatename = $data['ngo_name'];//strtolower(substr($data['first_name'],0,5));
            $email_id= $data['email_id'];
             $address = $data['ngo_address'];

        }else if($data['category_id']==5){
                    
            $candidatename = $data['company_name'];//strtolower(substr($data['first_name'],0,5));
            $email_id= $data['email_id'];
            $address = $data['address'];

        }else{
            $candidatename = $data['first_name'];//strtolower(substr($data['first_name'],0,5));
            $email_id= $data['email_id'];
            $address = $data['address'];
        }
        $registrationData = array(
            'category_id' => $data['category_id'],
            'institute_name' =>$data['institute_name'],
            'pan'=>$data['pan'],
            'institute_reg_no'=>$data['institute_reg_no'],
            'institute_addres'=>$address,
            'gender'=>$data['gender'],
            'dob'=> date('Y-m-d', strtotime($data['dob'])),
            'first_name'=>$candidatename,
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
            'ngo_name' => $data['ngo_name'],

            //'company_name' => $data['company_name'],
            'tin_number' => $data['tin_number'],
            'gst_number' => $data['gst_number'],
            'email_varified' => 0
        );
         //dd($registrationData);
         DB::table('registration')->insert($registrationData); 
         //$id = DB::getPdo()->lastInsertId();
        $emailid =$data['email_id'];
        $candidatename = $candidatename;
        $category_id = $data['category_id'];
        Mail::to($data['email_id'])->send(new RegisterForm($candidatename,$email_id,$category_id));

        return view('auth.regiserThank',compact('emailid','candidatename'));

        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
		
		});
	   return $transactionResult;
    }
}
