        <div class="sidebar collapsed" id="sidebar">
            <a onclick="window.location.href='{{ route('admin.dashboard') }}'" class="nav_link">
                <i class="fa-solid fa-house"></i>
                <span class="span-subtittle">Inicio</span>
            </a>
            <a onclick="window.location.href='{{ route('admin.dashboard') }}'" class="nav_link">
                <i class="fa-solid fa-user"></i>
                <span class="span-subtittle">Perfil</span>
            </a>
            <a onclick="window.location.href='{{ route('admin.productos.index') }}'" class="nav_link">
                <i class="fa-solid fa-box"></i>
                <span class="span-subtittle">Productos</span>
            </a>
            <a onclick="window.location.href='{{ route('admin.dashboard') }}'" class="nav_link">
                <i class="fa-solid fa-paper-plane"></i>
                <span class="span-subtittle">Reportes</span>
            </a>
            <a onclick="window.location.href='{{ route('admin.dashboard') }}'" class="nav_link">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="span-subtittle">Compras</span>
            </a>
            <a onclick="window.location.href='{{ route('admin.dashboard') }}'" class="nav_link">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span class="span-subtittle">Inventario</span>
            </a>
            <a onclick="window.location.href='{{ route('admin.dashboard') }}'" class="nav_link">
                <i class="fa-solid fa-receipt"></i>
                <span class="span-subtittle">Ventas</span>
            </a>
            <a onclick="window.location.href='{{ route('admin.usuarios.index') }}'" class="nav_link">
                <i class="fa-solid fa-users"></i>
                <span class="span-subtittle">Usuarios</span>
            </a>
            <a onclick="window.location.href='{{ route('admin.dashboard') }}'" class="nav_link">
                <i class="fa-solid fa-hand-holding-heart"></i>
                <span class="span-subtittle">Clientes</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="nav_link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="span-subtittle">Cerrar Sesión</span>
            </a>
            <div class="user-profile">
                <span class="span-subtittle" style="color: aliceblue">{{ Auth::user()->user }}
                    ('{{ Auth::user()->rol->nombre_rol }}')</span>
            </div>
        </div>
        <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
