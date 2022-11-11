<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Imports\StudentsImport;
use App\Models\Tutor;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $busqueda=trim($request->get('busqueda'));
        //sin paginación
        // return view('students.index', [
        //     'students' => Student::all(),
        // ]);

        //con paginación
        $students=DB::table('students')
        ->select('id','DNI','name','surname','email','number_phone','is_active')
        ->where('name','LIKE','%'.$busqueda.'%')
        ->orWhere('surname','LIKE','%'.$busqueda.'%')
        ->orWhere('DNI','LIKE','%'.$busqueda.'%')
        ->orderBy('surname','asc')
        ->paginate(7);
        return view('students.index',compact('students','busqueda'));
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
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $id_tutor=$student->tutors_id;
        $tutor = Tutor::find($id_tutor);
        // dd($student);
        return view('students.show', [
            'student' => $student,
            'tutor'=>$tutor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $id_tutor=$student->tutors_id;
        $tutors = Tutor::all();
        // dd($student);
        return view('students.edit', [
            'student' => $student,
            'tutors'=>$tutors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
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
        $student = Student::find($id);
        $student->name = $request->get('name');
        $student->surname = $request->get('surname');
        $student->DNI = $request->get('DNI');
        $student->number_phone = $request->get('number_phone');
        $student->email = $request->get('email');
        if ($request->get('is_active')==null){
            $student->is_active = 0;
        }else{$student->is_active = 1;}
        $student->tutors_id= $request->get('tutors_id');
        $student->save();

        return redirect('student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $student = Student::find($id);
        // $student->delete();
        // return redirect('student');
    }

    public function import(Request $request)
    {
        $request->validate([
            'documento' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('documento');
        $import = new StudentsImport;
        $import->import($file);
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('student')->with('success', 'Estudiantes importados exitosamente');
    }

    public function condition_active($id)
    {
        $student = Student::find($id);
        $student->is_active=false;
        $student->save();
        // dd($student);
        return redirect('student');
    }
}
