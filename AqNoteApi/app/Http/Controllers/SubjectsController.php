<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class SubjectsController extends Controller
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

    public function notesDetail($idN)
    {

      $note = DB::table('notes')
                  ->select('idN', 'title', 'description', 'user_id', 'subject_id')
                  ->where('idN', $idN)
                  ->get();
      return $note->toJson();

    }

}
