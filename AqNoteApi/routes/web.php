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

$router->get('/', function () use ($router) {
  // metodo per resituire immagini

  Storage::makeDirectory('directory'); //metodo per creare una directory

  $type = 'image/png';
  $headers = ['Content-Type' => $type];
  $path=storage_path('pr.jpeg');
  $response = new BinaryFileResponse($path, 200 , $headers);

  return $response;

});

Route::get('/api/Departments', 'Controller@DepartmentsList');

Route::get('/user', 'Controller@prova1');
$router->group(['prefix' => 'api/'], function ($router) {
  $router->post('login/','UsersController@authenticate'); //post
  $router->post('signup/', 'UsersController@signUp'); //post
  $router->post('update/', 'UsersController@updateProfile') ; //post
  $router->post('infouser/', 'UsersController@infoUser'); //passareTokenInveceDiURL
  $router->get('todo/', 'TodoController@index');
  $router->get('todo/{id}/', 'ToDoController@show');
  $router->put('todo/{id}/', 'ToDoController@update');
  $router->delete('todo/{id}/', 'ToDoController@destroy');
  //$router->get('{id}/', 'UsersController@infoUser');
  $router->get('department/', 'DepartmentsController@listDepart');
  $router->get('cdl/{idD}', 'CdlsController@listCdl');
  $router->get('subjectlist/{idC}', 'SubjectsController@listSubject');
  $router->get('subjectlist/{idC}/{year}', 'SubjectsController@listSubYear');
  $router->get('notesList/{idS}', 'SubjectsController@notesList');
  $router->get('notes/{idN}', 'NotesController@notesDetail'); //post
  $router->get('{idS}/notes/upload', 'NotesController@uploadNote'); //post
});

Route::get('/api/davide/{idS}', function () {
    return view('prova');
});

Route::post('/davide/{idS}', 'NotesController@uploadNote');

Route::get('/api/provatoken', 'UsersController@provaToken');