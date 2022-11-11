@extends('layouts.app_admin')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_admin')
    </div>
    <!-- Header -->
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="d-flex p-4">
                    <div class="col-lg-6 col-7  ">
                        <a href="{{ route('roles.create') }}" class="btn btn-neutral bg-primary text-white">+ AÑADIR ROL</a>
                    </div>
                    <div class="col-lg-6 col-5 text-right ">

                        <form action="#" method="GET">
                            <div class="container d-flex">
                                <input name="busqueda" class="form-control" placeholder="Buscar Rol" type="text" value="">
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

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 md-6">
                        <h3 class="mb-0">Roles</h3>
                    </div>

                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Nombre</th>
                                    <th scope="col">OPCIONES</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($roles)<=0)
                        <tr>
                            <td colspan="5">No hay resultados</td>
                        </tr>
                        @else
                                @foreach ($roles as $rol)
                                    <tr>
                                        <td>
                                            {{ $rol->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('roles.edit',$rol->id)}}"
                                                class="btn btn-outline-primary">Editar</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('roles.destroy',$rol->id)}}" method="POST">
                                                @csrf
                                                @method('delete')

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
