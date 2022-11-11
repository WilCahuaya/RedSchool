@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>

    <!-- Header -->
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="d-flex p-4">
                    <div class="col-lg-6 col-7">
                        <form action="{{ route('filtrar_tutors') }}" method="POST">
                            @csrf
                            <div class="container d-flex p-0">
                                <select name="courses_id" class="form-select form-control"
                                    aria-label="Default select example">
                                    @foreach ($courses as $course)
                                        @foreach ($teachers as $teacher)
                                            @if ($teacher->id == $course->teachers_id)
                                                @if ($teacher->email == auth()->user()->email)
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
                                <input type="submit" value="Buscar Aula" class="btn btn-primary ml-2">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-5 text-right ">

                        <form action="{{ route('showtutor') }}" method="GET">
                            <div class="container d-flex">
                                <input name="busqueda" class="form-control" placeholder="Buscar Padre" type="text"
                                    value="{{ $busqueda }}">
                                <input type="submit" value="Buscar" class="btn btn-primary ml-2">
                            </div>
                        </form>
                    </div>
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
                        <h3 class="mb-0">Padres</h3>
                    </div>

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">DNI</th>
                                    <th scope="col" class="sort" data-sort="budget">CELULAR</th>
                                    <th scope="col" class="sort" data-sort="status">APELLIDOS Y NOMBRES
                                    </th>
                                    <th scope="col" class="sort" data-sort="status">CORREO ELECTRONICO
                                    </th>
                                    <th scope="col" class="sort" data-sort="status">Estado</th>
                                    <th scope="col">OPCIONES</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($teachers as $teacher)
                                    @if ($teacher->email == auth()->user()->email)
                                        @foreach ($courses as $course)
                                            @if ($course->teachers_id == $teacher->id)
                                                @foreach ($matriculas as $matricula)
                                                    @if ($matricula->courses_id == $course->id)
                                                        @foreach ($students as $student)
                                                            @if ($matricula->students_id == $student->id)
                                                                @foreach ($tutors as $tutor)
                                                                    @if ($student->tutors_id == $tutor->id)
                                                                        @if (count($tutors) <= 0)
                                                                            <tr>
                                                                                <td colspan="5">No hay resultados</td>
                                                                            </tr>
                                                                        @else
                                                                            <tr>
                                                                                <td>
                                                                                    {{ $tutor->DNI }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $tutor->number_phone }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $tutor->name }}
                                                                                    {{ $tutor->surname }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $tutor->email }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($tutor->is_active == true)
                                                                                        Activo
                                                                                    @else
                                                                                        Inactivo
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    <a href="/tutor/{{ $tutor->id }}"
                                                                                        class="btn btn-outline-primary">Editar</a>
                                                                                </td>
                                                                                <td>
                                                                                    <form
                                                                                        action="/tutor/{{ $tutor->id }}/condition"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('put')

                                                                                        <button type="submit"
                                                                                            onclick="return confirm('Seguro que desea dar de baja')"
                                                                                            class="btn btn-outline-primary">Dar
                                                                                            de baja</button>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $tutors->links() !!}
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
