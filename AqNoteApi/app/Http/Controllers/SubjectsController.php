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

class SubjectsController extends Controller
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

    public function listSubject($idC)
    {
      $subjects = DB::table('subjects')
                  ->select('id', 'nameS', 'year', 'degreeCourse_id')
                  ->where('degreeCourse_id', $idC)
                  ->get();

      return $subjects->toJson();
    }

    public function infoSubject($idS)
    {
      $subject = DB::table('subjects')
                  ->select('id', 'nameS', 'year', 'degreeCourse_id')
                  ->where('id', $idS)
                  ->get();

      return response()
              ->json([
                        'subject' => $subject
                    ]);
    }

    public function listSubYear($idC, $year)
    {

      $subjects = DB::table('subjects')
                  ->select('id', 'nameS', 'year', 'degreeCourse_id')
                  ->where('degreeCourse_id', $idC)
                  ->where('year', $year)
                  ->get();

      return $subjects->toJson();
    }

    public function notesList($idS)
    {

      $notesList = DB::table('notes')
                  ->select('idN', 'title', 'description', 'user_id', 'subject_id')
                  ->where('subject_id', $idS)
                  ->get();
      return $notesList->toJson();

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
          'user_id' => $idUser[0],
          'subject_id' => $idS,
         ]

       ]);

      Storage::makeDirectory($request->input('idN').'-'.$request->input($idUser).'-'.$request->input($idS));
      $pathWhereSave = 'storage/'.$request->input('idN').'-'.$request->input($idUser).'-'.$request->input($idS);
      $image = $request->file('image');
      //$format = $request->image->extension();
      $namePic = '1-'.$request->input($idUser).'-'.$request->input($idS).'.jpg';//$format;

      $img->resize(300, 300)->save($pathWhereSave.'/'.$namePic);
      $img->move($pathWhereSave, $namePic);

      echo $pathWhereSave;
    }

    public function prova(Request $request, $idS)
    {
      $user = Auth::user()->first();
      $directoryName = $idS.'-'.$user->idU;
      Storage::makeDirectory($directoryName);
      $pathWhereSave = 'storage/'.$directoryName;
      $index = 1;
      $topass = 'image1';
      while(!(empty($request->file($topass))))
      {
        $image = $request->file($topass);
        $namePic = $topass.'-.jpg';
        $image->move($pathWhereSave, $namePic);
        $index=$index+1;
        $topass = 'image'.$index;
      }

      $result = DB::table('notes')->insert([
         [
          'title' => $request->input('title'),
          'description' => $request->input('description'),
          'user_id' => $user->idU,
          'subject_id' => $idS,
         ]

       ]);

      return $result;
    }
}
