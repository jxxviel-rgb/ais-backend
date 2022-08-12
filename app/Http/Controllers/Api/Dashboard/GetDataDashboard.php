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
        $user = $request->user();

        $cathType = JenisTangkapan::withSum(
            [
                'activity as total_tangkapan' => function ($query) use ($user) {
                    if ($user->role == 'owner') {
                        $query->where('company_id', $user->company->id);
                    }
                }
            ],
            'amount'
        )->get();

        if ($user->role == 'owner') {
            $totalVessel = Vessel::where('company_id', $user->company->id)->count();
            $totalCrew = Crew::where('company_id', $user->company->id)->count();
            $totalCompany = null;
        } else {
            $totalVessel = Vessel::count();
            $totalCrew = Crew::count();
            $totalCompany = Company::count();
        }
        $data = [
            'hasil_tangkapan' => $cathType,
            'total_company' => $totalCompany,
            'total_crew' => $totalCrew,
            'total_vessel' => $totalVessel,
            'user' => $request->user()
        ];



        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);
    }
}
