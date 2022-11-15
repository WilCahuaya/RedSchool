@extends('layouts.app_teacher')

@section('content')
<div class="main-content" id="panel">
    @include('layouts.navbars.navs.auth_teacher')
</div>
    @include('layouts.headers.cards_teacher')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Aulas 2022</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad Estudiantes</th>
                                    <th scope="col">Estudiantes Notas altas</th>
                                    <th scope="col">Estudiantes Notas bajas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Matematica 1 "A"
                                    </th>
                                    <td>
                                        24
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 22
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 2
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Matematica 1 "B"
                                    </th>
                                    <td>
                                        30
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 26
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 4
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Matematica 1 "C"
                                    </th>
                                    <td>
                                        21
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 21
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 0
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Matematica 1 "D"
                                    </th>
                                    <td>
                                        27
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 26
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 1
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Matematica 1 "E"
                                    </th>
                                    <td>
                                        26
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 30
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 6
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Avance de los Bimestres</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Bimestre</th>
                                    <th scope="col">semanas</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Primer Bimestre
                                    </th>
                                    <td>
                                        12.5
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Segundo Bimestre
                                    </th>
                                    <td>
                                        12
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Tercer Bimestre
                                    </th>
                                    <td>
                                        11.5
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">80%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Cuarto Bimestre
                                    </th>
                                    <td>
                                        12.5
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">75%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
    <script>
        var ctx=document.getElementById("myChart").getContext("2d");
        var ctx2=document.getElementById("myChart2").getContext("2d");
        var myChart = new Chart(ctx2, {
			type: "bar",
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				},

			},
			data: {
				labels: ['1 "A"', '1 "B"', '1 "C"'],

                datasets: [{
					label: 'Realizadas',
					data: [25, 20, 30],
                    backgroundColor:[
                        'rgba(153, 102, 255, 0.2)',
                    ]
				}]
			}
		});
        var myChart2 = new Chart(ctx, {
			type: "line",
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				},

			},
			data: {
				labels: ['1 "A"', '1 "B"', '1 "C"'],

                datasets: [{
					label: 'Enviadas',
					data: [22, 20, 30],
                    backgroundColor:[
                        'rgba(153, 102, 255, 0.2)',
                    ]
				}]
			}
		});
    </script>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
