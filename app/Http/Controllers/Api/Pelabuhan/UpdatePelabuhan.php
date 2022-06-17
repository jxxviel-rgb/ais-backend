<?php

namespace App\Http\Controllers\Api\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Models\Pelabuhan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdatePelabuhan extends Controller
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
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }

        try {
            $data = Pelabuhan::findOrFail($id);
            $data->name = $request->name;
            $data->save();
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Success save pelabuhan data to database',
                'companyId' => $data->id
            ]);

        } catch(Exception $err) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>$err->getMessage(),
            ], 400);
        }
    }
}
