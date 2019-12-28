<div class="sidebar">
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="@yield('dash')">
                <a href="{{ route('home')}}">
                    <i class="tim-icons icon-components"></i>
                    <p>Principal</p>
                </a>
            </li>
            @if (Auth::user()->permiso_id == 1 || Auth::user()->permiso_id == 2 )
            <li class="@yield('users')">
                <a href="{{route('users')}}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Usuarios</p>
                </a>
            </li>
            <li class="@yield('clientes')">
                <a href="{{ route('clientes') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Clientes</p>
                </a>
            </li>
            <li class="@yield('reportes')">
                <a href="{{ route('reportes') }}">
                    <i class="tim-icons icon-key-25"></i>
                    <p>Reportes</p>
                </a>
            </li>
            <li class="@yield('permisos')">
                <a href="{{ route('permisos') }}">
                    <i class="tim-icons icon-key-25"></i>
                    <p>Permisos</p>
                </a>
            </li>

            @endif
            @if (Auth::user()->permiso_id == 3)
            <li class="@yield('clientes')">
                <a href="{{ route('clientesAsistente') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Clientes</p>
                </a>
            </li>
            <li class="@yield('reportes')">
                <a href="{{ route('reportes') }}">
                    <i class="tim-icons icon-key-25"></i>
                    <p>Reportes</p>
                </a>
            </li>

            @endif

        </ul>
    </div>
</div>
