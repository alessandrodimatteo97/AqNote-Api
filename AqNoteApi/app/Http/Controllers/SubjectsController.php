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

    public function listSubject($id, $id1)
    {

      $subjects = DB::table('subjects')
                  ->select('id', 'nameS', 'year', 'degreeCourse_id')
                  ->where('degreeCourse_id', $id1)
                  ->get();

      return response()->
              json([
                      'subjects' => $subjects
                  ]);
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

    public function listSubYear($id, $id1, $year)
    {

      $subjects = DB::table('subjects')
                  ->select('id', 'nameS', 'year', 'degreeCourse_id')
                  ->where('degreeCourse_id', $id1)
                  ->where('year', $year)
                  ->get();

      return response()->
              json([
                      'subjects' => $subjects
                  ]);
    }

}
