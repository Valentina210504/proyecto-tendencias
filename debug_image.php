<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$vehiculo = \App\Models\Vehiculo::latest()->first();
file_put_contents('debug_image_path.txt', "ID: " . $vehiculo->id . "\nPath: " . $vehiculo->imagen . "\nExists: " . (file_exists(public_path($vehiculo->imagen)) ? 'YES' : 'NO') . "\nPublic Path: " . public_path($vehiculo->imagen));
