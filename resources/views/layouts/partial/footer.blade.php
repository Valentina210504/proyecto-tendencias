<!-- Footer separado para mejor organización -->
<footer class="main-footer fixed-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <strong>Copyright &copy; {{ date('Y') }}
                    <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>.
                </strong>
                Todos los derechos reservados.
            </div>
            <div class="col-md-6 text-right d-none d-sm-block">
                <b>Versión</b> {{ config('app.version', '1.0.0') }}
            </div>
        </div>
    </div>
</footer>