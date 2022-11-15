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
                    <div class="col-lg-6 col-7  ">

                    </div>
                    <div class="col-lg-6 col-5 text-right ">
                        <form action="{{ route('sowaulastudent',$course->id) }}" method="GET">
                            <div class="container d-flex">
                                <input name="busqueda" class="form-control" placeholder="Buscar Alumno" type="text"
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
                        <h3 class="mb-0">Estudiantes</h3>
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
                                @foreach ($matriculas as $matricula)
                                    @if ($matricula->courses_id == $course->id)
                                        @foreach ($students as $student)
                                            @if ($matricula->students_id == $student->id)
                                                @if (count($students) <= 0)
                                                    <tr>
                                                        <td colspan="5">No hay resultados</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>
                                                            {{ $student->DNI }}
                                                        </td>
                                                        <td>
                                                            {{ $student->number_phone }}
                                                        </td>
                                                        <td>
                                                            {{ $student->name }} {{ $student->surname }}
                                                        </td>
                                                        <td>
                                                            {{ $student->email }}
                                                        </td>
                                                        <td>
                                                            @if ($student->is_active == true)
                                                                Activo
                                                            @else
                                                                Inactivo
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('studentshowviewtutor', $student->id) }}"
                                                                class="btn btn-outline-primary">Ver</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach


                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $students->links() !!}
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
