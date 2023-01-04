<?php

namespace App\Http\Controllers;

use App\Http\Resources\FacultyCollection;
use App\Http\Resources\FacultyResource;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculty = Faculty::withTrashed()->paginate();

        return (new FacultyCollection($faculty))->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faculty = new Faculty();

        $faculty->name = $request->input('name');
        $faculty->slug = $request->input('slug');

        $faculty->save();

        // Log::info("Faculty ID {$faculty->id} created successfully.");
        return (new FacultyCollection($faculty))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        return (new FacultyResource($faculty))->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculty $faculty)
    {
        $current_faculty = Faculty::find($faculty->id);
        $current_faculty->name = $request->input('name');
        $current_faculty->slug = $request->input('slug');
        $current_faculty->save();

        return (new FacultyResource($current_faculty))->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $faculty)
    {
        $current_faculty = Faculty::find($faculty->id);
        $current_faculty->delete();
        
        return (new FacultyResource($current_faculty))->response()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
