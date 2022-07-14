<?php

namespace App\Http\Controllers;

use App\Models\PatientManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Province;
use App\Models\Locations;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PatientsImport;

class PatientManagementController extends Controller
{
    public function index() 
    {
        $patients = PatientManagement::select('patients.*', 'admins.firstname as inputted_by_name', 'usersB.firstname as updated_by_name')
                ->leftJoin('admins', 'patients.inputted_by', '=', 'admins.id')
                ->leftJoin('admins as usersB', 'patients.updated_by', '=', 'usersB.id')
                ->latest()->paginate(10);
        return view('covidrecords', compact('patients'));
    }


    public function searchPatientByName(Request $request)
    {
        $search = $request->get('search');
        if(empty($search)) {
            $data['patients'] = PatientManagement::select('patients.*', 'admins.firstname as inputted_by_name', 'usersB.firstname as updated_by_name')
                        ->leftJoin('admins', 'patients.inputted_by', '=', 'admins.id')
                        ->leftJoin('admins as usersB', 'patients.updated_by', '=', 'usersB.id')
                        ->paginate(5);
        } else {
            $data['patients'] = PatientManagement::select('patients.*', 'admins.firstname as inputted_by_name', 'usersB.firstname as updated_by_name')
                        ->leftJoin('admins', 'patients.inputted_by', '=', 'admins.id')
                        ->leftJoin('admins as usersB', 'patients.updated_by', '=', 'usersB.id')
                        ->where('patient_code','like', "%".$search."%")
                        ->paginate(5);
        }
        return view('covidrecords', $data);
    }


    public function add_patient(Request $request)
    {
        
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'patient_code' => 'required|unique:patients',
                'case_status' => 'required',
                'age' => 'required',
                'province' => 'required',
                'pat_location_name' => 'required',
                'created_at' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('message', '<p class="alert alert-danger">'.$validator->messages()->first().'</p>');
            }
            else{
                $patient=PatientManagement::create([
                    'patient_code' => $request->patient_code,
                    'case_status' => $request->case_status,
                    'age' => $request->age,
                    'pat_location_name' => strtoupper($request->pat_location_name),
                    'province' => strtoupper($request->province),
                    'inputted_by' => $request->inputted_by,
                    'created_at' => now(),
                ]);
                return redirect()->route('patients')->with('message','Patient Added Successfully.');
            } 
        } else {
            $provinces = Province::all();
            return view('addpatient')->with('provinces', $provinces);
        }
    }



   public function patient_detail(Request $request)
    {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'updated_at' => 'required',
                'case_status' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('message', '<p class="alert alert-danger">'.$validator->messages()->first().'</p>');
            }
            else {
                //update details
                $patient = PatientManagement::where('id', $request->id)->update([
                    'updated_at' => $request->updated_at,
                    'case_status' => $request->case_status,
                    'updated_by' => $request->updated_by
                ]);
    
                return redirect()->route('patients')->with('message','Patient Updated Successfully.');
            }
        }
        else {
            $data['detail'] = PatientManagement::select('patients.*', 'admins.firstname as inputted_by_name', 'usersB.firstname as updated_by_name')
                        ->leftJoin('admins', 'patients.inputted_by', '=', 'admins.id')
                        ->leftJoin('admins as usersB', 'patients.updated_by', '=', 'usersB.id')
                        ->findOrFail($request->id);

            return view('updatepatient', $data);
        }
    }

    public function uploadPatients(Request $request)
    {
        Excel::import(new PatientsImport, $request->file('patient_file'));
        return redirect()->back()->with('message','Patients File Imported Successfully.');
    }

}
