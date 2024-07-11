<?php

    use Illuminate\Support\Facades\Route;
    use Carbon\Carbon;

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
    //Route::get('/welcome', 'WelcomeController@index')->name('welcome');
    $anio = Carbon::now()->format('Y');
    return view('welcome', compact('anio'));
});

Auth::routes(['register' => false]);

Route::get('logout', function (){
    Auth::logout();
    return redirect('/login');
});

//Route::get('/', 'HomeController@index')->name('inicio');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'empresas'], function(){
    // Route::get('/home', 'HomeController@index')->name('empresas');
    Route::get('listado', 'EmpresaController@index')->name('empresas');
});

Route::group(['middleware' => ['permission:departamentos-ver']], function () {
    Route::group(['prefix' => 'departamentos'], function(){
        Route::get('listado', 'DepartamentoController@index')->name('departamentos');
        Route::group(['middleware' => ['permission:departamentos-crear']], function () {
            Route::post('grabar', 'DepartamentoController@store')->name('grabar_departamento');
        });
        Route::group(['middleware' => ['permission:departamentos-editar']], function () {
            Route::post('editar', 'DepartamentoController@edit')->name('editar_departamento');
            Route::post('actualizar', 'DepartamentoController@update')->name('actualizar_departamento');
        });
    });
});

Route::group(['middleware' => ['permission:directivas-ver']], function () {
    Route::group(['prefix' => 'directivas'], function(){
        Route::get('listado', 'DirectivaController@index')->name('directivas');
        Route::group(['middleware' => ['permission:directivas-crear']], function () {
            Route::post('grabar', 'DirectivaController@store')->name('grabar_directiva');
        });
        Route::group(['middleware' => ['permission:directivas-editar']], function () {
            Route::post('editar', 'DirectivaController@edit')->name('editar_directiva');
            Route::post('actualizar', 'DirectivaController@update')->name('actualizar_directiva');
        });
    });
});

Route::group(['middleware' => ['permission:empresas-ver']], function () {
    Route::group(['prefix' => 'empresas'], function(){
        Route::get('listado', 'EmpresaController@index')->name('empresas');
        Route::group(['middleware' => ['permission:empresas-crear']], function () {
            Route::post('grabar', 'EmpresaController@store')->name('grabar_empresa');
        });
        Route::group(['middleware' => ['permission:empresas-editar']], function () {
            Route::post('editar', 'EmpresaController@edit')->name('editar_empresa');
            Route::post('actualizar', 'EmpresaController@update')->name('actualizar_empresa');
        });
    });
});

Route::group(['middleware' => ['permission:puestos-ver']], function () {
    Route::group(['prefix' => 'puestos'], function(){
        Route::get('listado', 'PuestoController@index')->name('puestos');
    });
});

Route::group(['middleware' => ['permission:municipios-ver']], function () {
    Route::group(['prefix' => 'municipios'], function(){
        Route::get('listado', 'MunicipioController@index')->name('municipios');
        Route::group(['middleware' => ['permission:municipios-crear']], function () {
            Route::post('grabar', 'MunicipioController@store')->name('grabar_municipio');
        });
        Route::group(['middleware' => ['permission:municipios-editar']], function () {
            Route::post('editar', 'MunicipioController@edit')->name('editar_municipio');
            Route::post('actualizar', 'MunicipioController@update')->name('actualizar_municipio');
        });
    });
});

Route::group(['middleware' => ['permission:paises-ver']], function () {
    Route::group(['prefix' => 'paises'], function(){
        Route::get('listado', 'PaisController@index')->name('paises');
        Route::group(['middleware' => ['permission:paises-crear']], function () {
            Route::post('grabar', 'PaisController@store')->name('grabar_pais');
        });
        Route::group(['middleware' => ['permission:paises-editar']], function () {
            Route::post('editar', 'PaisController@edit')->name('editar_pais');
            Route::post('actualizar', 'PaisController@update')->name('actualizar_pais');
        });
    });
});

Route::group(['middleware' => ['permission:puestos-ver']], function () {
    Route::group(['prefix' => 'puestos'], function(){
        Route::get('listado', 'PuestoController@index')->name('puestos');
        Route::group(['middleware' => ['permission:puestos-crear']], function () {
            Route::post('grabar', 'PuestoController@store')->name('grabar_puesto');
        });
        Route::group(['middleware' => ['permission:puestos-editar']], function () {
            Route::post('editar', 'PuestoController@edit')->name('editar_puesto');
            Route::post('actualizar', 'PuestoController@update')->name('actualizar_puesto');
        });
    });
});

