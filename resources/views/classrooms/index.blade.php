@extends('layouts.app_admin')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_admin')
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar archivo de excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('importclassroom') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="clo-md-6">
                            <input type="file" name="documento">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Importar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Header -->
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="d-flex p-4">
                    <div class="col-lg-6 col-7  ">
                        <button type="button" class="btn btn-neutral bg-primary text-white" data-toggle="modal"
                            data-target="#exampleModalCenter">+ AÑADIR SALON</button>
                    </div>
                    <div class="col-lg-6 col-5 text-right ">
                        <form action="{{ route('classroom') }}" method="GET">
                            <div class="container d-flex">
                                <input name="busqueda" class="form-control" placeholder="Buscar Alumno" type="text"
                                    value="{{ $busqueda }}">
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
                @error('documento')
                    <div class="mx-3 alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                @if (session()->has('failures'))
                    <div class="mx-3 alert alert-danger" role="alert">
                        No se pudo importar estas filas por estos errores
                    </div>
                    <table class="table table-danger">
                        <tr>
                            <th>Fila</th>
                            <th>Columna</th>
                            <th>Errores</th>
                            <th>Value</th>
                        </tr>

                        @foreach (session()->get('failures') as $validation)
                            <tr>
                                <td>{{ $validation->row() }}</td>
                                <td>{{ $validation->attribute() }}</td>
                                <td>
                                    <ul>
                                        @foreach ($validation->errors() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    {{ $validation->values()[$validation->attribute()] }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
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
                        <h3 class="mb-0">Salones</h3>
                    </div>

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    {{-- <th scope="col" class="sort" data-sort="name">Nombre</th> --}}
                                    <th scope="col" class="sort" data-sort="budget">GRADO</th>
                                    <th scope="col" class="sort" data-sort="status">SECCIÓN</th>
                                    <th scope="col" class="sort" data-sort="status">ESTADO</th>
                                    </th>
                                    {{-- <th scope="col" class="sort" data-sort="status">NRC</th>                                        </th> --}}
                                    <th scope="col">OPCIONES</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($classrooms) <= 0)
                                    <tr>
                                        <td colspan="5">No hay resultados</td>
                                    </tr>
                                @else
                                    @foreach ($classrooms as $classroom)
                                        <tr>
                                            <td>
                                                {{ $classroom->grade }}
                                            </td>
                                            <td>
                                                {{ $classroom->section }}
                                            </td>
                                            <td>
                                                @if ($classroom->is_active == true)
                                                    Activo
                                                @else
                                                    Inactivo
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/classroom/{{ $classroom->id }}"
                                                    class="btn btn-outline-primary">Editar</a>
                                            </td>
                                            <td>
                                                <form action="/classroom/{{ $classroom->id }}/condition" method="POST">
                                                    @csrf
                                                    @method('put')

                                                    <button type="submit"
                                                        onclick="return confirm('Seguro que desea dar de baja')"
                                                        class="btn btn-outline-primary">Dar de baja</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $classrooms->links() !!}
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
