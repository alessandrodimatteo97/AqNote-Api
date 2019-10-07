<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;


class DepartmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //  $this->middleware('auth');
    }

    public function listDepart()
    {
    //  $user = Auth::user()->first();

      $departments = DB::table('departments')->select('idD', 'nameD')->get();
      return $departments;

    }

  /*  public function infoDepart($idD)
    {
      $user = Auth::user()->first();


      $department = DB::table('departments')
                        ->select('idD', 'nameD')
                        ->where('idD', $idD)
                        ->get();

      return response()
              ->json([
                        'department' => $department
                    ]);
    }
*/
}
