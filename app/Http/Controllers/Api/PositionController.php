<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vesselIds = Vessel::select('id')->pluck('id')->toArray();
        $positions = Vessel::whereKey($vesselIds)->with('latestPosition')->get();
        if (count($positions) !== 0) {
            return response()->json([
                'success' => true,
                'message' => 'Get All Data positions with vessel',
                'data' => $positions
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\position  $position
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vesselPositions = Vessel::with('position')->where('id', $id)->get();
        if (count($vesselPositions) !== 0) {
            return response()->json([
                'success' => true,
                'message' => 'Get All Data positions with vessel',
                'data' => $vesselPositions
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(position $position)
    {
        //
    }
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vessel' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $key = $request->input('vessel');
        $vessels = Vessel::where('name', 'iLIKE', $key . '%')->with('latestPosition')->limit(20)->get();
        if (count($vessels) !== 0) {
            return response()->json([
                'success' => true,
                'message' => 'Get All vessel',
                'data' => $vessels
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kapal tidak ditemukan',
                'data' => null
            ], Response::HTTP_NOT_FOUND);
        }
    }
    public function vesselPosition($id)
    {
        // $vesselIds = Vessel::select('id')->pluck('id')->toArray();
        $positions = Vessel::where('id', $id)->with('latestPosition')->first();
        // if (count($positions) !== 0) {
        // dd($positions);
        // dd($positions);
        return response()->json([
            'success' => true,
            'message' => 'Get All Data positions with vessel',
            'data' => $positions
        ], Response::HTTP_OK);
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Data not found',
        //         'data' => null
        //     ], Response::HTTP_NOT_FOUND);
        // }
    }
}
