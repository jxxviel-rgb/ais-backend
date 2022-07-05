<?php

namespace App\Http\Controllers\Api\Crew;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Crew;
use App\Models\CrewDepature;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AddCrewDeparture extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'crew_id' => 'required|exists:crew,id',
                'activity_id' => 'required|exists:activity,id'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'Failed to validate data',
                    'data' => $validator->errors()
                ], 400);
            }
    
            $alreadyExists = CrewDepature::where([
                'activity_id' => $request->activity_id,
                'crew_id' => $request->user_id
            ])->first();
    
            if($alreadyExists) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'Crew Alredy exist',
                ], 400);
            }
    
            $activity = Activity::findOrFail($request->activity_id);
            $crew = Crew::findOrFail($request->crew_id);

            if($activity->company_id != $crew->company_id) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'Invalid crew data',
                ], 400);
            }


            $data = new CrewDepature();
            $data->crew_id = $request->crew_id;
            $data->company_id = $crew->company_id;
            $data->activity_id = $activity->id;
            $data->vessel_id = $activity->vessel_id;
            $data->save();
            DB::commit();
            return response()->json([
                'status' => 'Success',
                'message' => 'success add crew departure to database',
            ], 200);



        } catch(Exception $err) {
            DB::rollBack();
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed add crew departure',
            ], 400);
        }
    }
}
