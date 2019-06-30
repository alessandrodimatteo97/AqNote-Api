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

    public function listCdl($idD)
    {
      $cdls = DB::table('degree_courses')
                  ->select('idDC', 'nameDC', 'department_id')
                  ->where('department_id', $idD)
                  ->get();
      return $cdls ->toJson();

    }
}
