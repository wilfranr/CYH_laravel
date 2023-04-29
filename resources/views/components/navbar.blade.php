<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home">Inicio</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Pedidos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('pedidos.create')}}">Crear Pedido</a></li>
                            <li><a class="dropdown-item" href="{{ route('pedidos.index') }}">Ver Pedidos</a></li>
                            {{-- <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Terceros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('terceros.create') }}">Crear Tercero</a></li>
                            <li><a class="dropdown-item" href="{{ route('terceros.index') }}">Ver Terceros</a></li>
                            {{-- <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Administración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('listas.index') }}">Listas</a></li>
                            <li><a class="dropdown-item" href="{{ route('maquinas.index') }}">Maquinas</a></li>
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">Usuarios</a></li>
                            <li><a class="dropdown-item" href="{{ route('listasPadre.index') }}">Listas Padre</a></li>
                            {{-- <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('articulos.index')}}" tabindex="-1" aria-disabled="true">Artículos</a>
                    </li>
                </ul>
                <form class="d-flex">

                    
                    <ul class="navbar-nav me-5 mb-2 mb-lg-0">

                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Configurar</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                                </ul>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"> </a>
                        </li>
                    </ul>
                </form>
            </div>
        @endauth
    </div>
</nav>
