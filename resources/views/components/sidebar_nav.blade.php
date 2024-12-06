<ul class="sidebar-nav">
    <!-- TITULO 1 -->
    <li class="sidebar-header">
        PRINCIPAL
    </li>
    <!-- DASHBOARD -->
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Home') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('Home.index') }}">
            <i class="align-middle" data-feather="home"></i> <span> Inicio </span>
        </a>
    </li>

    <!-- PROFILE -->
    @role('Admin')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'admin.usuarios') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('admin.usuarios.index') }}">
                <i class="align-middle" data-feather="user"></i> <span> Usuarios </span>
            </a>
        </li>
    @endrole

    @role('Admin')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'admin.perfil') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('admin.perfil.index') }}">
                <i class="align-middle" data-feather="users"></i> <span> Perfiles </span>
            </a>
        </li>
    @endrole

    <!-- SIGN IN -->
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('User.Login') }}">
            <i class="align-middle" data-feather="log-in"></i> <span> Sign In </span>
        </a>
    </li>
    <!-- TITULO 2 -->
    <li class="sidebar-header">
        MANTENEDORES
    </li>
    <!-- AQUI ES DONDE TRABAJAREMOS -->
    <!-- GESTION DE ALUMNOS -->
    @hasanyrole('Admin|Secretaria')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Alumno') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Alumno') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Registrar Matrícula </span>
            </a>
        </li>
    @endhasanyrole
    <!-- GESTION DE GRADOS -->
    @role('Admin')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Seccion') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Seccion') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Gestión Grados </span>
            </a>
        </li>
        <!-- GESTION DE CURSOS -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Curso.') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Curso') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Gestión Cursos </span>
            </a>
        </li>
        <!-- GESTION DE CURSOS POR GRADOS -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'CursoPorGrado') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/CursoPorGrado') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Cursos por Grados </span>
            </a>
        </li>
    @endrole
    <!-- GESTION DE CAPACIDADES -->
    @role('Admin')
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Capacidad') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ URL::to('/Capacidad') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Gestión Capacidades </span>
            </a>
        </li>
    @endrole
    @role('Admin')
        <!-- GESTION DE PERSONAL -->
        <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Personal') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('Personal.index') }}">
                <i class="align-middle" data-feather="check-circle"></i> <span> Gestión de Personal </span>
            </a>
        </li>
    @endrole
    <!-- GESTION DE CATEDRAS -->
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Catedra') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('Catedra.index') }}">
            <i class="align-middle" data-feather="check-circle"></i> <span> Gestión Notas </span>
        </a>
    </li>
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Catedra') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('Catedra.index') }}">
            <i class="align-middle" data-feather="check-circle"></i> <span> Reporte de Notas </span>
        </a>
    </li>
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Catedra') ? '' : '' }}">
        <a class="sidebar-link" href="{{ route('Catedra.index') }}">
            <i class="align-middle" data-feather="check-circle"></i> <span> Revisar Notas </span>
        </a>
    </li>
    <li class="sidebar-item {{ Str::startsWith(Route::currentRouteName(), 'Catedra') ? '' : '' }}">
        <a class="sidebar-link" href="{{ route('Catedra.index') }}">
            <i class="align-middle" data-feather="check-circle"></i> <span> Registrar Notas </span>
        </a>
    </li>
</ul>
