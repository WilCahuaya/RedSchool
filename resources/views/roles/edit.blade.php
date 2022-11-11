@extends('layouts.app_admin')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_admin')
    </div>
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <form action="{{ route('roles.update',$role->id) }}" method="POST">
                {{-- Agrega un tocken para que pueda pasar al sistema de segurida de laravel --}}
                @csrf
                @method('put')
                <div class="header-body">
                    <div class="d-flex p-4">
                        <div class="col-lg-12 col-7 ">
                            <h1 class="mb-0">Editar los datos del rol: {{ $role->name }}</h1>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            Datos actualizados exitosamente
                        </div>
                    @endif
                    <div class="d-flex justify-content-left mx-sm-5 my-sm-2">
                        <div class="col-lg-10 col-7 p-4 " style="border-style:dashed;">

                            <div class="form-group">
                                <label for="name">Nombres</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $role->name }}">
                            </div>
                            @error('name')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="col-lg-10 col-6">
                            <a href="{{ route('roles.index') }}" type="button"
                                class="btn btn-outline-primary float-right mx-sm-3 my-sm-0">Cancelar</a>
                            <button type="submit" class="btn btn-outline-primary float-right">Guardar</button>
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
