@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>
    <!-- Header -->
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="col-lg-6 col-7 pt-4">
                    <a href="{{ route('tasks.create') }}" class="btn btn-neutral bg-primary text-white">+ AÑADIR
                        TAREA</a>
                </div>
                <div class="d-flex pt-4">
                    <div class="col-lg-6 col-7">
                        <form action="{{ route('filtrar_tasks') }}" method="POST">
                            @csrf
                            <div class="container d-flex p-0">
                                <select name="courses_id" class="form-select form-control"
                                    aria-label="Default select example">
                                    <option selected>Buscar Aula</option>
                                    @foreach ($courses as $course)
                                        @foreach ($teachers as $teacher)
                                            @if ($teacher->id == $course->teachers_id)
                                                @if ($teacher->email == auth()->user()->email)
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
                                </select>
                                <input type="submit" value="Buscar Aula" class="btn btn-primary ml-2">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-7 ">

                        <form action="#" method="GET">
                            <div class="container d-flex">
                                <input name="busqueda" class="form-control" placeholder="Buscar Tarea" type="text"
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
                        <h3 class="mb-0">Tareas de {{ $course_filter->name }}
                             @foreach($classrooms as $classroom)
                             @if ($classroom->id == $course_filter->classrooms_id)
                             {{ $classroom->grade }} "{{ $classroom->section }}"
                             @endif
                             @endforeach</h3>
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
                                @foreach ($tasks as $task)
                                        @if ($course_filter->id == $task->courses_id)
                                            @foreach ($teachers as $teacher)
                                                @if ($teacher->id == $course_filter->teachers_id)
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
                                                                            {{ substr($course->name,0,-2) }}
                                                                            @foreach ($classrooms as $classroom)
                                                                                @if ($course_filter->classrooms_id == $classroom->id)
                                                                                    {{ $classroom->grade }}
                                                                                    "{{ $classroom->section }}"
                                                                                @endif
                                                                            @endforeach
                                                                </td>
                                                                <td>
                                                                    <img src="{{ asset('argon/img/photos/' . $task->photo) }}"
                                                                        alt="{{ $task->name }}" class="img-fluid"
                                                                        width="150">
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('send_task', $task->id) }}"
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
