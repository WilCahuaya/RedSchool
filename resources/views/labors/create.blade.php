@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <form method="POST" action="{{ route('tasks.store')}}" enctype="multipart/form-data">
                {{-- Agrega un tocken para que pueda pasar al sistema de segurida de laravel --}}
                @csrf
                <div class="header-body">
                    <div class="d-flex p-4">
                        <div class="col-lg-12 col-7 ">
                            <h1 class="mb-0">Añade una Tarea</h1>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-left mx-sm-5 my-sm-2">
                        <div class="col-lg-10 col-7 p-4 " style="border-style:dashed;">

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            @error('name')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo nombre no debe estar vacio
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            @error('description')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo descripción no debe estar vacio
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="reception_code">Codigo de recepción</label>
                                <input type="text" class="form-control" id="reception_code" name="reception_code">
                            </div>
                            @error('reception_code')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo codigo de recepción no debe estar vacio
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="created_date">Fecha de creación</label>
                                <input type="date" class="form-control" id="created_date" name="created_date">
                            </div>
                            @error('created_date')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo dato no debe estar vacio
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="delivery_date">Fecha de entrega</label>
                                <input type="date" class="form-control" id="delivery_date" name="delivery_date">
                            </div>
                            @error('delivery_date')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo fecha de entrega no debe estar vacio
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="photo">Agregar imagen</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                            @error('photo')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo imagen no debe estar vacio
                                </div>
                            @enderror
                            <div class="form-group">
                                <option selected>Elige un Curso</option>
                                <select name="courses_id" class="form-select form-control" aria-label="Default select example">
                                    <option selected>Elige un Salon</option>
                                    @foreach ($courses as $course)
                                    @foreach ($teachers as $teacher)
                                    @if($teacher->id==$course->teachers_id)
                                    @if($teacher->email==auth()->user()->email)
                                    <option value="{{ $course->id }}">{{ $course->name }}
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
                                </select>
                            </div>
                            @if ($errors->has('courses_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $messages }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="col-lg-10 col-6">
                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary float-right mx-sm-3 my-sm-0">Cancelar</a>
                            <button class="btn btn-outline-primary float-right">Guardar</button>
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
