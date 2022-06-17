<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class GetCompany extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = Company::all();

        return response()->json([
            'status' => 'Success',
            'result' => $data
        ]);
    }
}
