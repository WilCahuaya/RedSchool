<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Task;
use App\Models\Labor;
use App\Models\Student_Course;
use App\Models\Tutor;

class HomeTeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $students = Student::all();
        $courses = Course::all();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        $tasks = Task::all();
        $labors = Labor::all();
        $tutors = Tutor::all();
        $matriculas = Student_Course::all();
        $countstudents = 0;
        $countcourses = 0;
        $countlabors = 0;
        $countnotabaja = 0;
        $countnotaalta = 0;
//cantidad de estudiantes y cursos
        foreach ($teachers as $teacher) {
            if ($teacher->email == auth()->user()->email) {
                foreach ($courses as $course) {
                    if ($teacher->id == $course->teachers_id) {
                        $countcourses = $countcourses + 1;
                        foreach ($matriculas as $matricula) {
                            if ($course->id == $matricula->courses_id) {
                                foreach ($students as $student) {
                                    if ($student->id == $matricula->students_id) {
                                        $countstudents = $countstudents + 1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
//cantidad de notas bajas y altas
        foreach ($teachers as $teacher) {
            if ($teacher->email == auth()->user()->email) {
                foreach ($students as $student) {
                    foreach ($labors as $labor) {
                        if ($student->id == $labor->students_id) {
                            $countlabors = $countlabors + 1;
                            if ($labor->note <= 10) {
                                $countnotabaja = $countnotabaja + 1;
                            }
                            if ($labor->note > 10) {
                                $countnotaalta = $countnotaalta + 1;
                            }
                        }
                    }
                }
            }
        }
        return view('dashboardTeacher', compact('countlabors', 'countcourses', 'countstudents', 'countnotabaja', 'countnotaalta', 'students', 'teachers', 'courses', 'matriculas'));
    }
}
