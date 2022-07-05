<?php

namespace App\Http\Controllers\Api\Crew;

use App\Http\Controllers\Controller;
use App\Models\CrewDepature;
use Exception;
use Illuminate\Http\Request;

class DeleteCrewDeparture extends Controller
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
            $data = CrewDepature::findOrFail($id);
            $data->delete();

            return response()->json([
                'status' => 'Success',
                'message' => 'Success delete crew departure from database',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
