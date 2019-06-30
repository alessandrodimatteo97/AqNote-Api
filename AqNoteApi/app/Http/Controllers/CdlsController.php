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

    public function listCdl($id0)
    {
      $cdls = DB::table('degree_courses')
                  ->select('idDC', 'nameDC', 'department_id')
                  ->where('department_id', $id0)
                  ->get();
        return $cdls ->toJson();

      return response()->
              json([
                      'cdls' => $cdls
                  ]);
    }

    public function infoCdl($id0, $idC)
    {
      $cdls = DB::table('degree_courses')
                        ->select('idDC', 'nameDC')
                        ->where('idDC', $idC)
                        ->get();

      return response()
              ->json([
                        'cdl' => $cdls
                    ]);
    }

}
