<?php


namespace App\Http\Controllers;

use App\Models\Labor;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\TwiML\MessagingResponse;

const GOOD_BOY_URL = "https://images.unsplash.com/photo-1518717758536-85ae29035b6d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80";

class WhatsappController extends Controller
{

    public function webhook(Request $request) {
        // require_once __DIR__.'./../../../vendor/autoload.php';
        $students=Student::all();
        // Get number of images in the request
        $numMedia = (int) $request->input("NumMedia");
        $name = (string) $request->input('ProfileName');
        $profilename = (string) $request->input('MediaContentType0');
        $num = (string) $request->input('From');
        $reception_code = (string) $request->input('Body');
        $photo = (string) $request->input('MediaUrl0');
        //Log::debug("Media files received: {$numMedia}");

        $response = new MessagingResponse();
        if ($numMedia === 0) {
            $message = $response->message("Envía una foto de su tarea con el código de recepción, sino cumple con las condiciones, no se le calificara.");
        } else {
            $message = $response->message($name." su tarea se envió correctamente y su código de envió a sido: ".$reception_code." verifica si esta correcto");
            // $message->media(GOOD_BOY_URL);

            //validar si el estudiante existe
            $labor=new Labor();
            $labor->delivery_date=Carbon::now();
            $labor->feedback='---';
            $labor->note=0;
            $labor->photo=$photo;
            $labor->reception_code=$reception_code;
            foreach ($students as $student){
                if(substr($num,-9)==$student->number_phone){
                    $labor->students_id=$student->id;
                }
            }
            $labor->save();
        }        
        
        return $response;
    }

}
