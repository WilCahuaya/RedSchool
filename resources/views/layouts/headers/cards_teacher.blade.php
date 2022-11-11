<div class="header bg-gradient-primary pb-8 pt-2 pt-md-4">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Cursos</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $countcourses }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-right"></i>
                                    {{ round(($countcourses * 100) / $courses->count()) }}%</span>
                                <span class="text-nowrap">de los cursos</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Estudiantes</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $countstudents }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fas fa-arrow-right"></i>
                                    {{ round(($countstudents * 100) / $students->count()) }}%</span>
                                <span class="text-nowrap">de los estudiantes</span>
                            </p>


                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Notas bajas</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $countnotabaja }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                @if ($countlabors == 0)
                                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 0%</span>
                                @else
                                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i>
                                        {{ round(($countnotabaja * 100) / $countlabors) }}%</span>
                                @endif
                                <span class="text-nowrap">de estudiantes</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">notas altas</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $countnotaalta }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                @if ($countlabors == 0)
                                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 0%</span>
                                @else
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                                        {{ round(($countnotaalta * 100) / $countlabors) }}%</span>
                                @endif
                                <span class="text-nowrap">de estudiantes</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
