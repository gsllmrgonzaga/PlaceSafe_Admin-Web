<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locations;
use App\Models\Province;
use Illuminate\Support\Facades\Validator;

class LocationsController extends Controller
{
    public function getLocations($province_id)
    {
        $locations = Locations::where('province_id',$province_id)->get();
        return response()->json($locations);
    }
}