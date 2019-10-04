<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Storage;
use Auth;
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
      return "ciqoooaishidubfn";
        return "$arrayImg";

        //return $note->toJson();

    }

    public function uploadNote(Request $request){
        $userId = DB::table('users')->select('idU')->where('api_key', '=',$request->header('Authorization') )->value('idU');
     //   return response()->json(['OK' => 200, 'userId' => $userId]);
        $data = array(
            'title'  =>  $request->input('title') ,
            'description'  =>  $request->input('description') ,
            'user_id' => $userId, // prendere l'id dal login e salvarlo
            'subject_id' => $request->input('subject_id')
        );
        $idNote = DB::table('notes')->insertGetId($data);
        return $idNote;
    }

    public function uploadPhoto(Request $request, $idS)
    {
        if(($request->header('note_id')) == 'null')
        {
            $idNote = DB::table('notes')->insert([
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('descr'),
                    'user_id' => 7,
                    'subject_id' => $idS
                ]
            ]);

          //  echo response()->json('id nota generato', $idNote->idN);

        }

        $idNote = DB::table('notes')
            ->orderBy('idN', 'desc')
            ->first();


        if(!(Storage::exists($idS))){
            Storage::makeDirectory($idS.'/'.$idNote->idN);
        } else{
            Storage::makeDirectory($idS.'/'.$idNote->idN);
        }

        $iduser = DB::table('users')
                    ->select('idU')
                    ->where('api_key', '=', $request->header('X-Auth'))
                    ->pluck('idU');

        if ($request->hasAny('file'))
        {
            $namePic ='ciao.jpeg';
            $pathWhereSave = 'public/storage/'.$idS.'/'.$idNote->idN;
            $image = $request->file('file')->storeAs('files', $namePic);
            // Storage::putFile($pathWhereSave, $image);
            //$imageFinal = file_get_contents($image);
           // file_put_contents('~/Scrivania/universita/terzoanno/secondosemestre/progettoDiSalle/AqNote-Api/AqNoteApi/public/storage/nuovofile.jpg',  $request->file('file'));
            //$image->move($pathWhereSave, $namePic);

            DB::table('photos')->insert([
                [
                    'path' => '../public/'.$pathWhereSave.'/'.$namePic,
                    'nameP' => $namePic,
                    'note_id' => $idNote->idN
                ]
            ]);
            return response()->json(['OK' => 200, 'note_id' => $idNote->idN]);

            /*return response()->json('OK', 200, [
                'Content-Type' => 'application/json',
                'note-id'=> $idNote->idN,
                'Per-capi' => 'madonne',
            ]);*/

        } else {
            return response()->json('Internal Server Error', 555)
                    ->header('Content-Type', 'application/json');
        }

    }


}
