@extends('layouts.app_admin')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_admin')
    </div>
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
            <form action="/classroom/{{ $classroom->id }}/update" method="POST">
                {{-- Agrega un tocken para que pueda pasar al sistema de segurida de laravel --}}
                @csrf
                @method('put')
                <div class="header-body">
                    <div class="d-flex p-4">
                        <div class="col-lg-12 col-7 ">
                            <h1 class="mb-0">Editar los datos del salon: {{ $classroom->grade }}
                                "{{ $classroom->section }}"</h1>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-left mx-sm-5 my-sm-2">
                        <div class="col-lg-10 col-7 p-4 " style="border-style:dashed;">

                            {{-- <div class="form-group">
                            <label for="curso">Curso</label>
                            <input type="text" class="form-control" id="curso" name="curso"
                                value="Comunicación">
                        </div> --}}
                            <div class="form-group">
                                <label for="grade">Grado</label>
                                <input type="text" class="form-control" id="grade" name="grade"
                                    value="{{ $classroom->grade }}">
                            </div>
                            @error('grade')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo Grado solo debe contener numero y de solo un digito
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="section">Sección</label>
                                <input type="text" class="form-control" id="section" name="section"
                                    value="{{ $classroom->section }}">
                            </div>
                            @error('section')
                                <div class="mx-3 alert alert-danger" role="alert">
                                    El campo Sección solo debe contener letras y de solo un carcter
                                </div>
                            @enderror
                            <div class="form-group">
                                <label for="is_active">Estado</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        @if ($classroom->is_active == 1) checked @endif>
                                    <label class="form-check-label" for="is_active">Activo</label>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                            <label for="NRC">NRC</label>
                            <input type="text" class="form-control" id="NRC" name="NRC"
                                value="com5d">
                        </div> --}}

                        </div>
                    </div>
                    <div class="d-flex ">
                        <div class="col-lg-10 col-6">
                            <a href="{{ route('classroom') }}" type="button"
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
