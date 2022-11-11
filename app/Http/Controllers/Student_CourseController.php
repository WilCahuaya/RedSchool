<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Student;
use App\Models\Student_Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class Student_CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $matriculas=Student_Course::all();
       $courses= Course::all();
       $students=Student::all();
       $classrooms=Classroom::all();
       $teachers=Teacher::all();
       return view('matriculas.index', compact('matriculas','courses','students','classrooms','teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        $students=Student::all();
        $classrooms=Classroom::all();
        return view('matriculas.create', compact('courses','students','classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student= Student::find($request->get('students_id'));
        $student_course= new Student_Course();
        $student_course->courses_id=$request->get('courses_id');
        $student_course->students_id=$request->get('students_id');
        $student_course->save();
        return redirect()->route('matriculas.index')->with('success', 'Alumno '.$student->name.' '.$student->surname.' matriculado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('holass');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matricula = Student_Course::find($id);
        $courseid=Course::find($matricula->courses_id);
        $courses = Course::all();
        $studentid=Student::find($matricula->students_id);
        $students=Student::all();
        $classroomid=Classroom::find($courseid->classrooms_id);
        $classrooms=Classroom::all();
        return view('matriculas.edit', compact('courseid','courses','studentid','students','classroomid','classrooms','matricula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $matricula=Student_Course::find($id);
        $matricula->students_id= $request->get('students_id');
        $matricula->courses_id= $request->get('courses_id');
        $matricula->update();
        return redirect()->route('matriculas.index')->with('success', 'Datos actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matricula= Student_Course::find($id);
        $matricula->delete();
        return redirect()->route('matriculas.index')->with('success', 'Matricula dado de baja correctamente');
    }
}
