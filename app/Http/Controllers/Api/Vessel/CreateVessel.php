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
            'name' => 'required',
            'call_sign' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'gt' => 'required|numeric',
            'netto' => 'required|numeric',
            'years' => 'required|numeric|digits:4',
            'no_ais' => 'required',
            'image' => 'required|max:10000|mimes:jpg,jpeg,png'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }

        try {

            $file = $request->file('image');
            

            $file_name = 'vessel_' . time() . '.' . $file->getClientOriginalExtension();
            $file_path = $file->storeAs("public/vesel/" , $file_name);
            
            $data = new Vessel();
            $data->company_id = $request->company_id;
            $data->name = $request->name;
            $data->call_sign = $request->call_sign;
            $data->imo = $request->imo;
            $data->length = $request->length;
            $data->width = $request->width;
            $data->gt = $request->gt;
            $data->netto = $request->netto;
            $data->years = $request->years;
            $data->image = $file_path;
            $data->no_ais = $request->no_ais;
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
