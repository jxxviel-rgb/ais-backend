<?php

namespace App\Http\Controllers\Api\Vessel;

use App\Http\Controllers\Controller;
use App\Models\Vessel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateVessel extends Controller
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
            'vesselTypeId' => 'required|exists:vessels_types,id',
            'fishermanId' => 'required|exists:fishermans,id',
            'name' => 'required',
            'callSignin' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'depth' => 'required|numeric',
            'gt' => 'required|numeric',
            'netto' => 'required|numeric',
            'year' => 'required|numeric|digits:4',
            'description' => 'min:10|max:100'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }

        try {
            $data = Vessel::findOrFail($id);
            $data->vessels_type_id = $request->vesselTypeId;
            $data->fisherman_id = $request->fishermanId;
            $data->name = $request->name;
            $data->call_signin = $request->callSignin;
            $data->imo = $request->imo;
            $data->length = $request->length;
            $data->width = $request->width;
            $data->depth = $request->depth;
            $data->gt = $request->gt;
            $data->netto = $request->netto;
            $data->year = $request->year;
            $data->description = $request->description;
            $data->save();


            return response()->json([
                'status' => 'Success',
                'message' => 'Success save vessel to database',
                'vesselId' => $data->id
            ]);

        } catch(Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>$e->getMessage(),
            ], 400);
        }
    }
}
