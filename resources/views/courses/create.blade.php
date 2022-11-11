@extends('layouts.app_admin')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_admin')
    </div>
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <form method="POST" action="{{ route('courses.store')}}" >
                {{-- Agrega un tocken para que pueda pasar al sistema de segurida de laravel --}}
                @csrf
                <div class="header-body">
                    <div class="d-flex p-4">
                        <div class="col-lg-12 col-7 ">
                            <h1 class="mb-0">Añade un Curso</h1>
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
                                <option selected>Elige un profesor</option>
                                <select name="teachers_id" class="form-select form-control" aria-label="Default select example">
                                    <label for="teachers_id">Profesor</label>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->surname }} - {{ $teacher->specialization }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('teachers_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $messages }}</strong>
                                </span>
                            @endif
                            <div class="form-group">
                                <label for="classrooms_id">Salon</label>
                                <select name="classrooms_id" class="form-select form-control" aria-label="Default select example">
                                    <option selected>Elige un salon</option>
                                    @foreach ($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->grade }} {{ $classroom->section }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('classrooms_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $messages }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="col-lg-10 col-6">
                            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary float-right mx-sm-3 my-sm-0">Cancelar</a>
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
