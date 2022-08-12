<?php

namespace App\Http\Controllers\Api\Type;

use App\Http\Controllers\Controller;
use App\Models\JenisTangkapan;
use Illuminate\Http\Request;

class GetTypeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = JenisTangkapan::all();

        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);
    }
}
