<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas del Perfil
Route::get('/perfil', 'PerfilController@perfil')->name('perfil');
Route::post('/perfil/guardarImagen', 'PerfilController@guardarImagen')->name('guardarImagen');
Route::post('/perfil/cambiarNombre', 'PerfilController@cambiarNombre')->name('cambiarNombre');
Route::post('/perfil/informacionAcademica', 'PerfilController@informacionAcademica')->name('informacionAcademica');
Route::post('/perfil/informacionAcademica/{idInformacionAcademica}/delete', 'PerfilController@deleteInformacionAcademica')->name('deleteInformacionAcademica');
Route::post('/perfil/informacionAcademica/editInformacionAcademica', 'PerfilController@editInformacionAcademica')->name('editInformacionAcademica');
Route::post('/perfil/informacionLaboral', 'PerfilController@informacionLaboral')->name('informacionLaboral');
Route::post('/perfil/informacionLaboral/{idInformacionLaboral}/delete', 'PerfilController@deleteInformacionLaboral')->name('deleteInformacionLaboral');
Route::post('/perfil/informacionLaboral/editInformacionLaboral', 'PerfilController@editInformacionLaboral')->name('editInformacionLaboral');
Route::post('/perfil/saveSalary', 'PerfilController@saveSalary')->name('saveSalary');
Route::post('/perfil/savePhone', 'PerfilController@savePhone')->name('savePhone');

//Rutas proyecto

Route::get('/proyecto', 'ProyectoController@cargarvista')->name('vistaproyecto');
Route::get('/misproyectos', 'ProyectoController@showmyprojects')->name('showMyProject');
Route::post('/home', 'ProyectoController@subir')->name('subirproyecto');