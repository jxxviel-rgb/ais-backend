<?php

namespace App\Http\Controllers\Api\Crew;

use App\Http\Controllers\Controller;
use App\Models\Crew;
use Exception;
use Illuminate\Http\Request;

class DeleteCrew extends Controller
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
            $data = Crew::findOrFail($id);
            $data->delete();

            return response()->json([
                'status' => 'Success',
                'message' => 'Success delete crew from database',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to delete crew with id ' . $id,
            ], 400);
        }
    }
}
