<?php

namespace App\Http\Controllers\Api\Crew;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class GetCrewById extends Controller
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
            $data = Company::findOrFail($id);

            return response()->json([
                'status' => 'Success',
                'result' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Company with id ' . $id . ' not found',
            ], 400);
        }
    }
}
