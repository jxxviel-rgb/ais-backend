<?php

namespace App\Http\Controllers\Api\Fisherman;

use App\Http\Controllers\Controller;
use App\Models\Fishermans;
use Exception;
use Illuminate\Http\Request;

class DeleteFisherman extends Controller
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
            $data = Fishermans::findOrFail($id);
            $data->delete();

            return response()->json([
                'status' => 'Success',
                'message' => 'Success delete fisherman from database',
            ]);
            
        } catch(Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>'Failed to delete fisherman with id '.$id,
            ], 400);
        }
    }
}
