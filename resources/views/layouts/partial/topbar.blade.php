<!-- Minimalist Topbar -->
<nav class="main-header navbar navbar-expand" style="background: white; border-bottom: 1px solid #e5e7eb; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);">
    <!-- Left navbar links -->
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: #64748b;">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link" style="color: #1e293b; font-weight: 500; font-size: 14px;">
                Dashboard
            </a>
        </li>
    </ul>

    <!-- Search -->
    <div class="mx-auto d-none d-md-flex" style="width: 400px;">
        <div class="input-group" style="border-radius: 8px; overflow: hidden;">
            <input type="search" class="form-control" placeholder="Buscar vehículos, conductores..." 
                   style="border: 1px solid #e5e7eb; border-right: none; font-size: 14px; padding: 8px 16px;">
            <div class="input-group-append">
                <button class="btn" type="submit" style="background: white; border: 1px solid #e5e7eb; border-left: none; color: #64748b;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">
        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" style="color: #64748b; position: relative;">
                <i class="far fa-bell" style="font-size: 18px;"></i>
                <span class="badge badge-danger navbar-badge" style="position: absolute; top: 8px; right: 8px; font-size: 9px; padding: 2px 4px; border-radius: 10px; background: #ef4444;">3</span>
            </a>
        </li>

        <!-- User dropdown -->
        <li class="nav-item dropdown" style="margin-left: 16px;">
            <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#" style="padding: 4px 12px; border-radius: 8px; transition: background 0.2s;">
                <img src="https://i.pinimg.com/originals/48/f7/eb/48f7eb72134ebb24eaddf64adfae6dfa.jpg"
                     class="img-circle" alt="User" style="width: 32px; height: 32px; object-fit: cover; margin-right: 8px;">
                <div class="d-none d-sm-block">
                    <div style="font-size: 13px; font-weight: 600; color: #1e293b; line-height: 1.2;">
                        {{ Auth::user()->name ?? 'Alexander Pierce' }}
                    </div>
                    <div style="font-size: 11px; color: #64748b;">
                        Administrador
                    </div>
                </div>
                <i class="fas fa-chevron-down ml-2" style="font-size: 10px; color: #94a3b8;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" style="border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border-radius: 8px; margin-top: 8px; min-width: 200px;">
                <a href="#" class="dropdown-item" style="padding: 10px 16px; font-size: 14px; color: #1e293b;">
                    <i class="fas fa-user mr-2" style="color: #64748b; width: 16px;"></i>
                    Mi Perfil
                </a>
                <a href="#" class="dropdown-item" style="padding: 10px 16px; font-size: 14px; color: #1e293b;">
                    <i class="fas fa-cog mr-2" style="color: #64748b; width: 16px;"></i>
                    Configuración
                </a>
                <div class="dropdown-divider" style="margin: 4px 0;"></div>
                <a href="{{ route('logout') }}" class="dropdown-item" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   style="padding: 10px 16px; font-size: 14px; color: #dc2626;">
                    <i class="fas fa-sign-out-alt mr-2" style="width: 16px;"></i>
                    Cerrar Sesión
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<style>
/* Hover effects */
.navbar-nav .nav-link:hover {
    background: #f8fafc;
    border-radius: 6px;
}

.dropdown-item:hover {
    background: #f8fafc !important;
}

/* Remove AdminLTE default styles */
.main-header .navbar-nav .nav-link {
    padding: 8px 12px;
}

.navbar-badge {
    font-size: 9px;
    font-weight: 700;
}
</style>