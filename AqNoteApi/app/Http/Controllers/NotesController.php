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



        if ($request->hasFile('file'))
        {

            $namePic = $request->file('file')->getClientOriginalName();

            $pathWhereSave = '../public/storage/'. $idS.'/'.$idN;
            $imageB64 = $request->file('file');
            $imageB64->move($pathWhereSave, $namePic);

            DB::table('photos')->insert([
                [
                    'path' => $pathWhereSave.'/'.$namePic,
                    'nameP' => $namePic,
                    'note_id' => $idN
                ]
            ]);
            return response()->json(['OK' => 200, 'note_id' => $idN]);


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
        }
        return response()->json('Error', 500);
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




