<?php

namespace App\Http\Controllers\Api\Vessels;

use App\Http\Controllers\Controller;
use App\Models\VesselsType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateVesselType extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:30|string'
        ]);


        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }
        try {
            $data = VesselsType::findOrFail($id);
            $data->name = $request->name;
            $data->save();

            return response()->json([
                'status' => 'Success',
                'message' => 'Success update vessel type to database',
                'vesselTypeId' => $data->id
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
