<?php
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
Route::options('/{path: *}', function(){
    return '';
});
/*
$router->get('/', function () use ($router) {
  // metodo per resituire immagini

  Storage::makeDirectory('directory'); //metodo per creare una directory

  $type = 'image/png';
  $headers = ['Content-Type' => $type];
  $path=storage_path('pr.jpeg');
  $response = new BinaryFileResponse($path, 200 , $headers);

  return $response;

});
*/

// rotta di prova per la home
Route::get('/api/download', 'ExampleController@download');





Route::get('/api/Departments', 'Controller@DepartmentsList');

Route::get('/user', 'Controller@prova1');

$router->group(['prefix' => 'api/'], function ($router) {
  $router->post('login/','UsersController@authenticate'); //post
  $router->post('signup/', 'UsersController@signUp'); //post
  $router->post('update/', 'UsersController@updateProfile') ; //post
  $router->get('profile/', 'UsersController@infoUser'); //passareTokenInveceDiURL

    $router->get('homepage/{id}', 'ExampleController@homePage');
    Route::get('/favourites', 'ExampleController@favouriteNote');

    //nameSFavourites
    //$router->get('{id}/', 'UsersController@infoUser');
  $router->get('department/', 'DepartmentsController@listDepart');
  $router->get('cdl/', 'CdlsController@listCdl');
  $router->get('subjectlist/{idC}', 'SubjectsController@listSubject');
  $router->get('subjectlist/{idC}/{year}', 'SubjectsController@listSubYear');
  $router->get('notesList/{idS}', 'SubjectsController@notesList');
  $router->get('notes/{idN}', 'NotesController@notesDetail'); //post
  $router->post('{idS}/notes/upload', 'NotesController@uploadNote'); //post
});

Route::get('/api/davide/{idS}', function () {
    return view('prova');
});

Route::post('/davide/{idS}', 'NotesController@uploadNote');

Route::get('/api/provatoken', 'UsersController@provaToken');
