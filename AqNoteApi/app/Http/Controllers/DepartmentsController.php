<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class DepartmentsController extends Controller
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

    public function listDepart()
    {
      $departments = DB::table('departments')->select('idD', 'nameD')->get();

      return response()->
              json([
                      'departments' => $departments
                  ]);
    }

    public function infoDepart($idD)
    {
      $department = DB::table('departments')
                        ->select('idD', 'nameD')
                        ->where('idD', $idD)
                        ->get();

      return response()
              ->json([
                        'department' => $department
                    ]);
    }

}
