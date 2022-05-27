<?php

namespace App\Http\Controllers\Api\Vessels;

use App\Http\Controllers\Controller;
use App\Models\VesselsType;
use Exception;
use Illuminate\Http\Request;

class DeleteVesselType extends Controller
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
            $data->delete();

            return response()->json([
                'status' => 'Success',
                'message' => 'Success delete vessel type from database',
            ]);
            
        } catch(Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>'Failed to delete vessel type with id '.$id,
            ], 400);
        }
    }
}
