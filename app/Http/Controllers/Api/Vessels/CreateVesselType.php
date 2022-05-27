<?php

namespace App\Http\Controllers\Api\Vessels;

use App\Http\Controllers\Controller;
use App\Models\VesselsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class CreateVesselType extends Controller
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
            'name' => 'required|min:2|max:30|string'
        ]);


        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }

        $type = new VesselsType();
        $type->name = $request->name;
        $type->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Success save vessel type to database',
            'vesselTypeId' => $type->id
        ]);



    }
}
