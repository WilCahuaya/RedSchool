@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <form action="{{ route('tasks.update',$task->id) }}" method="POST" enctype="multipart/form-data">
                {{-- Agrega un tocken para que pueda pasar al sistema de segurida de laravel --}}
                @csrf
                @method('put')
                <div class="header-body">
                    <div class="d-flex p-4">
                        <div class="col-lg-12 col-7 ">
                            <h1 class="mb-0">Editar los datos del rol: {{ $task->name }}</h1>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            Datos actualizados exitosamente
                        </div>
                    @endif
                    <div class="d-flex justify-content-left mx-sm-5 my-sm-2">
                        <div class="col-lg-10 col-7 p-4 " style="border-style:dashed;">

                            <div class="form-group">
                                <label for="name">Nombres</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $task->name }}">
                            </div>
                            @error('name')
                                <div class="mx-3 alert alert-danger" task="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="reception_code">Codigo de envió</label>
                                <input type="text" class="form-control" id="reception_code" name="reception_code"
                                    value="{{ $task->reception_code }}">
                            </div>
                            @error('reception_code')
                                <div class="mx-3 alert alert-danger" task="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ $task->description }}">
                            </div>
                            @error('description')
                                <div class="mx-3 alert alert-danger" task="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="created_date">Fecha de creación</label>
                                <input type="date" class="form-control" id="created_date" name="created_date"
                                    value="{{ $task->created_date }}">
                            </div>
                            @error('created_date')
                                <div class="mx-3 alert alert-danger" task="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="delivery_date">Fecha de entrega</label>
                                <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                                    value="{{ $task->delivery_date }}">
                            </div>
                            @error('delivery_date')
                                <div class="mx-3 alert alert-danger" task="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="">Editar imagen</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                <img src="{{ asset('argon/img/photos/'.$task->photo) }}" alt="{{ $task->name }}" class="img-fluid" width="120">
                            </div>

                            @error('photo')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo imagen no debe estar vacio
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="courses_id">Elige un salon</label>
                                <select name="courses_id" class="form-select form-control"
                                    aria-label="Default select example">
                                    
                                    @if (empty($task->courses_id))
                                        <option value="">Elige un Salón</option>
                                        @foreach ($courses as $course)
                                    @foreach ($teachers as $teacher)
                                    @if($teacher->id==$course->teachers_id)
                                    @if($teacher->email==auth()->user()->email)
                                    <option value="{{ $course->id }}">{{ substr($course->name,0,-2)}}
                                        @foreach ($classrooms as $classroom)
                                        @if ($classroom->id == $course->classrooms_id)
                                        {{ $classroom->grade }} "{{ $classroom->section }}"
                                        @endif
                                        @endforeach
                                        </option>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endforeach
                                    @else
                                                <option value="{{ $courseid->id }}">{{ substr($courseid->name,0,-2) }} {{ $classroomid->grade }} "{{ $classroomid->section }}"</option>
                                                <option value="">Elige un Salón</option>
                                                @foreach ($courses as $course)
                                                @foreach ($teachers as $teacher)
                                                @if($teacher->id==$course->teachers_id)
                                                @if($teacher->email==auth()->user()->email)
                                                <option value="{{ $course->id }}">{{ substr($course->name,0,-2) }}
                                                    @foreach ($classrooms as $classroom)
                                                    @if ($classroom->id == $course->classrooms_id)
                                                    {{ $classroom->grade }} "{{ $classroom->section }}"
                                                    @endif
                                                    @endforeach
                                                    </option>
                                                @endif
                                                @endif
                                                @endforeach
                                                @endforeach
                                    @endif
                                </select>
                            </div>
                            @error('courses_id')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    Elige un salon
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="col-lg-10 col-6">
                            <a href="{{ route('tasks.index') }}" type="button"
                                class="btn btn-outline-primary float-right mx-sm-3 my-sm-0">Cancelar</a>
                            <button type="submit" class="btn btn-outline-primary float-right">Editar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
    @include('layouts.footers.auth')
    </div>
@endsection


@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
