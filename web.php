<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\Testmail;
use App\Http\Requests\ValidarcheckRequest;
use Illuminate\Support\Facades\Auth;
use App\WebPayController;

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

Route::get('/login_paciente', 'Auth\LoginController@index_login')->name('login_paciente');
Route::get('/login_psicologo', 'Auth\LoginController@index_login')->name('login_psicologo');
Route::post('/login/{tipo}', 'Auth\LoginController@logear')->name('logear');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', 'PrestadorController@registeruser')->name('register');
Route::post('/register/rut', 'Auth\RegisterController@verificarRut');
Route::get('/auth/register/{tipo}', 'Auth\RegisterController@createUser')->name('createPaciente');
Route::get('/auth/register_psicologo/{tipo}', 'Auth\RegisterController@createUser')->name('createPsicologo');
Route::get('/register_psicologo', 'PrestadorController@viewRegistroPsicologo')->name('register_psicologo');
Route::get('/auth/rol_register', 'Auth\RegisterController@viewRegistroRol')->name('rol_register');
Route::get('/register_confirmacion', 'Auth\RegisterController@viewRegistroConfirmacion')->name('registro_confirmacion');
Route::get('/registerpsi', 'PrestadorController@registeruserpsi')->name('registerpsi');
Route::get('/work_for_us', 'PrestadorController@index')->name('work');
//Route::view('/work_for_us', 'prestador.register')->name('workforus');
Route::post('/create_profesional', 'PrestadorController@create')->name('profesional');
Route::post('/registrar/profesional/api', 'PrestadorController@create_api');
Route::get('/profesionals', 'PrestadorController@getProfesionalList')->name('listProfesionals');
Route::get('/auth/redirect/{provider}', 'SocialLoginController@redirect');
Route::get('/callback/{provider}', 'SocialLoginController@callback');
Route::get('/profile/{id}', 'ProfileController@getProfile')->name('profile');
Route::get('/results', 'PrestadorController@filtroProf')->name('results');

// Rutas de beneficios
Route::get('/benefits', 'BenefitsController@index')->name('test');

// Rutas de Quienes Somos (about us)
Route::get('/about', 'AboutController@about')->name('about');

// Rutas del foro
Route::get('/foro', 'Foro\ForoController@index')->name('foroIndex');
Route::get('/foro/categoria/view/{id?}', 'Foro\CategoriaController@index')->name('foroCatIndex');
Route::get('/foro/categoria/posts/{id?}/{page_id?}', 'Foro\CategoriaController@catPosts')->name('foroCatPosts'); //ajax
Route::get('/foro/categoria/list', 'Foro\CategoriaController@catList')->name('foroCatList'); //ajax
Route::get('/foro/cat/details', 'Foro\CategoriaController@details')->name('foroCatDetails'); //ajax
Route::post('/foro/cat/add', 'Foro\CategoriaController@add')->name('foroCatAdd'); //ajax
Route::put('/foro/cat/edit', 'Foro\CategoriaController@edit')->name('foroCatEdit'); //ajax
Route::delete('/foro/cat/delete', 'Foro\CategoriaController@delete')->name('foroCatDelete'); //ajax
Route::get('/foro/favorites', 'Foro\FavoriteController@index')->name('foroFavIndex');
Route::get('/foro/myfavorites', 'Foro\FavoriteController@userFavorites')->name('foroUserFavPost');
Route::get('/foro/myposts', 'Foro\PostController@postsUser')->name('foroPostsUser');
Route::get('/foro/post/view/{id?}', 'Foro\PostController@index')->name('foroPostIndex');
Route::post('/foro/post/add', 'Foro\PostController@add')->name('foroPostAdd'); //ajax
Route::get('/foro/post/viewDetail/{id?}', 'Foro\PostController@viewDetail')->name('foroPostViewDetail'); //ajax
Route::get('/foro/post/details', 'Foro\PostController@details')->name('foroPostDetails'); //ajax
Route::put('/foro/post/edit', 'Foro\PostController@edit')->name('foroPostEdit'); //ajax
Route::delete('/foro/post/delete', 'Foro\PostController@delete')->name('foroPostDelete'); //ajax
Route::get('/foro/post/cmtlist/{id?}', 'Foro\PostController@cmtList')->name('foroPostCmtList'); //ajax
Route::get('/foro/post/like', 'Foro\PostController@togglePostLike')->name('foroPostLike'); //ajax
Route::post('/foro/post/addfav', 'Foro\FavoriteController@postAddFav')->name('foroPostAddFav'); //ajax
Route::post('/foro/cmt/add', 'Foro\CommentController@add')->name('foroCmtAdd'); //ajax
Route::get('/foro/cmt/details', 'Foro\CommentController@details')->name('foroCmtDetails'); //ajax
Route::put('/foro/cmt/edit', 'Foro\CommentController@edit')->name('foroCmtEdit'); //ajax
Route::get('/foro/cmt/like', 'Foro\CommentController@toggleCmtLike')->name('foroCmtLike'); //ajax
Route::delete('/foro/cmt/delete/{id?}', 'Foro\CommentController@delete')->name('foroCmtDelete'); //ajax


