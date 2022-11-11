<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Imports\TeacherImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $busqueda=trim($request->get('busqueda'));
        $teachers=DB::table('teachers')
        ->select('id','DNI','name','surname','email','number_phone','specialization','is_active')
        ->where('name','LIKE','%'.$busqueda.'%')
        ->orWhere('surname','LIKE','%'.$busqueda.'%')
        ->orWhere('DNI','LIKE','%'.$busqueda.'%')
        ->orderBy('surname','asc')
        ->paginate(7);
        return view('teachers.index',compact('teachers','busqueda'));
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
     * @param  \App\Http\Requests\StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher=Teacher::find($id);
        // dd($teacher);
        return view('teachers.edit',[
            'teacher'=>$teacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherRequest  $request
     * @param  \App\Models\Teacher  $teacher
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
            'specialization' => 'required',
        ]);
        //Actualizamos los valores del objeto y lo enviamos a la vase de datos.
        $teacher = Teacher::find($id);
        $teacher->name = $request->get('name');
        $teacher->surname = $request->get('surname');
        $teacher->DNI = $request->get('DNI');
        $teacher->number_phone = $request->get('number_phone');
        $teacher->email = $request->get('email');
        $teacher->specialization = $request->get('specialization');
        if ($request->get('is_active')==null){
            $teacher->is_active = 0;
        }else{$teacher->is_active = 1;}
        $teacher->save();

        return redirect('teacher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $teacher = Teacher::find($id);
        // $teacher->delete();
        // return redirect('teacher');
    }
    public function import(Request $request){
        $request->validate([
            'documento' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('documento');
        $import = new TeacherImport;
        $import->import($file);
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('teacher')->with('success', 'Estudiantes importados exitosamente');
    }
    public function condition_active($id)
    {
        $teacher = Teacher::find($id);
        $teacher->is_active=false;
        $teacher->save();
        // dd($teacher);
        return redirect('teacher');
    }
}
