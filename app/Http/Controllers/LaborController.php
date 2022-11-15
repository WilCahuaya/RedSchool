<?php

namespace App\Http\Controllers;

use App\Models\Labor;
use App\Models\Student;
use App\Models\Course;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Task;
use App\Models\Tutor;
use App\Http\Requests\StoreLaborRequest;
use App\Http\Requests\UpdateLaborRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\TwiML\MessagingResponse;
use Illuminate\Support\Facades\File;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\DB;

class LaborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $teachers = Teacher::all();
    //     $courses = Course::all();
    //     $classrooms = Classroom::all();
    //     $labors = Labor::all();
    //     $students = Student::all();
    //     return view('labors.index', compact('labors', 'students', 'courses', 'classrooms', 'teachers'));
    // }

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
     * @param  \App\Http\Requests\StoreLaborRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function show(Labor $labor)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::all();
        $tasks = Task::all();
        $labor = Labor::find($id);
        return view('labors.edit', compact('labor', 'tasks', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaborRequest  $request
     * @param  \App\Models\Labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->get('tutor'));
        require_once __DIR__ . './../../../vendor/autoload.php';

        $tasks = Task::all();
        $labor = Labor::find($id);
        $student = Student::find($labor->students_id);
        $tutor = Tutor::find($student->tutors_id);
        $labor->note = $request->get('note');
        $labor->feedback = $request->get('feedback');
        if ($request->get('student') == null && $request->get('tutor') == null) {
            return redirect()->route('labors.edit',$labor->id)->with('success', 'Seleccione estudiante, apoderado o ambas opciones al momento de enviar');
        } else {

            if ($request->get('student') != null && $request->get('tutor') != null) {
                foreach ($tasks as $task) {
                    if ($task->reception_code == $labor->reception_code) {
                        $sid = "AC9c4872acc6d847280b8b531767b41636";
                        $token = "24b23d804a34dd7230dd2763dff9b3e4";
                        $twilio = new Client($sid, $token);
                        $destination = $labor->photo;
                        $message = $twilio->messages
                            ->create(
                                // "whatsapp:+51902335749",//edison
                                // "whatsapp:+51985075184",//paul955446977
                                // "whatsapp:+51998608345",
                                // "whatsapp:+51955446977",
                                "whatsapp:+51" . $student->number_phone,

                                [
                                    "from" => "whatsapp:+14155238886",
                                    "body" => "*ACTIVIDAD*"."\n"."*NOMBRE:*"." ".$task->name."\n"."*DESCRIPCIÓN:*"." ".$task->description."\n"."*CÓDIGO DE ENVIO:*"." ".$task->reception_code."\n"."*NOTA:*"." ".$labor->note."\n"."*Retroalimentación:*"." ".$labor->feedback,
                                    "mediaUrl" => $destination,

                                ]
                            );
                    }
                }
                foreach ($tasks as $task) {
                    if ($task->reception_code == $labor->reception_code) {
                        $sid = "AC9c4872acc6d847280b8b531767b41636";
                        $token = "24b23d804a34dd7230dd2763dff9b3e4";
                        $twilio = new Client($sid, $token);
                        $destination = $labor->photo;
                        $message = $twilio->messages
                            ->create(
                                // "whatsapp:+51902335749",//edison
                                // "whatsapp:+51985075184",//paul955446977
                                // "whatsapp:+51998608345",
                                // "whatsapp:+51955446977",
                                "whatsapp:+51" . $tutor->number_phone,

                                [
                                    "from" => "whatsapp:+14155238886",
                                    "body" => "*ACTIVIDAD*"."\n"."*NOMBRE:*"." ".$task->name."\n"."*DESCRIPCIÓN:*"." ".$task->description."\n"."*CÓDIGO DE ENVIO:*"." ".$task->reception_code."\n"."*NOTA:*"." ".$labor->note."\n"."*Retroalimentación:*"." ".$labor->feedback,
                                    "mediaUrl" => $destination,

                                ]
                            );
                    }
                }
                $labor->update();
                return redirect()->route('labors.index')->with('success', 'Actividad calificado y enviado correctamente al ' . $student->name . ' ' . $student->surname . ' y a su apoderado del estudiante ' . $tutor->name . ' ' . $tutor->surname);
            } else {
                if ($request->get('student') != null) {
                    foreach ($tasks as $task) {
                        if ($task->reception_code == $labor->reception_code) {
                            $sid = "AC9c4872acc6d847280b8b531767b41636";
                            $token = "24b23d804a34dd7230dd2763dff9b3e4";
                            $twilio = new Client($sid, $token);
                            $destination = $labor->photo;
                            $message = $twilio->messages
                                ->create(
                                    // "whatsapp:+51902335749",//edison
                                    // "whatsapp:+51985075184",//paul955446977
                                    // "whatsapp:+51998608345",
                                    // "whatsapp:+51955446977",
                                    "whatsapp:+51" . $student->number_phone,

                                    [
                                        "from" => "whatsapp:+14155238886",
                                        "body" => "*ACTIVIDAD*"."\n"."*NOMBRE:*"." ".$task->name."\n"."*DESCRIPCIÓN:*"." ".$task->description."\n"."*CÓDIGO DE ENVIO:*"." ".$task->reception_code."\n"."*NOTA:*"." ".$labor->note."\n"."*Retroalimentación:*"." ".$labor->feedback,
                                        "mediaUrl" => $destination,

                                    ]
                                );
                        }
                    }
                    $labor->update();
                    return redirect()->route('labors.index')->with('success', 'Actividad calificado y enviado correctamente al estudiante ' . $student->name . ' ' . $student->surname);
                }

                if ($request->get('tutor') != null) {
                    foreach ($tasks as $task) {
                        if ($task->reception_code == $labor->reception_code) {
                            $sid = "AC9c4872acc6d847280b8b531767b41636";
                            $token = "24b23d804a34dd7230dd2763dff9b3e4";
                            $twilio = new Client($sid, $token);
                            $destination = $labor->photo;
                            $message = $twilio->messages
                                ->create(
                                    // "whatsapp:+51902335749",//edison
                                    // "whatsapp:+51985075184",//paul955446977
                                    // "whatsapp:+51998608345",
                                    // "whatsapp:+51955446977",
                                    "whatsapp:+51" . $student->number_phone,

                                    [
                                        "from" => "whatsapp:+14155238886",
                                        "body" => "*ACTIVIDAD*"."\n"."*NOMBRE:*"." ".$task->name."\n"."*DESCRIPCIÓN:*"." ".$task->description."\n"."*CÓDIGO DE ENVIO:*"." ".$task->reception_code."\n"."*NOTA:*"." ".$labor->note."\n"."*Retroalimentación:*"." ".$labor->feedback,
                                        "mediaUrl" => $destination,

                                    ]
                                );
                        }
                    }
                    $labor->update();
                    return redirect()->route('labors.index')->with('success', 'Actividad calificado y enviado correctamente a ' . $tutor->name . ' ' . $tutor->surname . ' apoderado del estudiante ' . $student->name . ' ' . $student->surname);
                }
            }
        }

        // print($message->sid);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $labor = Labor::find($id);
        $labor->delete();
        return redirect()->route('labors.index')->with('success', 'Actividad borrado correctamente');
    }

    public function webhook(Request $request)
    {
        // dd($request);
        // Get number of images in the request
        $numMedia = (int) $request->input("NumMedia");

        Log::debug("Media files received: {$numMedia}");

        $response = new MessagingResponse();
        if ($numMedia === 0) {
            $message = $response->message("Send us an image!");
        } else {
            $message = $response->message("Thanks for the image! Here's one for you!");
        }
        // $message = $response->message("Thanks for the image! Here's one for you!");
        // $message->media(GOOD_BOY_URL);

        // dd($numMedia);
        return $response;
    }

    public function index(Request $request)
    {
        $idcurso = trim($request->get('idcurso'));
        $bimestre = trim($request->get('bimestre'));
        $bimestreNombre='';
        if ($idcurso == null && $bimestre == null) {
            $labors = Labor::all();
        } else {
            switch ($bimestre) {
                case 1: {
                        $labors = DB::table('labors')
                            ->select('id', 'photo', 'reception_code', 'note', 'feedback', 'delivery_date', 'students_id')
                            ->WhereDate('delivery_date', '>=',  '2022-02-15')
                            ->WhereDate('delivery_date', '<=', '2022-04-08')
                            ->get();
                        $bimestreNombre='Segundo Bimestre';
                        break;
                    }
                case 2: {
                        $labors = DB::table('labors')
                        ->select('id', 'photo', 'reception_code', 'note', 'feedback', 'delivery_date', 'students_id')
                            ->WhereDate('delivery_date', '>=',  '2022-04-29')
                            ->WhereDate('delivery_date', '<=', '2022-07-08')
                            ->get();
                        $bimestreNombre='Segundo Bimestre';
                        break;
                    }
                case 3: {
                        $labors = DB::table('labors')
                        ->select('id', 'photo', 'reception_code', 'note', 'feedback', 'delivery_date', 'students_id')
                            ->WhereDate('delivery_date', '>=',  '2022-07-08')
                            ->WhereDate('delivery_date', '<=', '2022-09-30')
                            ->get();
                        $bimestreNombre='Segundo Bimestre';
                        break;
                    }
                case 4: {
                        $labors = DB::table('labors')
                            ->select('id', 'photo', 'reception_code', 'note', 'feedback', 'delivery_date', 'students_id')
                            ->WhereDate('delivery_date', '>=',  '2022-09-30')
                            ->WhereDate('delivery_date', '<=', '2022-12-15')
                            ->get();
                        $bimestreNombre='Segundo Bimestre';
                        break;
                    }
            }
        }

        $students = Student::all();
        $courses = Course::all();
        $coursef = Course::find($idcurso);
        $classrooms = Classroom::all();
        $teachers = Teacher::all();
        return view('labors.index', compact('students', 'courses', 'classrooms', 'teachers', 'coursef', 'labors','idcurso','bimestreNombre'));
    }
}
