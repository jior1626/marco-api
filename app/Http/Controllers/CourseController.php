<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Courses = Course::all();

        if($request->get("startDate") && $request->get("endDate")) {
            $Courses = $Courses->filter( function($car) use ($request) {
                return $car->created_at >= $request->startDate && $car->created_at <= $request->startDate;
            });  
        }

        return response()->json($Courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:Courses',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        $Course = new Course();
        $Course->name = $request->name;
        $Course->startDate = $request->startDate;
        $Course->endDate = $request->endDate;
        $Course->save();

        return response()->json(["message" => "¡Vehiculo creado correctamente!", "data" => $Course]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Course = Course::findOrFail($id);

        return response()->json($Course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        $Course = Course::findOrFail($id);
        $Course->name = $request->name;
        $Course->startDate = $request->startDate;
        $Course->endDate = $request->endDate;
        $Course->save();

        return response()->json(["message" => "¡Vehiculo actualizado correctamente!", "data" => $Course]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Course = Course::find($id);
        $Course->delete();
        return response()->json(["message" => "Curso borrado correctamente!"]);
    }
}
