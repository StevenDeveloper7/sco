<?php
use Illuminate\Support\Facades\Route;

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

//Clientes
Route::resource('clientes', 'ClienteController');

//Categoria de Productos
Route::resource('categoria_productos', 'CategoriaProductoController');

//Laboratorios
Route::resource('laboratorios', 'LaboratorioController');

//Ventas
Route::resource('ventas', 'SolicitudVentaController');
Route::get('select_cliente', 'SolicitudVentaController@select_cliente');
Route::get('select_vendedor', 'SolicitudVentaController@select_vendedor');
Route::get('select_laboratorio', 'SolicitudVentaController@select_laboratorio');
Route::get('select_estado', 'SolicitudVentaController@select_estado');

//Usuarios
Route::resource('usuarios', 'UsuarioController');

//Comisiones
Route::resource('comisiones', 'ComisionesController');

//Reportes
Route::get('reporte-clientes', 'ReporteController@reporte_clientes');
Route::get('reporte-ventas/{start}/{end}', 'ReporteController@reporte_ventas');
Route::get('reporte-comisiones/{start}/{end}/{documento}', 'ReporteController@reporte_comisiones');
Route::get('prueba', 'ReporteController@prueba');

//Tipo documento
Route::resource('documentos', 'TipoDocumentoController');

//Roles
Route::resource('roles', 'RoleController');

//Comisiones
Route::resource('comisiones', 'ComisionController');

//Dashboard
Route::get('total-clientes', 'DashboardController@total_clientes');
Route::get('total-ventas', 'DashboardController@total_ventas');
Route::get('total-vendedores', 'DashboardController@total_vendedores');
Route::get('total-comisiones', 'DashboardController@total_comisiones');
Route::get('ventas-anuales', 'DashboardController@ventas_anuales');
Route::get('ventas-mensuales', 'DashboardController@ventas_mensuales');

//Categoria de Productos
Route::resource('categoria_productos', 'CategoriaProductoController');


Route::get('/{vue?}', function () {
    return view('index');
})->where('vue', '[\/\w\.-]*');
