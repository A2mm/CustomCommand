<?php

namespace App\Http\Controllers\Api\V1\School;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\School\SchoolApiResource;
use App\Http\Requests\Api\V1\School\CreateSchoolApiRequest;
use App\Http\Requests\Api\V1\School\UpdateSchoolApiRequest;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = School::all();
        $data = SchoolApiResource::collection($items);
        return response()->json([ 
            'data' => $data, 
            'message' => 'success',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSchoolApiRequest $request)
    {
        $data     = $request->all();
        $item     = School::create($data);
        $item     = new SchoolApiResource($item);

        return response()->json([
            'data'     => $item,
            'message'  => 'Success',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        $data =  new SchoolApiResource($school);
        return response()->json([ 
            'data'    => $data, 
            'message' => 'success',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolApiRequest $request, School $school)
    {
        $school->update($request->all());
        $data = new SchoolApiResource($school);
        return response()->json([
            'data'    => $data, 
            'message' => 'Success',
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return response()->json(['message' => 'Item deleted'], 200);
    }
}
