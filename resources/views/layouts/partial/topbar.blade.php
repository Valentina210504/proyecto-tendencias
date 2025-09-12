<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        
        <!-- UserPerfil -->
        <div class="user-panel mt-2 pb-2 mb-2 d-flex">
            <div class="image">
                <img src="https://i.pinimg.com/originals/48/f7/eb/48f7eb72134ebb24eaddf64adfae6dfa.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name ?? 'Alexander Pierce' }}</a>
            </div>
        </div>
        
        <!-- Control Sidebar -->
        <li class="nav-item mt-2 pb-2 mb-2 d-flex">
            <a href="{{ route('logout') }}" class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  title="Cerrar Sesión" role="button">
                <i class="nav-icon fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
				@csrf
			</form>
        </li>
    </ul>
</nav>