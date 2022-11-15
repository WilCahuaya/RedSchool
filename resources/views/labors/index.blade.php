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

                                </div>
                                <div class="col-xl-6 col-lg-6 pr-3">
                                    <form action="{{ route('labors.index') }}" method="GET">
                                        @csrf
                                        <div class=" d-flex justify-content-between ">
                                            <div class="container ">
                                                <select name="idcurso" class="form-select form-control"
                                                    aria-label="Default select example">
                                                    @foreach ($courses as $course)
                                                        @foreach ($teachers as $teacher)
                                                            @if ($teacher->id == $course->teachers_id)
                                                                @if ($teacher->email == auth()->user()->email)
                                                                    <option value="{{ $course->id }}">
                                                                        {{ substr($course->name, 0, -2) }}
                                                                        @foreach ($classrooms as $classroom)
                                                                            @if ($classroom->id == $course->classrooms_id)
                                                                                {{ $classroom->grade }}
                                                                                "{{ $classroom->section }}"
                                                                            @endif
                                                                        @endforeach
                                                                    </option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="container">
                                                <select name="bimestre" class="form-select form-control"
                                                    aria-label="Default select example">
                                                    <option value="1">
                                                        Primer Bimestre
                                                    </option>
                                                    <option value="2">
                                                        Segundo Bimestre
                                                    </option>
                                                    <option value="3">
                                                        Tercer Bimestre
                                                    </option>
                                                    <option value="4">
                                                        Cuarto Bimestre
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="container">
                                                <input type="submit" value="Buscar Tarea" class="btn btn-primary ml-2">
                                            </div>
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
                        @if ($idcurso==null)
                        <h2 class="mb-0">Todas las tareas realizadas por los estudiantes</h2>

                        @else
                        <h2 class="mb-0 ">Tareas realizadas por los estudiantes del salón <strong class="text-primary">{{ substr($coursef->name,0,-2) }} @foreach ($classrooms as $classroom)
                            @if ($coursef->classrooms_id == $classroom->id)
                                {{ $classroom->grade }} "{{ strtoupper($classroom->section) }}"</strong> del <strong class="text-primary">{{ $bimestreNombre }}</strong>
                            @endif
                        @endforeach</h2>
                        @endif

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
                                @if ($idcurso == null)
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
                                                                                <a href="{{ route('calificar_labors', $labor->id) }}"
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
                                @else
                                    @if (count($labors) <= 0)
                                        <tr>
                                            <td colspan="6">No hay resultados</td>
                                        </tr>
                                    @else
                                        @foreach ($teachers as $teacher)
                                            @if ($teacher->email == auth()->user()->email)
                                                @if ($teacher->id == $coursef->teachers_id)
                                                    @foreach ($labors as $labor)
                                                        @foreach ($classrooms as $classroom)
                                                            @if ($classroom->id == $coursef->classrooms_id)
                                                                @if (substr($labor->reception_code, 0, 4) == substr($coursef->name, -2) . strval($classroom->grade) . strtoupper($classroom->section))
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
                                                                                alt="{{ $labor->reception_code }}"
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
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                @endif


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
