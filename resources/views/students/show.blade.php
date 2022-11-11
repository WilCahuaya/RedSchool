@extends('layouts.app_admin')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_admin')
    </div>
    <div class="bg-muted m-4">
        <div class="text-center m-4 ">
            <h1>Datos del estudiante: {{ $student->name }}
                {{ $student->surname }}</h1>
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-lg-8  d-flex justify-content-center" style="border-style:dashed;">
                <div class="d-flex flex-column m-4">
                    <div class="m-4 ">
                        <h2 class="text-primary">Datos personales del estudiante</h2>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>Nombre: </strong> {{ $student->name }} {{ $student->surname }}
                        </div>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>DNI: </strong> {{ $student->DNI }}
                        </div>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>Celular: </strong> {{ $student->number_phone }}
                        </div>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>Email: </strong> {{ $student->email }}
                        </div>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>Estado: </strong>
                            @if ($student->is_active == true)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </div>
                    </div>
                    <div>
                        <hr class="my-4" />
                    </div>

                    <div class="m-4 ">
                        <h2 class="text-primary">Datos personales del apoderado</h2>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>Nombre: </strong> {{ $tutor->name }} {{ $tutor->surname }}
                        </div>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>DNI: </strong> {{ $tutor->DNI }}
                        </div>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>Celular: </strong> {{ $tutor->number_phone }}
                        </div>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>Email: </strong> {{ $tutor->email }}
                        </div>
                    </div>
                    <div class="container">
                        <div class="container">
                            <strong>Estado: </strong>
                            @if ($tutor->is_active == true)
                                Activo
                            @else
                                Inactivo
                            @endif
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
