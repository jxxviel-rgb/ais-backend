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

class UpdateCompany extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $data = null;
        try {
            $data = Company::findOrFail($id);
        } catch (Exception $err) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Data not found',
            ],404);
        }
        
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'owner' => 'required',
            'email' => 'email|unique:users.email,'.$data->user->id,
            'registration_number' => 'required',
            'phone' => 'required',
            'password' => 'min5|nullable',
            'cPassword' => 'same:password',
            'address' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }
        DB::beginTransaction();
        try {
            
            $data->name = $request->name;
            $data->registration_number = $request->registration_number;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->save();

            $user = User::findOrFail($data->user->id);
            $user->name = $request->owner;
            if($request->has('password')) {
                $user->password = Hash::make($request->password);
            }

            if($request->has('email')) {
                $user->email = $request->email;
            }

            $user->save();

            DB::commit();
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Success update company',
                'companyId' => $data->id
            ]);

        } catch(Exception $err) {
            DB::rollBack();
            return response()->json([
                'status' => 'ERROR',
                'message' =>$err->getMessage(),
            ], 400);
        }
    }
}
