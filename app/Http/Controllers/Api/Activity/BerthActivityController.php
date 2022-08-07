<?php

namespace App\Http\Controllers\Api\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Exception;
use Illuminate\Http\Request;

class BerthActivityController extends Controller
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
            $data = Activity::findOrFail($id);
            $data->pelabuhan_berth_id = $request->pelabuhan_berth_id;
            $data->berth_date = $request->berth_date;
            $data->jenis_tangkapan_id= $request->jenis_tangkapan_id;
            $data->amount = $request->amount;
            $data->is_sail = false;
            $data->save();

            return response()->json([
                'status'=> 'Success',
                'message' => 'Activity updated',
            ]);
        } catch (Exception $err) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $err->getMessage(),
            ], 400);
        }
    }
}
