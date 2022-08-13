<?php

namespace App\Http\Controllers\Api\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateActivity extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:company,id',
            'vessel_id' => 'required|exists:vessel,id',
            'sail_date' => 'required|date_format:Y-m-d',
            'pelabuhan_sail_id' => 'required|exists:pelabuhan,id',
        ], [], [
            'company_id' => 'Company',
            'vessel_id' => 'Vessel',
            'sail_date' => 'Sail',
            'berth_date' => 'Berth date',
            'pelabuhan_sail_id' => 'Place of departure'
        ],);



        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ], 400);
        }


        $activity = new Activity();
        $activity->company_id = $request->company_id;
        $activity->vessel_id = $request->vessel_id;
        $activity->sail_date = $request->sail_date;
        $activity->pelabuhan_sail_id = $request->pelabuhan_sail_id;
        $activity->is_sail = true;
        $activity->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Success save company data to database',
            'companyId' => $activity->id
        ]);
    }
}
