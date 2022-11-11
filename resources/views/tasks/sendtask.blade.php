@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>
    <!-- Header -->
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="d-flex pt-4">
                    <div class="col-lg-6 col-7 ">

                        <form action="#" method="GET">
                            <div class="container d-flex">
                                <input name="busqueda" class="form-control" placeholder="Buscar Estudiante" type="text"
                                    value="">
                                <input type="submit" value="Buscar" class="btn btn-primary ml-2">
                            </div>
                        </form>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Page content -->

    <div class="container-fluid mt--6 pt-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 md-6">
                        <h3 class="mb-0">Enviar la tarea "{{ $task->name }}" a los siguientes estudiantes</h3>
                    </div>

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Nombre</th>
                                    <th scope="col" class="sort" data-sort="name">Numero de Celular</th>
                                    <th scope="col" class="sort" data-sort="name">Fecha de Entrega</th>
                                    <th scope="col" class="sort" data-sort="name">Salon</th>
                                    <th scope="col" class="sort" data-sort="name">Imagen</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($courses as $course)
                                    @if ($task->courses_id == $course->id)
                                        @foreach ($matriculas as $matricula)
                                            @if ($matricula->courses_id == $course->id)
                                                @foreach ($students as $student)
                                                    @if ($matricula->students_id == $student->id)
                                                    @if (count($students) <= 0)
                                                    <tr>
                                                        <td colspan="6">No hay resultados</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>
                                                            {{ $student->name }} {{$student->surname  }}
                                                        </td>
                                                        <td>
                                                            {{ $student->number_phone }}
                                                        </td>
                                                        <td>
                                                            {{ $task->delivery_date }}
                                                        </td>
                                                        <td>
                                                            {{ substr($course->name,0,-2) }}
                                                                            @foreach ($classrooms as $classroom)
                                                                                @if ($course->classrooms_id == $classroom->id)
                                                                                    {{ $classroom->grade }}
                                                                                    "{{ $classroom->section }}"
                                                                                @endif
                                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <img src="{{ asset('argon/img/photos/' . $task->photo) }}"
                                                                alt="{{ $task->name }}" class="img-fluid" width="150">
                                                        </td>


                                                    </tr>
                                                    @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <td>
                        <a href="{{ route('send_task', $task->id) }}"
                            class="btn btn-outline-primary">Enviar</a>
                    </td>
                    <td>
                        <a href="{{ route('tasks.index') }}"
                            class="btn btn-outline-primary">Cancelar</a>
                    </td>
                </div>
            </div>
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
