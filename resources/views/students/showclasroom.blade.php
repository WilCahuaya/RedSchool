@extends('layouts.app_teacher')
@section('content')
    <div class="main-content" id="panel">
        @include('layouts.navbars.navs.auth_teacher')
    </div>



    <div class="header bg-gradient-white pb-5 pt-5 ">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row d-flex justify-content-center">
                    @foreach ($courses as $course)
                        @foreach ($teachers as $teacher)
                            @if ($teacher->id == $course->teachers_id)
                                @if ($teacher->email == auth()->user()->email)
                                    <div class="col-xl-5 col-lg-6 m-2 " >
                                        <div class="card card-stats mb-4 mb-xl-0 bg-gradient-light">

                                            <div class="card-body">
                                                <a href="{{route('sowaulastudent', $course->id)}}">
                                                <div class="row">

                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-primary mb-0">Aula</h5>
                                                        <span
                                                            class="h2 font-weight-bold mb-0">{{ substr($course->name, 0, -2) }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class=" bg-primary text-white rounded shadow">
                                                            <p class="p-2">
                                                                @foreach ($classrooms as $classroom)
                                                                    @if ($course->classrooms_id == $classroom->id)
                                                                        {{ $classroom->grade }}
                                                                        "{{ strtoupper($classroom->section) }}"
                                                                    @endif
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
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
