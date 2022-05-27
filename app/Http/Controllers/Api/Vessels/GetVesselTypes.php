<?php

namespace App\Http\Controllers\Api\Vessels;

use App\Http\Controllers\Controller;
use App\Models\VesselsType;
use Exception;
use Illuminate\Http\Request;

class GetVesselTypes extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $vesselTypes = VesselsType::all();

            return response()->json([
                'status' => 'Success',
                'result' => $vesselTypes,
            ]);
        } catch (Exception $err) {
            return response()->json([
                'status' => 'Error',
                'message' => $err->getMessage(),
            ]);
        }
    }
}
