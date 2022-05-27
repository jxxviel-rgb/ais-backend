<?php

namespace App\Http\Controllers\Api\Fisherman;

use App\Http\Controllers\Controller;
use App\Models\Fishermans;
use Illuminate\Http\Request;

class GetFisherman extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = Fishermans::all();
        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);

    }
}
