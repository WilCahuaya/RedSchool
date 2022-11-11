@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
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
                                                    value="{{ $labor->reception_code }} " readonly="readonly">
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
                        <a href="{{ route('labors.index') }}"
                            class="btn btn-outline-primary float-right mx-sm-3 my-sm-0">Cancelar</a>
                        <a href="{{ route('labors.update', $labor->id) }}"
                            class="btn btn-outline-primary float-right">Calificar</a>
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
