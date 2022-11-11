<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Imports\ClassroomImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
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
        // return view('classrooms.index', [
        //     'classrooms' => Student::all(),
        // ]);

        //con paginación
        $classrooms=DB::table('classrooms')
        ->select('id','grade','section','is_active')
        ->where('grade','LIKE','%'.$busqueda.'%')
        ->orWhere('section','LIKE','%'.$busqueda.'%')
        ->orderBy('grade','asc')
        ->paginate(7);
        return view('classrooms.index',compact('classrooms','busqueda'));
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
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom=Classroom::find($id);
        // dd($classroom);
        return view('classrooms.edit',[
            'classroom'=>$classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'grade' => 'required|numeric|digits:1',
            'section' => 'required|alpha|max:1',
        ]);
        //Actualizamos los valores del objeto y lo enviamos a la vase de datos.
        $classrrom = Classroom::find($id);
        $classrrom->grade = $request->get('grade');
        $classrrom->section = $request->get('section');
        if($request->get('is_active')==null){
            $classrrom->is_active=0;
        }else{$classrrom->is_active = 1;}
        $classrrom->save();

        return redirect('classroom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::find($id);
        $classroom->delete();
        return redirect('classroom');
    }

    public function import(Request $request){
        $request->validate([
            'documento' => 'required|file|mimes:xlsx,csv'
        ]);

        $file = $request->file('documento');
        $import = new ClassroomImport;
        $import->import($file);
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('classroom')->with('success', 'Estudiantes importados exitosamente');
    }
    public function condition_active($id)
    {
        $classroom = Classroom::find($id);
        $classroom->is_active=false;
        $classroom->save();
        // dd($classroom);
        return redirect('classroom');
    }
}
