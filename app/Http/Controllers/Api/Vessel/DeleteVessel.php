<?php

namespace App\Http\Controllers\Api\Vessel;

use App\Http\Controllers\Controller;
use App\Models\Vessel;
use Exception;
use Illuminate\Http\Request;

class DeleteVessel extends Controller
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
            $data =Vessel::findOrFail($id);
            $data->delete();

            return response()->json([
                'status' => 'Success',
                'message' => 'Success delete vessel from database',
            ]);
            
        } catch(Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>'Failed to delete vessel with id '.$id,
            ], 400);
        }
    }
}
