<?php

namespace App\Http\Controllers\Api\Type;

use App\Http\Controllers\Controller;
use App\Models\JenisTangkapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateTypeController extends Controller
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
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to validate data',
                'data' => $validator->errors()
            ],400);
        }

        $data = new JenisTangkapan();
        $data->name = $request->name;
        $data->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Success save pelabuhan data to database',
            'companyId' => $data->id
        ]);
        
    }
}
