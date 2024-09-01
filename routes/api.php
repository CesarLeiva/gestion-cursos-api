<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\controladorAsignatura;//?Aquí se llama al controlador que fue creado en esa ruta

//! ASIGNATURAS
Route::get('/asignaturas', [controladorAsignatura::class, 'ver_asignaturas']);//? Aquí se invoca a la función del controlador que va a retornar la respuesta

Route::get('/asignatura/{id}', [controladorAsignatura::class, 'mostrar_asignatura']); //? Aquí se invoca a la función del controlador que va a buscar la asignatura por el id

Route::post('/asignatura', [controladorAsignatura::class, 'crear_asignatura']); //? Aquí se invoca la función del controlador para crear una asignatura

Route::put('/asignatura/{id}', [controladorAsignatura::class, 'editar_asignatura']);

Route::delete('/asignatura/{id}', [controladorAsignatura::class, 'eliminar_asignatura']);