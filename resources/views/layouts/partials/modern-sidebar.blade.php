<aside class="modern-sidebar">
    <!-- Logo / Brand -->
    <div class="sidebar-brand">
        <div class="brand-logo">
            <i class="fas fa-truck" style="font-size: 24px;"></i>
        </div>
        <div class="brand-text">
            <h3>FlotaVehiculo</h3>
            <p>Admin Panel</p>
        </div>
    </div>

    <!-- User Profile -->
    <div class="sidebar-user">
        <div class="user-avatar">
            <img src="https://i.pinimg.com/originals/48/f7/eb/48f7eb72134ebb24eaddf64adfae6dfa.jpg" alt="User">
        </div>
        <div class="user-info">
            <h4>{{ Auth::user()->name ?? 'Usuario' }}</h4>
            <p>{{ Auth::user()->email ?? 'usuario@example.com' }}</p>
        </div>
    </div>

    <!-- Search Box -->
    <div class="sidebar-search">
        <div class="search-input-wrapper">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar..." id="sidebarSearch">
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        <!-- Dashboard -->
        <a href="{{ route('home') }}" class="nav-item {{ Request::is('home') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>

        <!-- Vehículos Section -->
        <div class="nav-section">
            <div class="section-title">VEHÍCULOS</div>
            
            <a href="{{ route('vehiculos.index') }}" class="nav-item {{ Request::is('vehiculos*') ? 'active' : '' }}">
                <i class="fas fa-car"></i>
                <span>Vehículos</span>
            </a>
            
            <a href="{{ route('tipo_vehiculos.index') }}" class="nav-item {{ Request::is('tipo_vehiculos*') ? 'active' : '' }}">
                <i class="fas fa-truck"></i>
                <span>Tipo Vehículos</span>
            </a>
            
            <a href="{{ route('marcas.index') }}" class="nav-item {{ Request::is('marcas*') ? 'active' : '' }}">
                <i class="fas fa-tag"></i>
                <span>Marcas</span>
            </a>
        </div>

        <!-- Operaciones Section -->
        <div class="nav-section">
            <div class="section-title">OPERACIONES</div>
            
            <a href="{{ route('viajes.index') }}" class="nav-item {{ Request::is('viajes*') ? 'active' : '' }}">
                <i class="fas fa-route"></i>
                <span>Viajes</span>
            </a>
            
            <a href="{{ route('rutas.index') }}" class="nav-item {{ Request::is('rutas*') ? 'active' : '' }}">
                <i class="fas fa-map-marked-alt"></i>
                <span>Rutas</span>
            </a>
            
            <a href="{{ route('recarga_combustibles.index') }}" class="nav-item {{ Request::is('recarga_combustibles*') ? 'active' : '' }}">
                <i class="fas fa-gas-pump"></i>
                <span>Recarga Combustible</span>
            </a>
        </div>

        <!-- Personal Section -->
        <div class="nav-section">
            <div class="section-title">PERSONAL</div>
            
            <a href="{{ route('conductores.index') }}" class="nav-item {{ Request::is('conductores*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i>
                <span>Conductores</span>
            </a>
            
            <a href="{{ route('licencias.index') }}" class="nav-item {{ Request::is('licencias*') ? 'active' : '' }}">
                <i class="fas fa-id-card"></i>
                <span>Licencias</span>
            </a>
        </div>

        <!-- Contratos Section -->
        <div class="nav-section">
            <div class="section-title">CONTRATOS</div>
            
            <a href="{{ route('contratos.index') }}" class="nav-item {{ Request::is('contratos*') ? 'active' : '' }}">
                <i class="fas fa-file-contract"></i>
                <span>Contratos</span>
            </a>
            
            <a href="{{ route('empresas.index') }}" class="nav-item {{ Request::is('empresas*') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                <span>Empresas</span>
            </a>
        </div>
    </nav>

    <!-- Logout at bottom -->
    <div class="sidebar-footer">
        <a href="{{ route('logout') }}" class="nav-item logout-btn"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar Sesión</span>
        </a>
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
            @csrf
        </form>
    </div>
</aside>

<style>
.modern-sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 260px;
    height: 100vh;
    background: linear-gradient(180deg, #4A90E2 0%, #357ABD 100%);
    color: white;
    overflow-y: auto;
    z-index: 1000;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

/* Custom Scrollbar */
.modern-sidebar::-webkit-scrollbar {
    width: 6px;
}

.modern-sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.modern-sidebar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
}

.modern-sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}

/* Brand / Logo */
.sidebar-brand {
    display: flex;
    align-items: center;
    padding: 24px 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.brand-logo {
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
}

.brand-text h3 {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    color: white;
}

.brand-text p {
    font-size: 11px;
    margin: 0;
    color: rgba(255, 255, 255, 0.7);
}

/* User Profile */
.sidebar-user {
    display: flex;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.user-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 12px;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-info h4 {
    font-size: 14px;
    font-weight: 600;
    margin: 0;
    color: white;
}

.user-info p {
    font-size: 11px;
    margin: 0;
    color: rgba(255, 255, 255, 0.7);
}

/* Search */
.sidebar-search {
    padding: 16px 20px;
}

.search-input-wrapper {
    position: relative;
}

.search-input-wrapper i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.5);
    font-size: 14px;
}

.search-input-wrapper input {
    width: 100%;
    padding: 10px 12px 10px 36px;
    border: none;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.15);
    color: white;
    font-size: 13px;
    outline: none;
    transition: all 0.3s;
}

.search-input-wrapper input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.search-input-wrapper input:focus {
    background: rgba(255, 255, 255, 0.25);
}

/* Navigation */
.sidebar-nav {
    padding: 16px 0;
}

.nav-section {
    margin-bottom: 24px;
}

.section-title {
    padding: 12px 20px 8px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    color: rgba(255, 255, 255, 0.6);
    text-transform: uppercase;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    transition: all 0.3s;
    position: relative;
    font-size: 14px;
}

.nav-item i {
    width: 20px;
    margin-right: 12px;
    font-size: 16px;
}

.nav-item:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.nav-item.active {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    font-weight: 600;
}

.nav-item.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: white;
}

/* Footer / Logout */
.sidebar-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 16px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(0, 0, 0, 0.1);
}

.logout-btn {
    color: rgba(255, 255, 255, 0.85) !important;
}

.logout-btn:hover {
    background: rgba(255, 0, 0, 0.2) !important;
    color: white !important;
}

/* Responsive */
@media (max-width: 768px) {
    .modern-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s;
    }
    
    .modern-sidebar.show {
        transform: translateX(0);
    }
}
</style>
