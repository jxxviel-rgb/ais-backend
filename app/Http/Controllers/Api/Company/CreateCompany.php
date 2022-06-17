<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateCompany extends Controller
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
            'name' => 'required',
            'registration_number' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }

        $data = new Company();
        $data->name = $request->name;
        $data->registration_number = $request->registration_number;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Success save company data to database',
            'companyId' => $data->id
        ]);
    }
}
