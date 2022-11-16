<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-default h-70" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center ">
            <a class="navbar-brand text-white" href="javascript:void(0)">
                RED SCHOOL
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class=" nav-item">
                        <a class=" nav-link text-white " href="{{ route('home') }}">
                            <i class="ni ni-tv-2"></i> {{ __('Home') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('student') }}">
                            <i class="ni ni-hat-3 "></i>{{ __('Alumno') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('teacher') }}">
                            <i class="ni ni-circle-08"></i>{{ __('Profesor') }}
                        </a>
                    </li>


                    <li class="nav-item ">
                        <a class="nav-link text-white" href="{{ route('classroom') }}">
                            <i class="ni ni-book-bookmark "></i> {{ __('Salon') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-white" href="{{ route('tutor') }}">
                            <i class="ni ni-single-02 "></i> {{ __('Padres') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-white" href="{{ route('roles.index') }}">
                            <i class="ni ni-badge"></i> {{ __('Roles') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('user.index') }}">
                            <i class="ni ni-circle-08"></i>{{ __('Usuarios') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('courses.index') }}">
                            <i class="ni ni-book-bookmark"></i>{{ __('Cursos') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('matriculas.index') }}">
                            <i class="ni ni-bullet-list-67"></i>{{ __('Matricula') }}
                        </a>
                    </li>

                    <li class="nav-item mb-5 mr-4 ml-4 pl-1 bg-gray" style="position: absolute; bottom: 0;">

                        <a href="{{ route('logout') }}" class="dropdown-item nav-link text-white" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            <span>{{ __('Cerrar Sesión') }}</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">

            </div>
        </div>
    </div>
</nav>
