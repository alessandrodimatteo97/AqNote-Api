<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use App\Todo;
use Auth;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use File;

class NotesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //$this->middleware('auth');
    }

    public function notesDetail($idN)
    {
      /*
      $contents = Storage::get('/public/storage/dirKKK/image1-.jpg');
      $note = DB::table('notes')
                  ->select('idN', 'title', 'description', 'user_id', 'subject_id')
                  ->where('idN', $idN)
                  ->get();

      $pathToDetail = $note[0].'-'.$note[3].'-'.$note[4];
*///echo Storage::get('/');
      /*$type = 'image/jpg';
      $headers = ['Content-Type' => $type];*/
      $indiceImg = 0;
      $arrayImg = [];
      while(file_exists(storage_path('../public/storage/dirKKK/image'.$indiceImg.'-.jpg'))) {
          $path = 'storage/dirKKK/image' . $indiceImg . '-.jpg'; //questo è il path buono usando url poi nel templateengine
          //$path = storage_path('../public/storage/dirKKK/image' . $indiceImg . '-.jpg'); //Con questo prendo il path completo
          $arrayImg[$indiceImg] = $path;
          $indiceImg = $indiceImg + 1;
      }
        return $arrayImg;

        //return $note->toJson();

    }

    public function uploadNote(Request $request, $idS)
    {
      $idUser = DB::table('users')
                    ->select('idU')
                    ->where('api_key', $request->input('api_key'))
                    ->get();

      DB::table('notes')->insert([
         [
          'title' => $request->input('title'),
          'description' => $request->input('description'),
          'user_id' => 1,
          'subject_id' => $idS,
         ]

       ]);

      $idNote = DB::table('notes')->orderBy('idN', 'desc')->first();

      if(!(Storage::exists($idS))){
          Storage::makeDirectory($idS.'/'.$idNote->idN);
      } else{
          Storage::makeDirectory($idS.'/'.$idNote->idN);
      }
      $pathWhereSave = 'storage/'.$idS.'/'.$idNote->idN;
      $index = 0;
      $topass = 'image'.$index;
      while(!(empty($request->file($topass))))
      {
          $image = $request->file($topass);
          $namePic = $index . '.jpg';
          echo $topass;
          $image->move($pathWhereSave, $namePic);
          $index = $index + 1;
          $topass = 'image' . $index;
      }
        return response()->json( 'data',200, 'headers');
    }


}
