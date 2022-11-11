<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $teachers=Teacher::all();
        $classrooms=Classroom::all();
        return view('courses.index', compact('courses', 'teachers', 'classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers=Teacher::all();
        $classrooms=Classroom::all();
        return view('courses.create', compact('teachers','classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'teachers_id'=> 'required',
            'classrooms_id'=> 'required',
        ]);
        $course= new Course();
        $course->name= $request->get('name');
        $course->teachers_id= $request->get('teachers_id');
        $course->classrooms_id= $request->get('classrooms_id');
        $course->save();
        return redirect()->route('courses.index')->with('success', 'Curso añadido correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course= Course::find($id);
        $teachers=Teacher::all();
        $classrooms=Classroom::all();
        return view('courses.edit', compact('teachers','classrooms','course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $course= Course::find($id);
        $request->validate([
            'name'=> 'required',
            'teachers_id'=> 'required',
            'classrooms_id'=> 'required',
        ]);
        $course->name= $request->get('name');
        $course->teachers_id= $request->get('teachers_id');
        $course->classrooms_id= $request->get('classrooms_id');
        $course->update();
        return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course= Course::find($id);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Curso dado de baja correctamente');
    }
}
