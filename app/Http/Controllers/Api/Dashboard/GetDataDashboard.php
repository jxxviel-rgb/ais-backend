<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Crew;
use App\Models\JenisTangkapan;
use App\Models\Vessel;
use Illuminate\Http\Request;

class GetDataDashboard extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $cathType = JenisTangkapan::withSum('activity as total_tangkapan' , 'amount')->get();
        $totalCompany = Company::count();
        $totalVessel = Vessel::count();
        $totalCrew = Crew::count();
        $data = [
            'hasil_tangkapan' => $cathType,
            'total_company' => $totalCompany,
            'total_crew' => $totalCrew,
            'total_vessel' => $totalVessel,
        ];


        
        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);
    }
}
