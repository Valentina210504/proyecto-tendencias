<header class="modern-topbar">
    <div class="topbar-left">
        <button class="menu-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="topbar-greeting">
            @php
                $hour = date('H');
                $greeting = $hour < 12 ? 'Buenos días' : ($hour < 18 ? 'Buenas tardes' : 'Buenas noches');
            @endphp
            <h2>{{ $greeting }}, <span class="user-name">{{ Auth::user()->name ?? 'Usuario' }}</span></h2>
            <p>Resumen de rendimiento de esta semana</p>
        </div>
    </div>

    <div class="topbar-right">
        <!-- Search -->
        <button class="topbar-icon" title="Buscar">
            <i class="fas fa-search"></i>
        </button>

        <!-- Mail -->
        <button class="topbar-icon" title="Mensajes">
            <i class="fas fa-envelope"></i>
        </button>

        <!-- Notifications -->
        <button class="topbar-icon notification-icon" title="Notificaciones">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">3</span>
        </button>

        <!-- User Profile Dropdown -->
        <div class="user-dropdown">
            <button class="user-dropdown-toggle">
                <img src="https://i.pinimg.com/originals/48/f7/eb/48f7eb72134ebb24eaddf64adfae6dfa.jpg" alt="User">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
    </div>
</header>

<!-- Page Actions Bar -->
<div class="page-actions-bar">
    <div class="breadcrumb-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                @stack('breadcrumbs')
            </ol>
        </nav>
    </div>

    <div class="page-actions">
        <button class="btn-action secondary">
            <i class="fas fa-share-alt"></i>
            Compartir
        </button>
        <button class="btn-action secondary">
            <i class="fas fa-print"></i>
            Imprimir
        </button>
        <button class="btn-action primary">
            <i class="fas fa-download"></i>
            Exportar
        </button>
    </div>
</div>

<style>
.modern-topbar {
    background: white;
    border-bottom: 1px solid #e5e7eb;
    padding: 24px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 24px;
}

.menu-toggle {
    background: none;
    border: none;
    font-size: 20px;
    color: #64748b;
    cursor: pointer;
    padding: 8px;
    border-radius: 6px;
    transition: all 0.2s;
}

.menu-toggle:hover {
    background: #f1f5f9;
    color: #1e293b;
}

.topbar-greeting h2 {
    font-size: 24px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.topbar-greeting h2 .user-name {
    color: #4A90E2;
}

.topbar-greeting p {
    font-size: 13px;
    color: #64748b;
    margin: 4px 0 0 0;
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.topbar-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: #f8fafc;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s;
    position: relative;
}

.topbar-icon:hover {
    background: #e5e7eb;
    color: #1e293b;
}

.notification-badge {
    position: absolute;
    top: 6px;
    right: 6px;
    background: #ef4444;
    color: white;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 5px;
    border-radius: 10px;
    min-width: 18px;
    text-align: center;
}

.user-dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
    border-radius: 8px;
    transition: all 0.2s;
}

.user-dropdown-toggle:hover {
    background: #f8fafc;
}

.user-dropdown-toggle img {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e5e7eb;
}

.user-dropdown-toggle i {
    font-size: 12px;
    color: #94a3b8;
}

/* Page Actions Bar */
.page-actions-bar {
    background: white;
    border-bottom: 1px solid #e5e7eb;
    padding: 16px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.breadcrumb-wrapper {
    flex: 1;
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
    font-size: 13px;
}

.breadcrumb-item {
    color: #64748b;
}

.breadcrumb-item a {
    color: #4A90E2;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: #1e293b;
    font-weight: 500;
}

.page-actions {
    display: flex;
    gap: 8px;
}

.btn-action {
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
}

.btn-action i {
    font-size: 12px;
}

.btn-action.secondary {
    background: #f8fafc;
    color: #64748b;
}

.btn-action.secondary:hover {
    background: #e5e7eb;
    color: #1e293b;
}

.btn-action.primary {
    background: #4A90E2;
    color: white;
}

.btn-action.primary:hover {
    background: #357ABD;
}

/* Responsive */
@media (max-width: 768px) {
    .modern-topbar {
        padding: 16px;
    }
    
    .topbar-greeting h2 {
        font-size: 18px;
    }
    
    .topbar-greeting p {
        display: none;
    }
    
    .page-actions-bar {
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
    }
    
    .page-actions {
        width: 100%;
        flex-wrap: wrap;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.modern-sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
});
</script>
