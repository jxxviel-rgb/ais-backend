<?php

namespace App\Http\Controllers\Api\Fisherman;

use App\Http\Controllers\Controller;
use App\Models\Fishermans;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateFisherman extends Controller
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
            'name' => 'required|min:3|max:60',
            'phone' => 'required|min:10|max:15',
            'address' => 'required|min:8|max:60',
            'gender' => 'required|in:l,p'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }

        try {
            $data =  Fishermans::findOrFail($id);
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->gender = $request->gender;
            $data->save();
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Success update fisherman data to database',
                'fishermanId' => $data->id
            ]);

        } catch(Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>$e->getMessage(),
            ], 400);
        }
    }
}
