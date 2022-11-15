<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Student_Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


use Twilio\Rest\Client;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $tasks = Task::all();
    //     $courses = Course::all();
    //     $classrooms = Classroom::all();
    //     $teachers = Teacher::all();
    //     return view('tasks.index', compact('tasks', 'courses', 'classrooms', 'teachers'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        $classrooms = Classroom::all();
        $teachers = Teacher::all();
        return view('tasks.create', compact('courses', 'classrooms', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'reception_code' => 'required',
            'created_date' => 'required',
            'delivery_date' => 'required',
            'photo' => 'required',
            'courses_id' => 'required'

        ]);

        $task = new Task();
        $task->name = $request->get('name');
        $task->description = $request->get('description');
        $task->reception_code = $request->get('reception_code');
        $task->created_date = $request->get('created_date');
        $task->delivery_date = $request->get('delivery_date');
        $task->courses_id = $request->get('courses_id');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('argon/img/photos/', $filename);
            $task->photo = $filename;

            // $destinatioPath='argon/img/photos/';
            // $filename=time().'-'.$file->getClientOriginalName();
            // $uploadSuccess=$request->file('photo')->move($destinatioPath,$filename);
            // $task->photo=$destinatioPath.$filename;
        }
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Tarea añadido correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $courseid = Course::find($task->courses_id);
        $courses = Course::all();
        $classroomid = Classroom::find($courseid->classrooms_id);
        $classrooms = Classroom::all();
        $teachers = Teacher::all();
        $tasksall = Task::all();
        return view('tasks.edit', compact('task', 'courseid', 'courses', 'classroomid', 'classrooms', 'teachers', 'tasksall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'reception_code' => 'required',
            'created_date' => 'required',
            'delivery_date' => 'required',
            'photo' => 'required',
            'courses_id' => 'required'

        ]);

        $task = Task::find($id);
        $task->name = $request->get('name');
        $task->description = $request->get('description');
        $task->reception_code = $request->get('reception_code');
        $task->created_date = $request->get('created_date');
        $task->delivery_date = $request->get('delivery_date');
        if ($request->hasfile('photo')) {
            $destination = 'argon/img/photos/' . $task->photo;
            // dd($task->photo);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('photo');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('argon/img/photos/', $filename);
            $task->photo = $filename;
        }

        $task->courses_id = $request->get('courses_id');

        $task->update();
        return redirect()->route('tasks.index')->with('success', 'Tarea editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea borrado correctamente');
    }

    public function send($id)
    {
        require_once __DIR__ . './../../../vendor/autoload.php';
        $students = Student::all();
        $courses = Course::all();
        $matriculas = Student_Course::all();
        $task = Task::find($id);
        $sid = "AC9c4872acc6d847280b8b531767b41636";
        $token = "24b23d804a34dd7230dd2763dff9b3e4";
        $twilio = new Client($sid, $token);
        $destination = 'https://gat.8randx.me/argon/img/photos/' . $task->photo;
        foreach ($courses as $course) {
            if ($task->courses_id == $course->id) {
                foreach ($matriculas as $matricula) {
                    if ($matricula->courses_id == $course->id) {
                        foreach ($students as $student) {
                            if ($matricula->students_id == $student->id) {
                                $message = $twilio->messages
                                    ->create(
                                        // "whatsapp:+51902335749",//edison
                                        // "whatsapp:+51985075184",//paul955446977
                                        // "whatsapp:+51998608345",
                                        // "whatsapp:+51955446977",
                                        "whatsapp:+51" . $student->number_phone,

                                        [
                                            "from" => "whatsapp:+14155238886",
                                            "body" => "*ACTIVIDAD*" . "\n" . "*NOMBRE:*" . " " . $task->name . "\n" . "*DESCRIPCIÓN:*" . " " . $task->description . "\n" . "*CÓDIGO DE ENVIO:*" . " " . $task->reception_code . "\n" . "*FECHA DE ENTREGA:*" . " " . $task->delivery_date,
                                            "mediaUrl" => $destination,

                                        ]
                                    );
                            }
                        }
                    }
                }
            }
        }


        // print($message->sid);
        return redirect()->route('tasks.index')->with('success', 'Tarea enviado correctamente');
    }

    public function filtrar(Request $request)
    {
        $tasks = Task::all();
        $courses = Course::all();
        $course_filter = Course::find($request->get('courses_id'));
        $classrooms = Classroom::all();
        $teachers = Teacher::all();
        return view('tasks.show', compact('tasks', 'courses', 'classrooms', 'teachers', 'course_filter'));
    }


    public function showtask($id)
    {
        $task = Task::find($id);
        $courses = Course::all();
        $classrooms = Classroom::all();
        foreach ($courses as $course) {
            if ($task->courses_id == $course->id) {
                foreach ($classrooms as $classroom) {
                    if ($course->classrooms_id == $classroom->id) {
                        $name_course = substr($course->name, 0, -2) . " " . $classroom->grade . $classroom->section;
                    }
                }
            }
        }
        return view('tasks.showtask', compact('task', 'courses', 'classrooms', 'name_course'));
    }

    public function sendtask($id)
    {
        $task = Task::find($id);
        $students = Student::all();
        $courses = Course::all();
        $matriculas = Student_Course::all();
        $classrooms = Classroom::all();

        return view('tasks.sendtask', compact('task', 'students', 'courses', 'matriculas', 'classrooms'));
    }
    public function index(Request $request)
    {
        $idcurso = trim($request->get('idcurso'));
        $bimestre = trim($request->get('bimestre'));
        $bimestreNombre='';
        if ($idcurso == null && $bimestre == null) {
            $tasks = Task::all();
        } else {
            switch ($bimestre) {
                case 1: {
                        $tasks = DB::table('tasks')
                            ->select('id', 'reception_code', 'name', 'description', 'created_date', 'delivery_date', 'photo', 'courses_id')
                            ->WhereDate('created_date', '>=',  '2022-02-15')
                            ->WhereDate('created_date', '<=', '2022-04-08')
                            ->get();
                        $bimestreNombre='Primer Bimestre';
                        break;
                    }
                case 2: {
                        $tasks = DB::table('tasks')
                            ->select('id', 'reception_code', 'name', 'description', 'created_date', 'delivery_date', 'photo', 'courses_id')
                            ->WhereDate('created_date', '>=',  '2022-04-29')
                            ->WhereDate('created_date', '<=', '2022-07-08')
                            ->get();
                        $bimestreNombre='Segundo Bimestre';
                        break;
                    }
                case 3: {
                        $tasks = DB::table('tasks')
                            ->select('id', 'reception_code', 'name', 'description', 'created_date', 'delivery_date', 'photo', 'courses_id')
                            ->WhereDate('created_date', '>=',  '2022-07-08')
                            ->WhereDate('created_date', '<=', '2022-09-30')
                            ->get();
                        $bimestreNombre='Tercer Bimestre';
                        break;
                    }
                case 4: {
                        $tasks = DB::table('tasks')
                            ->select('id', 'reception_code', 'name', 'description', 'created_date', 'delivery_date', 'photo', 'courses_id')
                            ->WhereDate('created_date', '>=',  '2022-09-30')
                            ->WhereDate('created_date', '<=', '2022-12-15')
                            ->get();
                        $bimestreNombre='Cuarto Bimestre';
                        break;
                    }
            }
        }
        $coursef = Course::find($idcurso);
        $courses = Course::all();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();

        return view('tasks.index', compact('tasks', 'coursef', 'courses', 'teachers', 'idcurso', 'classrooms', 'bimestreNombre'));
    }
}
