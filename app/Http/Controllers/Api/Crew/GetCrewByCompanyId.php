<?php

namespace App\Http\Controllers\Api\Crew;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Crew;
use App\Models\CrewDepature;
use Exception;
use Illuminate\Http\Request;

class GetCrewByCompanyId extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {

        try {

            $activity = Activity::findOrFail($id);

            $crewExists = Crew::whereNotIn('id', function ($query) use ($activity) {
                $query->select('crew_id')
                    ->from('crew_departure')
                    ->join('activity', 'crew_departure.activity_id', '=', 'activity.id')
                    ->where('crew_departure.company_id', $activity->company_id)
                    ->orWhere('activity.id', $activity->id,);
            })
                ->where('company_id', $activity->company_id)
                ->get();

            $crewNotExist = CrewDepature::with('crew')->where('activity_id', $activity->id)->get();


            // dd($crewExists);
            return response()->json([
                'status' => 'Success',
                'result' => [
                    'crewExists' => $crewExists,
                    'crewDepart' => $crewNotExist,
                ]
            ]);
        } catch (Exception $err) {
            return response()->json([
                'status' => 'Error',
                'message' => $err->getMessage()
            ]);
        }
    }
}
