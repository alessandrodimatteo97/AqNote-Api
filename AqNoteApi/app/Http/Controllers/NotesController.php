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

      // $contents = Storage::get('/public/storage/dirKKK/image1-.jpg');
      $note = DB::table('notes')
                  ->select( 'title', 'description', 'user_id', 'subject_id')
                  ->where('idN', $idN)
                  ->get();
      return response()->json($note, '200');

              //$pathToDetail = $note[0].'-'.$note[3].'-'.$note[4];
        //echo Storage::get('/');
      /*$type = 'image/jpg';
      $headers = ['Content-Type' => $type];*/
        /*
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
          */
    }
    // uploadNote deve prendere anche l'id della materia
    public function uploadNote(Request $request){
        $userId = DB::table('users')->select('idU')->where('api_key', '=',$request->header('Authorization') )->value('idU');
     //   return response()->json(['OK' => 200, 'userId' => $userId]);
        $idS = $request->input('subject_id');

        $data = array(
            'title'  =>  $request->input('title') ,
            'description'  =>  $request->input('description') ,
            'user_id' => $userId, // prendere l'id dal login e salvarlo
            'subject_id' => $idS
        );
        $idNote = DB::table('notes')->insertGetId($data);

        return $idNote;
    }

    public function uploadPhoto(Request $request)
    {
        $idN = $request->input('idN') ;
        $idS= $request->input('idS') ;

        /*
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
*/
       // $iduser = DB::table('users')->select('idU')->where('api_key', '=',$request->header('Authorization') )->value('idU');


        if ($request->hasFile('file'))
        {

            $namePic = $request->file('file')->getClientOriginalName();
          //  return $request->file();
          //  return response()->json($request->file('file'));
            $pathWhereSave = '../public/storage/'. $idS.'/'.$idN;
            $imageB64 = $request->file('file');
         //   $imagePure = base64_decode($imageB64);

         //   Storage::disk('public')->put('storage/'. $idS.'/'.$idN, $imageB64);
           //  Storage::putFile($pathWhereSave, $imageB64);
            //$imageFinal = file_get_contents($image);
           // file_put_contents('~/Scrivania/universita/terzoanno/secondosemestre/progettoDiSalle/AqNote-Api/AqNoteApi/public/storage/nuovofile.jpg',  $request->file('file'));
            $imageB64->move($pathWhereSave, $namePic);

            DB::table('photos')->insert([
                [
                    'path' => $pathWhereSave.'/'.$namePic,
                    'nameP' => $namePic,
                    'note_id' => $idN
                ]
            ]);
            return response()->json(['OK' => 200, 'note_id' => $idN]);

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


    public function deletePhoto(Request $request){

        if(($request->has('idP'))) {
            $query = DB::table('photos')->where('idP', '=', $request->input('idP'))->select('path')->first();
            DB::table('photos')->where('idP', '=',  $request->input('idP') )->delete();

            if (unlink($query->path)) {
                return response()->json('Removed photo', 200);
            };
        }
        else {
            $idN = $request->input('idN');
            $imageName = $request->input('imageName');
            $query = DB::table('photos')->where('note_id', '=', $idN)->where('nameP', '=', $imageName)->select('idP', 'path')->first();
            DB::table('photos')->where('idP', '=', $query->idP)->delete();
            if (unlink($query->path)) {
                return response()->json('Removed photo', 200);
            };
            return response()->json('Error', 500);
        }
        return response()->json('Error', 500);
    }

    public function uploadComment(Request $request, $idN)
    {
        echo response()->json($request->toArray(), 200);
    }

    }




