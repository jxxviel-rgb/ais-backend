<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateOwner extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
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

        $data = new Owner();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();


        return response()->json([
            'status' => 'Success',
            'message' => 'Success save owner data to database',
            'companyId' => $data->id
        ]);

    }
}
