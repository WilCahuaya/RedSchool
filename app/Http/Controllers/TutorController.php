<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Student_Course;
use App\Http\Requests\StoreTutorRequest;
use App\Http\Requests\UpdateTutorRequest;
use App\Imports\TutorsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $busqueda=trim($request->get('busqueda'));
        $tutors=DB::table('tutors')
        ->select('id','DNI','name','surname','email','number_phone','is_active')
        ->where('name','LIKE','%'.$busqueda.'%')
        ->orWhere('surname','LIKE','%'.$busqueda.'%')
        ->orWhere('DNI','LIKE','%'.$busqueda.'%')
        ->orderBy('surname','asc')
        ->paginate(7);
        return view('tutors.index',compact('tutors','busqueda'));
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
     * @param  \App\Http\Requests\StoreTutorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function show(Tutor $tutor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutor = Tutor::find($id);
        // dd($tutor);
        return view('tutors.edit', [
            'tutor' => $tutor
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTutorRequest  $request
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'DNI' => 'required|numeric|digits:8',
            'name' => 'required',
            'surname' => 'required',
            'number_phone' => 'required|numeric|digits:9',
            'email' => 'required|email',
        ]);
        //Actualizamos los valores del objeto y lo enviamos a la vase de datos.
        $tutor = Tutor::find($id);
        $tutor->name = $request->get('name');
        $tutor->surname = $request->get('surname');
        $tutor->DNI = $request->get('DNI');
        $tutor->number_phone = $request->get('number_phone');
        $tutor->email = $request->get('email');if ($request->get('is_active')==null){
            $tutor->is_active = 0;
        }else{$tutor->is_active = 1;}
        $tutor->save();

        return redirect('tutor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutor $tutor)
    {
        //
    }

    public function import(Request $request)
    {
        $request->validate([
            'documentotutors' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('documentotutors');
        $importtutor = new TutorsImport;
        $importtutor->import($file);
        if ($importtutor->failures()->isNotEmpty()) {
            return back()->withFailures($importtutor->failures());
        }

        return redirect()->route('tutor')->with('success', 'Padres importados exitosamente');
    }

    public function condition_active($id)
    {
        $tutor = Tutor::find($id);
        $tutor->is_active=false;
        $tutor->save();
        // dd($tutor);
        return redirect('tutor');
    }

    public function showtutor(Request $request){
        $busqueda=trim($request->get('busqueda'));
        $courses=Course::all();
        $teachers=Teacher::all();
        $classrooms=Classroom::all();
        $students=Student::all();
        $matriculas=Student_Course::all();
        $tutors=DB::table('tutors')
        ->select('id','DNI','name','surname','email','number_phone','is_active')
        ->where('name','LIKE','%'.$busqueda.'%')
        ->orWhere('surname','LIKE','%'.$busqueda.'%')
        ->orWhere('DNI','LIKE','%'.$busqueda.'%')
        ->orderBy('surname','asc')
        ->paginate(7);
        return view('tutors.showtutor',compact('tutors','busqueda','courses','teachers','classrooms','students','matriculas'));
    }

    public function filter(Request $request)
    {
        $busqueda=trim($request->get('busqueda'));
        $courses=Course::all();
        $course_filter = Course::find($request->get('courses_id'));
        $teachers=Teacher::all();
        $classrooms=Classroom::all();
        $students=Student::all();
        $matriculas=Student_Course::all();
        $tutors=DB::table('tutors')
        ->select('id','DNI','name','surname','email','number_phone','is_active')
        ->where('name','LIKE','%'.$busqueda.'%')
        ->orWhere('surname','LIKE','%'.$busqueda.'%')
        ->orWhere('DNI','LIKE','%'.$busqueda.'%')
        ->orderBy('surname','asc')
        ->paginate(7);
        return view('tutors.show',compact('tutors','busqueda','courses','course_filter','teachers','classrooms','students','matriculas'));
    }
}
