@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>
    <!-- Header -->
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="header bg-gradient-white py-3">
                    <div class="container-fluid p-0">
                        <div class="header-body">
                            <!-- Card stats -->
                            <div class="row d-flex justify-content-between">
                                <div class="col-xl-6 col-lg-6 px-0 ">
                        <form action="{{ route('filtrar_labors') }}" method="POST">
                            @csrf
                            <div class="container d-flex p-0">
                                <select name="courses_id" class="form-select form-control"
                                    aria-label="Default select example">
                                    <option selected>Buscar Aula</option>
                                    @foreach ($courses as $course)
                                        @foreach ($teachers as $teacher)
                                            @if ($teacher->id == $course->teachers_id)
                                                @if ($teacher->email == auth()->user()->email)
                                                    <option value="{{ $course->id }}">{{ substr($course->name, 0, -2) }}
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
                                <input type="submit" value="Buscar Aula" class="btn btn-primary ml-2">
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-6 col-lg-6 pr-3">
                        <form action="#" method="GET">
                            <div class="container d-flex px-0">
                                <input name="busqueda" class="form-control" placeholder="Buscar Tarea" type="text"
                                    value="">
                                <input type="submit" value="Buscar Tarea" class="btn btn-primary ml-2">
                            </div>
                        </form>
                    </div>
                </div>
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
    </div>
    <!-- Page content -->

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 md-6">
                        <h3 class="mb-0">Tareas realizadas por los estudiantes</h3>
                    </div>

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Cod. Recepcion</th>
                                    <th scope="col" class="sort" data-sort="name">Nota</th>
                                    <th scope="col" class="sort" data-sort="name">Feedback</th>
                                    <th scope="col" class="sort" data-sort="name">Fecha de envió</th>
                                    <th scope="col" class="sort" data-sort="name">Estudiante</th>
                                    <th scope="col" class="sort" data-sort="name">Tarea</th>
                                    <th scope="col">OPCIONES</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">

                                @foreach ($teachers as $teacher)
                                    @if ($teacher->email == auth()->user()->email)
                                        @foreach ($courses as $course)
                                            @if ($teacher->id == $course->teachers_id)
                                                @foreach ($classrooms as $classroom)
                                                    @if ($classroom->id == $course->classrooms_id)
                                                        @foreach ($labors as $labor)
                                                            @if (substr($labor->reception_code, 0, 4) ==
                                                                substr($course->name, -2) . strval($classroom->grade) . strtoupper($classroom->section))
                                                                @if (count($labors) <= 0)
                                                                    <tr>
                                                                        <td colspan="6">No hay resultados</td>
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td>
                                                                            {{ $labor->reception_code }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $labor->note }}
                                                                        </td>
                                                                        <td>
                                                                            <span class="d-inline-block text-truncate"
                                                                                style="max-width: 140px;">
                                                                                {{ $labor->feedback }}
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            {{ $labor->delivery_date }}
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($students as $student)
                                                                                @if ($labor->students_id == $student->id)
                                                                                    {{ $student->name }}
                                                                                    {{ $student->surname }}
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td>
                                                                            <img src="{{ $labor->photo }}"
                                                                                alt="{{ $labor->creception_code }}"
                                                                                class="img-fluid" width="80">
                                                                        </td>

                                                                        <td>
                                                                            <a href="{{ route('labors.edit', $labor->id) }}"
                                                                                class="btn btn-outline-primary">Calificar</a>
                                                                            <form
                                                                                action="{{ route('labors.destroy', $labor->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('delete')

                                                                                <button type="submit"
                                                                                    onclick="return confirm('Seguro que desea dar de baja')"
                                                                                    class="btn btn-outline-primary">Borrar</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                        </div>
                    </div>

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
