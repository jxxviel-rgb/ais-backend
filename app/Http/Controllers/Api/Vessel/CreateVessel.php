<?php

namespace App\Http\Controllers\Api\Vessel;

use App\Http\Controllers\Controller;
use App\Models\Vessel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateVessel extends Controller
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
            'pelabuhan_id' => 'required|exists:pelabuhan,id',
            'name' => 'required',
            'call_sign' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            // 'depth' => 'required|numeric',
            'gt' => 'required|numeric',
            'netto' => 'required|numeric',
            'years' => 'required|numeric|digits:4',
            // 'description' => 'min:10|max:100'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }

        try {
            $data = new Vessel();
            $data->company_id = $request->company_id;
            $data->pelabuhan_id = $request->pelabuhan_id;
            $data->name = $request->name;
            $data->call_sign = $request->call_sign;
            $data->imo = $request->imo;
            $data->length = $request->length;
            $data->width = $request->width;
            // $data->depth = $request->depth;
            $data->gt = $request->gt;
            $data->netto = $request->netto;
            $data->years = $request->years;
            // $data->description = $request->description;
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
