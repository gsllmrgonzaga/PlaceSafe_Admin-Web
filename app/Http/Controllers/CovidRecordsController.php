<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientManagement;
use App\Models\Locations;
use App\Models\Province;
use Illuminate\Support\Facades\Validator;

class CovidRecordsController extends Controller
{
    public function get_active_cases()
    {
        return PatientManagement::where('case_status' , "ACTIVE")->count();
    }

    public function get_death_cases()
    {
        return PatientManagement::where('case_status' , "DIED")->count();
    }

    public function get_recoveries_cases()
    {
        return PatientManagement::where('case_status' , "RECOVERED")->count();
    }

    public function get_totalconfirm_cases()
    {
        return PatientManagement::all()->count();
    }

    public function getLocation() {
        $totalcases = Province::select(Province::raw('count(patients.id) AS total_cases, locations.locations_name, province.province'))
            ->leftJoin('locations', 'locations.province_id', '=', 'province.id')
            ->leftJoin('patients', 'patients.pat_location_name', '=', 'locations.locations_name')
            ->groupBy('province.province')
            ->groupBy('locations.locations_name')
            ->groupBy('patients.pat_location_name')
            ->orderBy('province.id')
            ->orderBy('locations.locations_name')
            ->get();
        return ($totalcases);
    }

    public function getTotalCases() {
        $cebu_count= PatientManagement::where('province' , "CEBU")->count();
        $bohol_count= PatientManagement::where('province' , "BOHOL")->count();
        $siquijor= PatientManagement::where('province' , "SIQUIJOR")->count();
        $negros_count= PatientManagement::where('province' , "NEGROS ORIENTAL")->count();
        $cases_count = array($cebu_count,$bohol_count,$siquijor,$negros_count);

        return response()->json($cases_count);
        
    }

    public function getLatestDate()
    {
        $getLatest = PatientManagement::select('created_at')
        ->latest('created_at')
        ->orderBy('created_at')
        ->first();

        $formattedDate = $getLatest->created_at->isoFormat('MMMM Y');

        return $formattedDate;
    }

    public function getLastUpdate()
    {
        $getLatest = PatientManagement::select('created_at')
        ->latest('created_at')
        ->orderBy('created_at')
        ->first();

        $formattedDate = $getLatest->created_at->isoFormat('MMMM DD, Y');

        return $formattedDate;
    }
}
