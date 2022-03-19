<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\Student\StudentApiResource;
use App\Http\Requests\Api\V1\Student\CreateStudentApiRequest;
use App\Http\Requests\Api\V1\Student\UpdateStudentApiRequest;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Student::all();
        $data  = StudentApiResource::collection($items);
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
    public function store(CreateStudentApiRequest $request)
    {
        $data     = $request->all();
        $item     = Student::create($data);
        $item     = new StudentApiResource($item);

        return response()->json([
            'data'     => $item,
            'message'  => 'Success',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $data =  new StudentApiResource($student);
        return response()->json([ 
            'data'    => $data, 
            'message' => 'success',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentApiRequest $request, Student $student)
    {
        $student->update($request->all());
        $data = new StudentApiResource($student);
        return response()->json([
            'data'    => $data, 
            'message' => 'Success',
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Item deleted'], 200);
    }
}
