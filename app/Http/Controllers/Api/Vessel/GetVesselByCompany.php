<?php

namespace App\Http\Controllers\Api\Vessel;

use App\Http\Controllers\Controller;
use App\Models\Vessel;
use Illuminate\Http\Request;

class GetVesselByCompany extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $data = Vessel::where('company_id', $id)->get();

        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);
    }
}
