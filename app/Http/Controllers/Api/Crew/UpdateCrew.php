<?php

namespace App\Http\Controllers\Api\Crew;

use App\Http\Controllers\Controller;
use App\Models\Crew;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateCrew extends Controller
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
            'company_id' => 'required|exists:company,id',
            'name' => 'required',
            'gender' => 'required|in:m,f',
            'address' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ], 400);
        }

        try {
            $data = Crew::findOrFail($id);
            $data->company_id = $request->company_id;
            $data->name = $request->name;
            $data->gender = $request->gender;
            $data->address = $request->address;
            $data->phone = $request->phone;
            $data->save();

            return response()->json([
                'status' => 'Success',
                'message' => 'Success update company',
                'companyId' => $data->id
            ]);
        } catch (Exception $err) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>$err->getMessage(),
            ], 400);
        }
    }
}
