<?php

namespace App\Http\Controllers\Api\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Models\Pelabuhan;
use Exception;
use Illuminate\Http\Request;

class GetPelabuhanById extends Controller
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
            $data = Pelabuhan::findOrFail($id);

            return response()->json([
                'status' => 'Success',
                'result' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Pelabuhan with id ' . $id . ' not found',
            ], 400);
        }
    }
}