Route::group(['middleware' => ['permission:servicios-ver']], function () {
    Route::group(['prefix' => 'servicios'], function(){
        Route::get('listado', 'ServicioController@index')->name('servicios');
        Route::group(['middleware' => ['permission:servicios-crear']], function () {
            Route::post('grabar', 'ServicioController@store')->name('grabar_servicio');
        });
        Route::group(['middleware' => ['permission:servicios-editar']], function () {
            Route::post('editar', 'ServicioController@edit')->name('editar_servicio');
            Route::post('actualizar', 'ServicioController@update')->name('actualizar_servicio');
        });
    });
});

Route::group(['prefix' => 'estudios'], function(){
    Route::get('/home', 'HomeController@index')->name('estudios');
});

Route::group(['prefix' => 'especialistas'], function(){
    Route::get('/home', 'HomeController@index')->name('especialistas');
});

Route::group(['prefix' => 'trnestudios'], function(){
    Route::get('/home', 'HomeController@index')->name('trnestudios');
});

Route::group(['prefix' => 'trncobros'], function(){
    Route::get('/home', 'HomeController@index')->name('trncobros');
});

Route::group(['prefix' => 'trnpagos'], function(){
    Route::get('/home', 'HomeController@index')->name('trnpagos');
});

Route::group(['middleware' => ['permission:seguridad']], function () {
    Route::group(['prefix' => 'permissions'], function(){
        Route::get('listado', 'PermissionController@index')->name('permisos');  
        Route::get('editar/{permiso_id}', 'PermissionController@edit')->name('editar_permiso');
        Route::post('grabar', 'PermissionController@store')->name('grabar_permiso');
        Route::post('actualizar/{permiso_id}', 'PermissionController@update')->name('actualizar_permiso');
    });
    Route::group(['prefix' => 'roles'], function(){
        Route::get('listado', 'RoleController@index')->name('roles');   
        Route::get('editar/{role_id}', 'RoleController@edit')->name('editar_role');
        Route::post('grabar', 'RoleController@store')->name('grabar_role');
        Route::post('actualizar/{role_id}', 'RoleController@update')->name('actualizar_role');
    });


    Route::group(['prefix' => 'usuarios'], function(){
        Route::get('listado', 'UsuarioController@index')->name('usuarios'); 
        Route::get('editar/{usuario_id}', 'UsuarioController@edit')->name('editar_usuario');
        Route::post('grabar', 'UsuarioController@store')->name('grabar_usuario');
        Route::post('actualizar/{usuario_id}', 'UsuarioController@update')->name('actualizar_usuario');
        Route::get('contrasena', 'UsuarioController@index_contrasena')->name('contrasena'); 
        Route::get('perfil', 'UsuarioController@profile')->name('perfil');
        Route::post('perfil_actualizar', 'UsuarioController@profile_update')->name('perfil_actualizar');
        Route::post('actualizar_contrasena', 'UsuarioController@update_contrasena')->name('actualizar_contrasena');
        Route::get('actualizar_pass/{usuario_id}', 'UsuarioController@update_pass')->name('actualizar_pass');
    });

    Route::group(['prefix' => 'viviendas'], function(){
        Route::get('listado', 'ViviendaController@index')->name('viviendas');
        Route::post('grabar', 'ViviendaController@store')->name('grabar_vivienda');
        Route::post('editar', 'ViviendaController@edit')->name('editar_vivienda');
        Route::post('actualizar', 'ViviendaController@update')->name('actualizar_vivienda');
    });
});

Route::group(['prefix' => 'personas'], function(){
    Route::get('listado', 'PersonaController@index')->name('personas');
    Route::post('grabar', 'PersonaController@store')->name('grabar_persona');
    Route::post('editar', 'PersonaController@edit')->name('editar_persona');
    Route::post('actualizar', 'PersonaController@update')->name('actualizar_persona');
});

Route::group(['middleware' => ['permission:variables-ver']], function () {
    Route::group(['prefix' => 'variables'], function(){
        Route::get('listado', 'VariableController@index')->name('variables');
    });
});