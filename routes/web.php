<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('labor', [App\Http\Controllers\WhatsappController::class, 'webhook']);
Route::get('/', function () {
    return view('welcome');
});


// Route::get('/loginTeacher')

Auth::routes();


Auth::routes();




Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::resource('user', App\Http\Controllers\UserController::class);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons');
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    //Student
    Route::get('/student', [App\Http\Controllers\StudentController::class, 'index'])->name('student');
    Route::get('/student/{id}/show', [App\Http\Controllers\StudentController::class, 'show']);
    Route::post('/student/import', [App\Http\Controllers\StudentController::class, 'import'])->name('import');
    route::delete('/student/{id}', [App\Http\Controllers\StudentController::class, 'destroy']);
    route::put('/student/{id}/condition', [App\Http\Controllers\StudentController::class, 'condition_active']);
    route::get('/student/{id}', [App\Http\Controllers\StudentController::class, 'edit']);
    route::put('/student/{id}/update', [App\Http\Controllers\StudentController::class, 'update']);
    //Classroom
    Route::get('/classroom', [App\Http\Controllers\ClassroomController::class, 'index'])->name('classroom');
    Route::post('/classroom/import', [App\Http\Controllers\ClassroomController::class, 'import'])->name('importclassroom');
    route::delete('/classroom/{id}', [App\Http\Controllers\ClassroomController::class, 'destroy']);
    route::get('/classroom/{id}', [App\Http\Controllers\ClassroomController::class, 'edit']);
    route::put('/classroom/{id}/condition', [App\Http\Controllers\ClassroomController::class, 'condition_active']);
    route::put('/classroom/{id}/update', [App\Http\Controllers\ClassroomController::class, 'update']);
    //Teacher
    Route::get('/teacher', [App\Http\Controllers\TeacherController::class, 'index'])->name('teacher');
    Route::post('/teacher/import', [App\Http\Controllers\TeacherController::class, 'import'])->name('importteacher');
    route::delete('/teacher/{id}', [App\Http\Controllers\TeacherController::class, 'destroy']);
    route::get('/teacher/{id}', [App\Http\Controllers\TeacherController::class, 'edit']);
    route::put('/teacher/{id}/condition', [App\Http\Controllers\TeacherController::class, 'condition_active']);
    route::put('/teacher/{id}/update', [App\Http\Controllers\TeacherController::class, 'update']);
    //tutor
    Route::get('/tutor', [App\Http\Controllers\TutorController::class, 'index'])->name('tutor');
    Route::post('/tutor/import', [App\Http\Controllers\TutorController::class, 'import'])->name('importtutor');
    route::delete('/tutor/{id}', [App\Http\Controllers\TutorController::class, 'destroy']);
    route::put('/tutor/{id}/condition', [App\Http\Controllers\TutorController::class, 'condition_active']);
    route::get('/tutor/{id}', [App\Http\Controllers\TutorController::class, 'edit']);
    route::put('/tutor/{id}/update', [App\Http\Controllers\TutorController::class, 'update']);
    //Roles
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    //course
    Route::resource('courses', App\Http\Controllers\CourseController::class);
    //matriculas
    Route::resource('matriculas', App\Http\Controllers\Student_CourseController::class);

});

//Rutas del profesor


Route::group(['middleware' => ['auth','teacher']], function () {
    //homr profesor
    Route::get('/homeTeacher', [App\Http\Controllers\HomeTeacherController::class, 'index'])->name('homeTeacher');
    //task
    Route::resource('tasks', App\Http\Controllers\TaskController::class);
    Route::get('/tasks/{id}/send', [App\Http\Controllers\TaskController::class, 'send'])->name('send_task');
    Route::get('/tasksshow/{task}', [App\Http\Controllers\TaskController::class, 'showtask'])->name('showtask');
    Route::get('/taskssend/{task}', [App\Http\Controllers\TaskController::class, 'sendtask'])->name('sendtask');
    Route::post('tasks_f', [App\Http\Controllers\TaskController::class, 'filtrar'])->name('filtrar_tasks');
    //Route::get('tasks_index', [App\Http\Controllers\TaskController::class, 'filttask'])->name('filttask');

    //labors
    Route::resource('labors', App\Http\Controllers\LaborController::class);
    //Route::get('labors_f', [App\Http\Controllers\LaborController::class, 'filter'])->name('filtrar_labors');
    Route::get('laborscalificar/{id}', [App\Http\Controllers\LaborController::class, 'edit'])->name('calificar_labors');

    //vistas del tutor a sus estudiantes
    Route::get('/studentviewtutor', [App\Http\Controllers\StudentController::class, 'indextutor'])->name('studentviewtutor');
    Route::get('/studentshowtutor/{id}', [App\Http\Controllers\StudentController::class, 'showtutor'])->name('studentshowviewtutor');
    Route::get('/showclasroom', [App\Http\Controllers\StudentController::class, 'showclasroom'])->name('showclasroom');
    Route::get('/sowaulastudent/{id}', [App\Http\Controllers\StudentController::class, 'sowaulastudent'])->name('sowaulastudent');

    //meetings
    Route::resource('meetings', App\Http\Controllers\MeetingController::class);



});