// Rutas del testimonios
Route::get('testimonios/{id?}', 'TestimonioController@get_testimonios')->name('testimonios');
// Route::get('testimoniosPublico/{numero?}','PagesController@testimoniosP')->name('testimoniosP');
// Route::get('testimoniosPsicologo/{numero?}','PagesController@testimoniosPsi')->name('testimoniosPsi');
//rutas crud
Route::post('/testimonios/guardar', 'TestimonioController@store');
Route::post('/testimonios/actualizar', 'TestimonioController@update');
//rutas aceptar/rechazar testimonio
Route::post('/testimonios/aceptar', 'TestimonioController@aceptarTesti');
Route::post('/testimonios/rechazar', 'TestimonioController@rechazarTesti');

/* --------------------------------------------------------------------------------------------- */
//Rutas reservas
Route::post('/profile/create', 'CitaController@store')->name('reserva.create');
Route::get('/llamarmodalidad', 'CitaController@modalidadall');
Route::get('/llamarIsapre', 'CitaController@isapres');
Route::get('/llamarServicios', 'CitaController@llamarServicio');
Route::get('/llamarUsuario', 'CitaController@User');
Route::get('/llamarPrecio', 'CitaController@Precio');
Route::get('/llamarHora', 'CitaController@horaNoDisponible');
Route::post('/reagendarCita', 'CitaController@update')->name('reagendar');
/* --------------------------------------------------------------------------------------------- */
Route::group(['prefix' => 'reserva'], function () {
    Route::get('list', 'ReservaController@listarReservas');
    Route::get('listPsicologo','ReservaController@listaReservasProfesional');
});
//Route::get('/reserva/list', 'ReservaController@listarReservas');

//Whatsapp
Route::get('/waping/send', 'WapingController@create');
Route::get('/cita-pendiente/{id}', 'CitaController@analizar');
Route::get('/rechazar/{id}', 'CitaController@rechazo');
Route::get('/confirmar-rechazo/{id}/{estado}', 'CitaController@confirmarRechazo');



Route::get('/mail/send', 'MailController@send');
Route::get('/email/confirmation/{id}', 'MailController@send')->name('confirmacion.email');
Route::get('/Sms', 'SmsController@create');
//Route::get('/Smsnew', 'SmsController@sendsmsnew')->name('enviosms');
Route::get('/vistaemail', 'WapingController@email');


//Rutas Chat
Route::get('chat', 'ChatController@index')->name('modal.chat');
Route::get('/message/{id}', 'ChatController@getMessage')->name('message');
Route::post('message', 'ChatController@sendMessage');
Route::get('/chat/download/{file}', 'ChatController@downloadFile');
Route::get('/chat/showfile/{filename}', 'ChatController@showFile');
Route::get('/chat/chatform', 'ChatController@index');
Route::get('/chat/read/{id}', 'ChatController@getReadMessages');

// Ruta vista Dashboard
//Route::view('/dashboard', 'layouts.dashboard')->name('dashboard');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::view('/dashboard/servicios', 'servicios.dashboardServicios')->name('dashboardServicios');
Route::post('/dashboard/update', 'DashboardController@update')->name('dashboardUpdate');
/* Route::view('dashboard/paciente','dashboard.paciente'); */
Route::get('/dashboard/profile/{id}', 'DashboardController@getProfile');
Route::post('/img/update', 'DashboardController@postProfileImage')->name('imgUpdate');
Route::post('/updatePassword', 'DashboardController@updatePassword');
//Route::view('/dashboard', 'layouts.dashboard')->name('dashboard');
//Route::view('/dashboard/servicios', 'servicios.dashboardServicios')->name('dashboardServicios');




