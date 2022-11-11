@extends('layouts.app_admin')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_admin')
    </div>
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <form method="POST" action="{{ route('matriculas.store')}}" >
                {{-- Agrega un tocken para que pueda pasar al sistema de segurida de laravel --}}
                @csrf
                <div class="header-body">
                    <div class="d-flex p-4">
                        <div class="col-lg-12 col-7 ">
                            <h1 class="mb-0">Añade una Matrícula</h1>
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
                                <label for="students_id">Estudiante</label>
                                <select name="students_id" class="form-select form-control" aria-label="Default select example">
                                    <option selected>Elige un estudiante</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }} {{ $student->surname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('students_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $messages }}</strong>
                                </span>
                            @endif
                            <div class="form-group">
                                <label for="courses_id">Salon</label>
                                <select name="courses_id" class="form-select form-control" aria-label="Default select example">
                                    <option selected>Elige el curso</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}
                                        @foreach ($classrooms as $classroom)
                                        @if ($course->classrooms_id==$classroom->id)
                                        {{ $classroom->grade }} "{{ $classroom->section }}"
                                        @endif
                                        @endforeach
                                        </option>
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
                            <a href="{{ route('matriculas.index') }}" class="btn btn-outline-primary float-right mx-sm-3 my-sm-0">Cancelar</a>
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
