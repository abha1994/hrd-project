<?php

namespace App\Http\Controllers\Nref\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
class fincaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $data = DB::table('institute_details')
            ->select(
                'institute_details.institute_id',
                'institute_details.application_cd',
                'institute_details.user_id',
                'institute_details.department_name',
                'studentregistrations.id',
                'studentregistrations.firstname', 
                'studentregistrations.middlename',
                'studentregistrations.lastname',
                'studentregistrations.mobile',
                'studentregistrations.email_id',
                'fellow_amount.amount',
                'courses.course_name',
                'bankdetails.bank_name',
                'bankdetails.branch_name',
                'bankdetails.account_number'

            )
            ->join('studentregistrations','institute_details.institute_id','=','studentregistrations.institute_id')
            ->join('fellow_amount','studentregistrations.course','=','fellow_amount.course_id')
            ->join('courses','courses.course_id','=','fellow_amount.course_id')
            ->join('candidate_attendence','candidate_attendence.student_id','=','studentregistrations.id')
            ->join('bankdetails','bankdetails.institute_id','=','studentregistrations.institute_id')
            ->where([ 'studentregistrations.pms_process' => '0','studentregistrations.status_id' => '1','candidate_attendence.isfilesubmit'=>'1'])
            ->get();

            return view('backend.nref.Admin.payment.index',compact('data'));
          
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
         DB::table('studentregistrations')
        ->where('id', $id)         
        ->update(array('pms_process' => 1));

        $data = DB::table('institute_details')
            ->select(
                'institute_details.institute_id',
                'institute_details.application_cd',
                'institute_details.user_id',
                'institute_details.department_name',                
                'studentregistrations.id',
                'studentregistrations.firstname', 
                'studentregistrations.middlename',
                'studentregistrations.lastname',
                'studentregistrations.gender',
                'studentregistrations.address',
                'studentregistrations.aadhar',
                'studentregistrations.pincode',                
                'studentregistrations.mobile',
                'studentregistrations.country',
                'studentregistrations.state',
                'studentregistrations.distric',
                'fellow_amount.amount',
                'courses.course_name',
                'bankdetails.bank_name',
                'bankdetails.ifsc_code',
                'bankdetails.account_number',
                'bankdetails.aadhar_no'
            )
            ->join('studentregistrations','institute_details.institute_id','=','studentregistrations.institute_id')
            ->join('fellow_amount','studentregistrations.course','=','fellow_amount.course_id')
            ->join('courses','courses.course_id','=','fellow_amount.course_id')
            ->join('candidate_attendence','candidate_attendence.student_id','=','studentregistrations.id')
            ->join('bankdetails','bankdetails.institute_id','=','studentregistrations.institute_id')
            ->where([ 'studentregistrations.pms_process' => '1','studentregistrations.status_id' => '1','candidate_attendence.isfilesubmit'=>'1'])
            ->get();
            //dd($data);
            $pfms = array(
                'institute_id'          =>  $data[0]->institute_id,
                'student_id'            =>  $data[0]->id,
                'full_name'             =>  $data[0]->firstname.' '. $data[0]->firstname.' '.$data[0]->firstname,
                'gender'                 =>  1,
                'address_1'              =>  $data[0]->address,
                'account_no'             =>  $data[0]->account_number,
                'mobile_no'              =>  $data[0]->mobile,
                'countrycd'              =>  101,
                'statecd'                =>  $data[0]->state,
                'districtcd'             =>  $data[0]->distric,
                'bank_name'              =>  $data[0]->bank_name,
                'ifsc_code'              =>  $data[0]->ifsc_code,
                'aadhar_no'              =>  $data[0]->aadhar_no,
                'pin_code'               =>  $data[0]->pincode,
                'scheme_code'            =>  1,
                'payment_amount'         =>  $data[0]->amount,
                'varify_by_1'            =>  Auth::id(),
                'created_date'           =>  date('Y-m-d'),
                
            );
            
            DB::table('pfms_details')->insert($pfms);
            return redirect()->back()->with('message', 'Record has been processed!!');   
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
