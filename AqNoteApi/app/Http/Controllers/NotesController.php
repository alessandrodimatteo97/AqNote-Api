<?php

namespace App\Http\Controllers;
use App\Model\Subject;
use Illuminate\Database\Eloquent\Collection;
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

    public function uploadComment(Request $request, $idN)
    {
        $user = DB::table('users')
            ->select('idU')
            ->where('api_key', $request->header('Authorization'))
            ->pluck('idU');

        DB::table('comments')->insert([
            'titleC' => 'Prova',
            'text' => $request->input('comment'),
            'like' => $request->input('stars'),
            'user_id' => $user[0],
            'note_id' => $idN
        ]);

        return $user;
    }

    public function loadComments($idN)
    {
        $result = DB::table('comments')
                    ->join('users', 'comments.user_id', '=', 'users.idU')
                    ->select('users.name', 'users.surname', 'comments.titleC', 'comments.text', 'comments.like')
                    ->where('comments.note_id', '=', $idN)
                    ->get();
        return $result->toJson();
    }

    public function loadPhoto($idN)
    {
        $collection = collect([]);
        $paths = DB::table('photos')
            ->select('idP', 'path')
            ->where('note_id', '=', $idN)
            ->get();


        foreach ($paths as $path) {
            $collection->put('path', 'data:image/jpg;charset=utf-8;base64,  '.base64_encode(file_get_contents($path->path)));
        }
        return response()->json($collection, 200);

        /*$subject = DB::table('notes')
                    ->select('subject_id')
                    ->where('idN', '=', $idN)
                    ->pluck('subject_id');
        $result = new Collection();
        $dirname = "file:///home/davide/Scrivania/universita/terzoanno/secondosemestre/progettoDiSalle/AqNote-Api/AqNoteApi/public/storage/".$subject[0] . "/" . $idN."/";
        $images = glob($dirname."*.jpg");
        return $images;
        foreach($images as $image) {
            $result->push($image);
        }
        return response()->json($result);
        */
    }

    public function uploadNote1(Request $request){
return $request->file('file')->get();
        if ($request->hasAny('file')) {
            $destinationPath = 'storage/app/23/153/';
            $files = $request->file('file'); // will get all files

            foreach ($files as $file) {//this statement will loop through all files.
                $file_name = $file->getClientOriginalName(); //Get file original name
                return $file_name;
                $file->move($destinationPath , $file_name); // move files to destination folder
            }
        }
        return "prova";



    }

    public function checkCommentedNote(Request $request, $idN)
    {
        $userId = DB::table('users')->select('idU')->where('api_key', $request->header('Authorization'))->first();

        $commented = DB::table('comments')->select('idCO')
                    ->where('user_id', '=', $userId->idU)
                    ->where('note_id', '=', $idN)
                    ->pluck('idCO');

        return $commented;

    }
}




