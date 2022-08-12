<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class GetCompanySelf extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $user = $request->user();
            $data = Company::where('user_id', $user->id)->firstOrFail();
            return response()->json([
                'status' => 'Success',
                'result' => $data,
            ]);
        } catch (Exception $err) {
            return response(400)->json([
                'status' => 'ERROR',
                'message' => $err->getMessage(),
            ]);
        }
    } 
}
