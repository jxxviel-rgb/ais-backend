<?php

namespace App\Http\Controllers\Api\Vessels;

use App\Http\Controllers\Controller;
use App\Models\VesselsType;
use Exception;
use Illuminate\Http\Request;

class GetVesselTypeById extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $data = VesselsType::findOrFail($id);

            return response()->json([
                'status' => 'Success',
                'result' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'vessel type with id ' . $id . ' not found',
            ], 400);
        }
    }
}
