@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>
    <div class="header bg-muted pb-6">
        <div class="container-fluid">
                <div class="header-body">
                    <div class="d-flex p-4">
                        <div class="col-lg-12 col-7 ">
                            <h1 class="mb-0">Descripcion de la Tarea <strong class="text-primary">{{ $task->name }}</strong></h1>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around mb-2">
                        <div class=" container">
                            <div class=" p-4 " style="border-style:dashed;">
                                <img src="{{ asset('argon/img/photos/'.$task->photo) }}" alt="{{ $task->name }}" class="img-fluid" width="450">
                            </div>
                        </div>
                        <div class=" container ">
                            <div class="p-4 w-100 " >

                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" value="{{ $task->name }}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea type="textarea" class="form-control" value="" readonly="readonly" rows="3">{{ $task->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="reception_code">Codigo de recepción</label>
                                    <input type="text" class="form-control" value="{{ $task->reception_code }}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="created_date">Fecha de creación</label>
                                    <input type="text" class="form-control" value="{{ $task->created_date }}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="delivery_date">Fecha de entrega</label>
                                    <input type="text" class="form-control" value="{{ $task->delivery_date }}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label for="delivery_date">Curso</label>
                                    <input type="text" class="form-control" value="{{ $name_course }}" readonly="readonly">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="d-flex justify-content-end">
                        <div class="col-lg-10 col-6">
                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary float-right mx-sm-3 my-sm-0">Cancelar</a>
                            <a href="{{ route('sendtask',$task->id) }}" class="btn btn-outline-primary float-right">Enviar</a>
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

