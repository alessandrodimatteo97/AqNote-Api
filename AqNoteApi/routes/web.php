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


Route::get('/user', 'Controller@prova1');
$router->group(['prefix' => 'api/'], function ($router) {
$router->get('login/','UsersController@authenticate');
$router->post('todo/','ToDoController@store');
$router->get('todo/', 'ToDoController@index');
$router->get('todo/{id}/', 'ToDoController@show');
$router->put('todo/{id}/', 'ToDoController@update');
$router->delete('todo/{id}/', 'ToDoController@destroy');
});
