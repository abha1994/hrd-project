<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;
class Form_validation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
	 
	 public function messages()
    {
        return [
             'father_name.required' => 'Please enter your father name.',
             'address.required'  => 'Please enter your address.',
			 'pincode.required' => 'Please enter your pincode',
			 'sipcode.required' => 'Please enter your sipcode',
			 'categories.required' => 'Please select your categories',
			 'area_interest.required' => 'Please select your area interest',
			 'intern_place.required' => 'Please select your internship place',
			 'intern_duration.required' => 'Please select your internship duration',
			 'desired_month_year.required' => 'Please select your desired month & year',
			 'writeup_interest.required' => 'Please enter your interest',
			 'remarks.required' => 'Please enter your remarks',
			 'id_proof.required' => 'Please select your Id proof category',
		 ];
    }
	
	
    public function rules()
    {
		 // $a = Session::get('userdata');
		 // if($a['countrycd'] == "99"){
			 // return [
				// 'father_name' => 'required|max:45',
				// 'address' => 'required',
				// 'pincode' => 'required',
				// 'sipcode' => 'required',
				// 'categories' => 'required',
				// 'area_interest' => 'required',
				// 'intern_place' => 'required',
				// 'intern_duration' => 'required',
				// 'desired_month_year' => 'required',
				// 'writeup_interest' => 'required',
				// 'remarks' => 'required',
				// 'id_proof' => 'required',
				// 'file_photo' => 'required|mimes:jpeg,png|max:2048',
				// 'file_id_proof' => 'required|mimes:pdf',
				// 'file_experience' => 'required|mimes:pdf',
				
				// /*'organization' => 'required',
				// 'organization_address' => 'required',
				// 'designation' => 'required',
				// 'nature_area' => 'required',
				// 'focus_work' => 'required',*/
             // ];
		 // }else{
			return [
				'father_name' => 'required|max:45',
				'address' => 'required',
				// 'sipcode' => 'required',
				'categories' => 'required',
				'area_interest' => 'required',
				'intern_place' => 'required',
				'intern_duration' => 'required',
				'desired_month_year' => 'required',
				'writeup_interest' => 'required',
				'remarks' => 'required',
				'id_proof' => 'required',
				'file_photo' => 'required|mimes:jpeg,png|max:2048',
				'file_id_proof' => 'required|mimes:pdf',
				// 'file_experience' => 'required|mimes:pdf',
				
				/*'organization' => 'required',
				'organization_address' => 'required',
				'designation' => 'required',
				'nature_area' => 'required',
				'focus_work' => 'required',*/
             ];
		 // }

    }
}
