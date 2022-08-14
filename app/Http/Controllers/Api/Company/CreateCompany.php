<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            'owner' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'cPassword' => 'same:password'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ], 400);
        }

        try {

            $user = new User();
            $user->email = $request->email;
            $user->name = $request->owner;
            $user->password = Hash::make($request->password);
            $user->role = 'owner';
            $user->save();

            $data = new Company();
            $data->user_id = $user->id;
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
        } catch (Exception $err) {
            DB::rollBack();
            return response(400)->json([
                'status' => 'ERROR',
                'message' => $err->getMessage(),
                'companyId' => $data->id
            ]);
        }
    }
}
