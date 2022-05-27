<?php

namespace App\Http\Controllers\Api\Vessel;

use App\Http\Controllers\Controller;
use App\Models\Vessel;
use Illuminate\Http\Request;

class GetVessel extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = Vessel::with(['fisherman', 'vesselType'])->get();
        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);
    }
}
