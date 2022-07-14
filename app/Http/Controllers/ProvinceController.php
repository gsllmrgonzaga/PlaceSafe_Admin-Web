<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Province;

use Illuminate\Support\Facades\Validator;



class ProvinceController extends Controller

{

    public function getProvinces() {

        $provinces = Province::all();

        return $provinces;

    }

}

