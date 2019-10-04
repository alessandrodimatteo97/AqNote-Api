<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use App\Todo;
use Auth;
use App\Model\Note;

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

      return $subjects->json(['OK' => 200, 'note_id' => $subjects]);
    }

    public function notesList($idS)
    {
        $hello = DB::select(DB::raw(" SELECT *
        FROM (SELECT u.name, u.surname, n.idN, n.title, n.description ,count(distinctrow c.idCO) as comments,avg(c.like)-1 as avarage from notes as n left join comments as c on n.idN=c.note_id 
        join users as u on u.idU = n.user_id join photos as p on n.idN = p.note_id where n.subject_id ='$idS' group by n.idN order by n.idN 
        )  t1  join (SELECT  n.idN,count(p.note_id) as pages FROM  photos as p left join  notes as n on n.idN = p.note_id where p.note_id is null or p.note_id is not null group by p.note_id) t2  on t1.idN = t2.idN ;"));

        return $hello;
    }


    /*foreach($notesListPhotos as $notesListPhoto) {
        foreach ($notesListComments as $notesListComment) {
            $results = $notesListComment->add($notesListPhoto)->where($notesListComments->get('idN'), '=', $notesListPhoto->idN);
        }
    }
*/


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
