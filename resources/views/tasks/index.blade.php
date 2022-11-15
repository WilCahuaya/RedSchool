@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>
    <!-- Header -->
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <div class="header-body d-flex justify-content-between">
                <div class="col-lg-4 pt-4">
                    <a href="{{ route('tasks.create') }}" class="btn btn-neutral bg-primary text-white">+ AÑADIR
                        TAREA</a>
                </div>
                <div class="header bg-gradient-white mt-4 col-lg-6 px-0">
                    <div class="container-fluid  mx-0">
                        <div class="header-body mx-0">
                            <!-- Card stats -->

                            <form action="{{ route('tasks.index') }}" method="GET">
                                @csrf
                                <div class=" d-flex justify-content-between  ">
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
                        @if ($idcurso== null)

                        <h2 class="mb-0">Todas las tareas para enviar a los estudiantes de todos los bimestres</h2>
                        @else
                        <h2 class="mb-0">Tareas para enviar a los estudiantes del salón de <strong class="text-primary">{{ substr($coursef->name,0,-2) }} @foreach ($classrooms as $classroom)
                            @if ($coursef->classrooms_id == $classroom->id)
                                {{ $classroom->grade }} "{{ strtoupper($classroom->section) }}"
                            @endif
                        @endforeach</strong> del <strong class="text-primary">{{ $bimestreNombre }}</strong></h2>
                        @endif

                    </div>

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Nombre</th>
                                    <th scope="col" class="sort" data-sort="name">Cod. Envio</th>
                                    <th scope="col" class="sort" data-sort="name">Fecha de Entrega</th>
                                    <th scope="col" class="sort" data-sort="name">Curso</th>
                                    <th scope="col" class="sort" data-sort="name">Imagen</th>
                                    <th scope="col">OPCIONES</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if ($idcurso == null)
                                    @foreach ($tasks as $task)
                                        @foreach ($courses as $course)
                                            @if ($course->id == $task->courses_id)
                                                @foreach ($teachers as $teacher)
                                                    @if ($teacher->id == $course->teachers_id)
                                                        @if ($teacher->email == auth()->user()->email)
                                                            @if (count($tasks) <= 0)
                                                                <tr>
                                                                    <td colspan="6">No hay resultados</td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td>
                                                                        {{ $task->name }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $task->reception_code }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $task->delivery_date }}
                                                                    </td>
                                                                    <td>
                                                                        {{ substr($course->name, 0, -2) }}
                                                                        @foreach ($classrooms as $classroom)
                                                                            @if ($course->classrooms_id == $classroom->id)
                                                                                {{ $classroom->grade }}
                                                                                "{{ $classroom->section }}"
                                                                            @endif
                                                                        @endforeach
                                                                    <td>
                                                                        <img src="{{ asset('argon/img/photos/' . $task->photo) }}"
                                                                            alt="{{ $task->name }}" class="img-fluid"
                                                                            width="150">
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('showtask', $task->id) }}"
                                                                            class="btn btn-outline-primary">Enviar</a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                                                            class="btn btn-outline-primary">Editar</a>
                                                                        <form
                                                                            action="{{ route('tasks.destroy', $task->id) }}"
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
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endforeach
                                @else
                                    @foreach ($tasks as $task)
                                        @if ($idcurso == $task->courses_id)
                                            @foreach ($teachers as $teacher)
                                                @if ($teacher->id == $coursef->teachers_id)
                                                    @if ($teacher->email == auth()->user()->email)
                                                        @if (count($tasks) <= 0)
                                                            <tr>
                                                                <td colspan="6">No hay resultados</td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td>
                                                                    {{ $task->name }}
                                                                </td>
                                                                <td>
                                                                    {{ $task->reception_code }}
                                                                </td>
                                                                <td>
                                                                    {{ $task->delivery_date }}
                                                                </td>
                                                                <td>
                                                                    {{ substr($course->name, 0, -2) }}
                                                                    @foreach ($classrooms as $classroom)
                                                                        @if ($course->classrooms_id == $classroom->id)
                                                                            {{ $classroom->grade }}
                                                                            "{{ $classroom->section }}"
                                                                        @endif
                                                                    @endforeach
                                                                <td>
                                                                    <img src="{{ asset('argon/img/photos/' . $task->photo) }}"
                                                                        alt="{{ $task->name }}" class="img-fluid"
                                                                        width="150">
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('showtask', $task->id) }}"
                                                                        class="btn btn-outline-primary">Enviar</a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                                                        class="btn btn-outline-primary">Editar</a>
                                                                    <form action="{{ route('tasks.destroy', $task->id) }}"
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
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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
