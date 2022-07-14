<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\CovidRecordsController;
use App\Models\Province;


class HomeController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */



    private $covidRecords;



    public function __construct(CovidRecordsController $covidRecords)

    {

        $this->middleware('auth');

        $this->covidRecords = $covidRecords;

    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index()

    {

        $data['activeCases'] = $this->covidRecords->get_active_cases();

        $data['recoveries'] = $this->covidRecords->get_recoveries_cases();

        $data['deaths'] = $this->covidRecords->get_death_cases();

        $data['total'] = $this->covidRecords->get_totalconfirm_cases();

        $data['location'] = $this->covidRecords->getLocation();

        $data['latestDate'] = $this->covidRecords->getLatestDate();

        $data['lastUpdate'] = $this->covidRecords->getLastUpdate();
        
        $data['provinces'] = Province::all();

        

        return view('home', $data);

    }

}

