<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class CdlsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function index (Request $request) {

        $cdl_user =  DB::table('users')
                ->select('cdl_id')
                ->where('api_key', '=', $request->header('Authorization'))
                ->pluck('cdl_id');

        /**
            $subjectAndBestNotes = DB::table('subjects')
            ->join('notes', 'subjects.id', '=', 'notes.subject_id')
            ->join('comments', 'notes.idN', '=', 'comments.note_id')
            ->join('users', 'users.idU', '=', 'notes.user_id')
            ->where('subjects.degreeCourse_id', '=', $cdl_user)
            ->orderBy('comments.like', 'desc')
            //->select('subjects.nameS', 'users.name', 'users.surname', 'notes.title', 'notes.description','notes.idN', 'comments.like')
            ->selectRaw('MAX(comments.like) AS \'Voti\'')
            ->groupBy('subjects.id')
            ->select('subjects.nameS', 'users.name', 'users.surname', 'notes.title')
            ->limit('2')
            ->get();
        $subjectAndBestNotes = DB::table('subjects')
            ->join('notes', 'subjects.id', '=', 'notes.subject_id')
            ->join('comments', 'notes.idN', '=', 'comments.note_id')
            ->join('users', 'users.idU', '=', 'notes.user_id')
            ->where('subjects.degreeCourse_id', '=', $cdl_user)
            ->orderBy('comments.like', 'desc')
            ->select('subjects.nameS', 'users.name', 'users.surname', 'notes.title', 'comments.like')
            ->limit('2')
            ->get();
         **/

        $idSubject = DB::table('subjects')
            ->select('id')
            ->where('degreeCourse_id', $cdl_user)
            ->get();
        /*
         *
        $tutteLeNoteDelleMaterie = DB::table('notes')
                ->select('notes.title')
                ->whereHas('notes', function($query) use ($idSubject) {
                 $query->where('id', $idSubject);   })
                ->get();
        */
        $idProva = DB::table($idSubject)
            ->select('id')
            ;
        return $idProva;
        foreach ($idSubject as $id){
            echo $id->id;
        }
        return;
        $prova = DB::table($idSubject)
            ->select('id')
            ;
        return $prova;
        return $tutteLeNoteDelleMaterie;

        return $subjectAndBestNotes->toJson();
    }

    public function listCdl()
    {
      $cdls = DB::table('degree_courses')
                  ->select('idDC', 'nameDC')
                  ->get();
      return $cdls->toJson();

    }
}
