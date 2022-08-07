<?php

namespace App\Http\Controllers\Api\Crew;

use App\Http\Controllers\Controller;
use App\Models\Crew;
use Illuminate\Http\Request;

class GetCrewByCompany extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $data = Crew::where('company_id', $id)->get();

        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);
    }
}
