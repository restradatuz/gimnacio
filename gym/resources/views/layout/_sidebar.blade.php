<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <!--<li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <span class="menu-title">Inicio</span>
        <i class="icon-screen-desktop menu-icon"></i>
      </a>
    </li>-->

    @if(Auth::user()->user_type == 1)

    <li class="nav-item">
      <a class="nav-link" href="{{ route('sucursales') }}">
        <span class="menu-title">Sucursales</span>
        <i class="icon-home menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('usuarios') }}">
        <span class="menu-title">Usuarios</span>
        <i class="icon-user menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('clientes') }}">
        <span class="menu-title">Clientes</span>
        <i class="icon-people menu-icon"></i>
      </a>
    </li>

    

     <li class="nav-item">
      <a class="nav-link" href="{{ route('nuevousuarioadmn') }}">
        <span class="menu-title">Altas</span>
        <i class="icon-user-follow menu-icon"></i>
      </a>
    </li>

    @elseif(Auth::user()->user_type == 3)

     <li class="nav-item">
      <a class="nav-link" href="{{ route('clientesSC') }}">
        <span class="menu-title">Clientes</span>
        <i class="icon-people menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('nuevousuario') }}">
        <span class="menu-title">Altas</span>
        <i class="icon-user-follow menu-icon"></i>
      </a>
    </li>

     <li class="nav-item">
      <a class="nav-link"   href="{{ route('reservaciones') }}">
        <span class="menu-title">Reservaciones</span>
        <i class="icon-list menu-icon"></i>
      </a>
    </li>


    @elseif(Auth::user()->user_type == 4)


    <li class="nav-item">
      <a class="nav-link" href="{{ route('usuarios-gerente') }}">
        <span class="menu-title">Usuarios</span>
        <i class="icon-user menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('clientesgerente') }}">
        <span class="menu-title">Clientes</span>
        <i class="icon-people menu-icon"></i>
      </a>
    </li>

    <!--<li class="nav-item">
      <a class="nav-link" href="{{ route('nuevousuario') }}">
        <span class="menu-title">Altas</span>
        <i class="icon-user-follow menu-icon"></i>
      </a>
    </li>
  -->
     <li class="nav-item">
      <a class="nav-link" href="{{ route('nuevousuarioadmn') }}">
        <span class="menu-title">Altas</span>
        <i class="icon-user-follow menu-icon"></i>
      </a>
    </li>


     <li class="nav-item">
      <a class="nav-link"   href="{{ route('uploadimagesapp') }}">
        <span class="menu-title">Subir imagenes</span>
        <i class="icon-cloud-upload menu-icon"></i>
      </a>
    </li>

     <li class="nav-item">
      <a class="nav-link"   href="{{ route('reglas') }}">
        <span class="menu-title">Reglas negocio</span>
        <i class="icon-settings menu-icon"></i>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link"   href="{{ route('diassemana') }}">
        <span class="menu-title">Dias semana</span>
        <i class="icon-calendar menu-icon"></i>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link"   href="{{ route('horarios') }}">
        <span class="menu-title">Horarios</span>
        <i class="icon-clock menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link"   href="{{ route('crearzona') }}">
        <span class="menu-title">Ubicación</span>
        <i class="icon-location-pin menu-icon"></i>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link"   href="{{ route('reservaciones') }}">
        <span class="menu-title">Reservaciones</span>
        <i class="icon-list menu-icon"></i>
      </a>
    </li>
    @endif



    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}">
        <span class="menu-title">Salir</span>
        <i class="icon-logout menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>
