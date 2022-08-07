<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateOwner extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'requried',
                'phone' => 'required',
                'address' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ], 400);
        }
        try {
            $data = Owner::findOrFail($id);
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->save();

        } catch (Exception $err) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>$err->getMessage(),
            ], 400);
        }
    }
}