// Rutas servicios
Route::resource('servicio', 'ServicioController');
Route::post('/servicio/insertar', 'ServicioController@insertarServicio')->name('rutaFormS');
Route::post('/servicio/eliminar', 'ServicioController@eliminarServicio')->name('rutaFormEliminar');
Route::delete('/servicio/{id}', 'ServicioController@destroy');
Route::get('serviciosall', 'ServicioController@servicioall');
Route::get('/detalle/{id}', 'ServiceController@detalle')->name('detalle');

Route::get('/editar/{id}', 'ServiceController@editar')->name('editarService');

Route::put('/editar/{id}', 'ServiceController@updates')->name('notas.updates');

Route::delete('eliminar/{id}', 'PagesServiceControllerController@eliminar')->name('eliminar'); 

Route::post('/blog', 'ServiceController@crear')->name('notas.crear');

Route::get('blog', 'ServiceController@blog')->name('blog');


    


// Inicio Rutas Ficha

//Ruta para vista Pacientes
Route::get('/dashboard/pacientes/{id}', 'FichaController@buscarPacientes')->name('buscar');

//Route::get('/dashboard/pacientes/{id}', 'FichaController@buscadorPaciente')->name('pacientes');

//Ruta para vista 'Información de pacientes'
Route::get('/dashboard/information/{idpa}/{idpo}', 'FichaController@informationPaciente')->name('information');

//Ruta para descargar Documento de Ficha en formato PDF
Route::get('/dashboard/fichaPDF/{idpa}/{idpo}', 'FichaController@fichaPDF')->name('fichaPDF');
//Ruta para descargar Documento de Ficha en formato PDF
Route::get('/dashboard/casoPDF/{idpa}/{idpo}/{idficha}', 'FichaController@casoPDF')->name('casoPDF');

//Ruta para descargar Documento de Certificado por diagnostico Manual en formato PDF
Route::post('/dashboard/certificadoDiagnostico/{ids}', 'FichaController@certificadoDiagnostico')->name('certificadoDiagnostico');

Route::post('/dashboard/certificadoAsistencia/{ids}', 'FichaController@certificadoAsistencia')->name('certificadoAsistencia');

Route::get('/dashboard/vistaPreviaCpiscologico/{ids}', 'FichaController@vistaPreviaCpiscologico')->name('vistaPreviaCpiscologico');

Route::get('/dashboard/vistaPreviaCasistencia/{ids}', 'FichaController@vistaPreviaCasistencia')->name('vistaPreviaCasistencia');

//Ruta para descargar Documento de Certificado por diagnostico General en formato PDF
Route::get('/dashboard/certificadoDiagnosticoG/{ids}', 'FichaController@certificadoDiagnosticoG')->name('certificadoDiagnosticoG');

//Ruta para ver detalles de diagnostico (observaciones ,diagnostico general , manuales )
Route::get('/dashboard/Sesion/{idpa}/{idpo}/{ids}/{ns}/{sr}/{idc}/{nomc}/{caes}', 'FichaController@Sesion')->name('Sesion');
//Ruta para crear observacion
Route::post('/dashboard/Sesion/crearObservacion/{ids}', 'FichaController@crearObservacion')->name('crearObservacion');
//Ruta para crear Diagnostico General
Route::post('/dashboard/Sesion/crearDiagnosticoG/{ids}', 'FichaController@crearDiagnosticoG')->name('crearDiagnosticoG');
//Ruta para crear Diagnostico por manual
Route::post('/dashboard/Sesion/crearDiagnosticoM/{ids}', 'FichaController@crearDiagnosticoM')->name('crearDiagnosticoM');
//Ruta para editar diagnostico general
Route::put('/dashboard/Sesion/editarDiagnosticoG/{ids}', 'FichaController@editarDiagnosticoG')->name('editarDiagnosticoG');
//Ruta para editar diagnostico por manual
Route::put('/dashboard/Sesion/editarDiagnosticoM/{ids}', 'FichaController@editarDiagnosticoM')->name('editarDiagnosticoM');
//Ruta para ver detalles de egreso
Route::get('/dashboard/egresarPaciente/{idpa}/{idpo}/{idc}/{sr}/{nomc}/{alta}/', 'FichaController@egresarPaciente')->name('egresarPaciente');
//Ruta para egresar pacientes
Route::get('/dashboard/egresarPaciente/confirmarEgreso{idpo}/{idc}/{alta}/{idpa}', 'FichaController@confirmarEgreso')->name('confirmarEgreso');
//Ruta para confirmar derivacion
Route::get('/dashboard/egresarPaciente/confirmarDerivacion/{idpo}/{idc}/{idpa}/{idpod}', 'FichaController@confirmarDerivacion')->name('confirmarDerivacion');
//Ruta para aceptar derivacion
Route::get('/dashboard/ListarCasos/aceptarDerivacion/{idc}', 'FichaController@aceptarDerivacion')->name('aceptarDerivacion');


