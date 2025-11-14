@extends('layouts.applogin')
@section('content')
<div class="container">
    <div class="alert alert-danger">
        <h1>Error 404: Página no encontrada</h1>
        <p>La página que estás buscando no existe.</p>
        <p><a href="{{ route('home') }}">Volver a la página de inicio</a></p>
    </div>
</div>
@endsection