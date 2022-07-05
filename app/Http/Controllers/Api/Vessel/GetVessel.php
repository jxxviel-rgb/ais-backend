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
    public function __invoke(Request $request, $id = null)
    {

        if($id) {
            $data = Vessel::with(['company', 'pelabuhan'])->where('company_id', $id)->get();
        } else {
            $data = Vessel::with(['company', 'pelabuhan'])->get();
        }

        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);
    }
}
