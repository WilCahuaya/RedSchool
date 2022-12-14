<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-default" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="container  align-items-center">
            <a class="navbar-brand text-white" href="javascript:void(0)">
                RED SCHOOL
            </a>
        </div>
        <div class="navbar-inner ">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="nav align-items-center d-md-none">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder"
                                        src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                                </span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>{{ __('My profile') }}</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="ni ni-settings-gear-65"></i>
                                <span>{{ __('Settings') }}</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="ni ni-calendar-grid-58"></i>
                                <span>{{ __('Activity') }}</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span>{{ __('Support') }}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                <i class="ni ni-user-run"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                        </div>
                    </li>
                </ul>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class=" nav-item">
                            <a class=" nav-link text-white " href="{{ route('homeTeacher') }}">
                                <i class="ni ni-tv-2"></i> {{ __('Home') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">TAREAS EN LINEA</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('tasks.index') }}">
                                <i class="ni ni-ruler-pencil "></i>{{ __('Tareas') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('labors.index') }}">
                                <i class="ni ni-image"></i>{{ __('Tareas recibidas') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">CLASES EN LINEA</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('meetings.index') }}" target="_blank">
                                <i class="ni ni-tv-2"></i>
                                <span class="nav-link-text">Videoclases</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" target="_blank">
                                <i class="ni ni-single-copy-04"></i>
                                <span class="nav-link-text">Clases</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">CONTACTO</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="{{ route('showclasroom') }}">
                                <i class="ni ni-single-02 "></i> {{ __('Estudiantes') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" target="_blank">
                                <i class="ni ni-email-83"></i>
                                <span class="nav-link-text">Mensajes</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" target="_blank">
                                <i class="ni ni-calendar-grid-58"></i>
                                <span class="nav-link-text">Calendario</span>
                            </a>
                        </li>
                        <li class="nav-item mb-5 mr-4 ml-4 pl-1 bg-gray" style="position: absolute; bottom: 0;">

                            <a href="{{ route('logout') }}" class="dropdown-item nav-link text-white"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="ni ni-user-run"></i>
                                <span>{{ __('Cerrar Sesi??n') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</nav>
