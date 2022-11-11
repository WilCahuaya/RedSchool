@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>
    <form action="{{ route('labors.update', $labor->id) }}" method="post">
        @csrf
        @method('put')
        {{-- Modal --}}
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Enviar Calificación</h5>
                    </div>

                    <div class="modal-body">
                        <label for="is_active">Enviar a:</label>

                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="student" name="student">
                                <label class="form-check-label" for="student">Estudiante</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="tutor" name="tutor">
                                <label class="form-check-label" for="tutor">Apoderado</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="header bg-muted pb-6">
            <div class="container-fluid">
                {{-- <form action="{{ route('labors.update', $labor->id) }}" method="post">
                @csrf
                @method('put') --}}
                <div class="header-body">
                    @foreach ($tasks as $task)
                        @if ($task->reception_code == $labor->reception_code)
                            @foreach ($students as $student)
                                @if ($labor->students_id == $student->id)
                                    <div class="d-flex p-4">
                                        <div class="col-lg-12 col-7 ">

                                            <h2 class="mb-0">Recepción de la tarea "{{ $task->name }}" enviada por el
                                                estudiante {{ $student->name }} {{ $student->surname }}</h2>

                                        </div>                                        
                                    </div>
                                    @if (session('success'))
                                            <div class="alert alert-danger">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                    <div class="d-flex justify-content-around mb-2">
                                        <div class="d-flex justify-content-between m-0 col-7">
                                            <div class=" p-4 " style="border-style:dashed;">
                                                <img src="{{ $labor->photo }}" alt="{{ $labor->reception_code }}"
                                                    class="img-fluid" width="450">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-left m-0 col-5 ">
                                            <div class="p-4 w-100 " style="border-style:dashed;">

                                                <div class="form-group">
                                                    <label for="reception_code">Nombre de la tarea</label>
                                                    <input type="text" class="form-control" value="{{ $task->name }} "
                                                        readonly="readonly">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reception_code">Descripción</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $task->description }} " readonly="readonly">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reception_code">Código de Envio</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $labor->reception_code }} " readonly="disable">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reception_code">Fecha enviada</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $task->created_date }} " readonly="readonly">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reception_code">Fecha de entrega</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $task->delivery_date }} " readonly="readonly">
                                                </div>
                                                <div class="form-group">
                                                    <label for="created_date">Fecha de la recepción</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $labor->delivery_date }}" readonly="readonly">
                                                </div>
                                                <div class="form-group">
                                                    <label for="note">Nota</label>
                                                    <input type="text" class="form-control" id="note" name="note"
                                                        value="{{ $labor->note }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="feedback">Retroalimentación</label>
                                                    <textarea type="textarea" class="form-control" id="feedback" name="feedback" rows="3">{{ $labor->feedback }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    <br>
                    <div class="d-flex justify-content-end">
                        <div class="col-lg-10 col-6">
                            <button type="button" class="btn btn-outline-primary float-right mx-sm-3 my-sm-0"
                                data-toggle="modal" data-target="#exampleModalCenter">Calificar y Enviar Nota</button>
                            <a href="{{ route('labors.index') }}"
                                class="btn btn-outline-primary float-right mx-sm-3 my-sm-0">Cancelar</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <div class="container">
        @include('layouts.footers.auth')
    </div>
@endsection


@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
