<?php

namespace App\Http\Controllers\Api\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Models\Pelabuhan;
use Illuminate\Http\Request;

class GetPelabuhan extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = Pelabuhan::all();

        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);
    }
}
