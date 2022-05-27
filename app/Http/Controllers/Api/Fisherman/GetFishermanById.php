<?php

namespace App\Http\Controllers\Api\Fisherman;

use App\Http\Controllers\Controller;
use App\Models\Fishermans;
use Exception;
use Illuminate\Http\Request;

class GetFishermanById extends Controller
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

            return response()->json([
                'status' => 'Success',
                'result' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Fisherman with id ' . $id . ' not found',
            ], 400);
        }
    }
}