// Término Rutas ficha



Route::get('/datosModi', 'ServicioController@datosModi');
Route::put('/servicio/editar', 'ServicioController@update')->name('up');


//Rutas pasarela de pago (WebpayNormal)
//Route::post('pasareladepago/webpay/pagar','WebPayController@pagar')->name('pasareladepago.webpay.pagar');
Route::post('pasareladepago/webpay/response', 'WebPayController@response')->name('pasareladepago.webpay.response');
Route::post('pasareladepago/webpay/finish', 'WebPayController@finish')->name('pasareladepago.webpay.finish');
Route::get('pasareladepago/webpay/vista', 'WebPayController@vista')->name('pasareladepago.webpay.vista');
Route::get('pasareladepago/webpay/pagodetalle/{id}', 'WebPayController@pagodetalle')->name('pasareladepago.webpay.pagodetalle');
Route::get('pasareladepago/webpay/visualizaciondetalle/{id}', 'WebPayController@visualizacionDetalle')->name('pasareladepago.webpay.visualizaciondetalle');

Route::get('pasareladepago/webpay/correo', 'WebPayController@correo')->name('pasareladepago.webpay.correo');
Route::post('pasareladepago/webpay/correoopcional', 'WebPayController@correoOpcional')->name('pasareladepago.webpay.correoopcional');
Route::get('pasareladepago/webpay/ordencompra/{id}', 'WebPayController@ordenDeCompra')->name('pasareladepago.webpay.ordencompra');

Route::post('pasareladepago/webpay/vista', 'WebPayController@busqueda')->name('pasareladepago.webpay.busqueda');
Route::get('pasareladepago/webpay/vistaFiltro/{mes?}/{ano?}', 'WebpayController@filtro')->name('pasareladepago.webpay.filtro');
//Route::get('pasareladepago/webpay/listCitas', 'WebPayController@listarCitas')->name('pasareladepago.webpay.listaCitas');

Route::get('pasareladepago/webpay/listaProfesional/', 'WebPayController@listaReservasProfesional')->name('pasareladepago.webpay.listaProfesional');
Route::get('pasareladepago/webpay/listaFiltroPaciente/{rut?}/{name?}', 'WebPayController@filtrarPaciente')->name('pasareladepago.webpay.filtrarPaciente');

Route::post('pasareladepago/webpay/pagar', 'WebPayController@pagar')->name('pasareladepago.webpay.pagar');
Route::get('pasareladepago/webpay/listaFiltro/{estadoPago?}', 'WebpayController@filtrarEstado')->name('pasareladepago.webpay.filtroEstado');

//Rutas WebPay Plus Rest
Route::post('pasareladepago/webpay/rest/checkout', 'WebPayRestController@createdTransaction')->name('pasareladepago.webpay.rest.checkout');
Route::post('pasareladepago/webpay/rest/return', 'WebPayRestController@commitedTransaction')->name('pasareladepago.webpay.rest.return');

// Rutas Ficha


//Rutas ChatBot
Route::get('/', function () {
    return view('welcome');
});
Route::match(['get', 'post'], '/botman', 'BotManController@handle');
// Vista FAQ
Route::get('/faq/faq', 'FAQController@FAQ')->name('FAQ');

//Vista Contacto
Route::get('/contacto', 'ContactoController@Cont')->name('Contacto');
Route::post('/contacto/ver', 'ContactoController@agregar')->name('ContactoAgregar');

//Vista Agenda
Route::get('/agenda/calendario/', 'AgendaController@indexAgenda')->name('InicioCalendar');
Route::get('/agenda/calendario/listar/', 'AgendaController@listarAgenda');
Route::get('pasareladepago/webpay/listCitas', 'WebPayController@listarCitas')->name('pasareladepago.webpay.listaCitas');

//
