<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
  public function prova1()
  {
      $users = DB::table('users')->select('name', 'mail')->get();
      return response()->json([
        'name' => $users[0],
        'state' => $users[1]
      ]);
  }
}
