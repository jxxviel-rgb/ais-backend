<?php

namespace App\Http\Controllers\Api\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Models\Pelabuhan;
use Exception;
use Illuminate\Http\Request;

class DeletePelabuhan extends Controller
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
            $data =Pelabuhan::findOrFail($id);
            $data->delete();

            return response()->json([
                'status' => 'Success',
                'message' => 'Success delete pelabuhan from database',
            ]);
            
        } catch(Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>'Failed to delete pelabuhan with id '.$id,
            ], 400);
        }
    }
}
