<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class DeleteCompany extends Controller
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
            $data =Company::findOrFail($id);
            $data->delete();

            return response()->json([
                'status' => 'Success',
                'message' => 'Success delete company from database',
            ]);
            
        } catch(Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' =>'Failed to delete company with id '.$id,
            ], 400);
        }
    }
}
