@extends('layouts.app_admin')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_admin')
    </div>
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <form action="/teacher/{{ $teacher->id }}/update" method="POST">
                {{-- Agrega un tocken para que pueda pasar al sistema de segurida de laravel --}}
                @csrf
                @method('put')
                <div class="header-body">
                    <div class="d-flex p-4">
                        <div class="col-lg-12 col-7 ">
                            <h1 class="mb-0">Editar los datos del profesor(a): {{ $teacher->name }}
                                {{ $teacher->surname }}</h1>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-left mx-sm-5 my-sm-2">
                        <div class="col-lg-10 col-7 p-4 " style="border-style:dashed;">

                            <div class="form-group">
                                <label for="name">Nombres</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $teacher->name }}">
                            </div>
                            @error('name')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo nombres es obligatorio
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="surname">Apellidos</label>
                                <input type="text" class="form-control" id="surname" name="surname"
                                    value="{{ $teacher->surname }}">
                            </div>
                            @error('surname')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo apellidos es obligatorio
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="DNI">DNI</label>
                                <input type="text" class="form-control" id="DNI" name="DNI" value="{{ $teacher->DNI }}">
                            </div>
                            @error('DNI')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo DNI es obligatorio,
                                    debe tener 8 digitos y solo números
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="number_phone">Número de Celular</label>
                                <input type="text" class="form-control" id="number_phone" name="number_phone"
                                    value="{{ $teacher->number_phone }}">
                            </div>
                            @error('number_phone')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo Número de celulares obligatorio,
                                    debe tener 9 digitos y solo números
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $teacher->email }}">
                            </div>
                            @error('email')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="specialization">Especialidad</label>
                                <input type="text" class="form-control" id="specialization" name="specialization"
                                    value="{{ $teacher->specialization }}">
                            </div>
                            @error('specialization')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo Especialidad es obligatorio
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="is_active">Estado</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        @if ($teacher->is_active == 1) checked @endif>
                                    <label class="form-check-label" for="is_active">Activo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="col-lg-10 col-6">
                            <a href="{{ route('teacher') }}" type="button"
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
