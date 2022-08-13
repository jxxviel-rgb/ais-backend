<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Exception;
use Illuminate\Http\Request;

class GetOwnerById extends Controller
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
            $data = Owner::findOrFail($id);

            return response()->json([
                'status' => 'Success',
                'result' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Crew with id ' . $id . ' not found',
            ], 400);
        }
    }
}
