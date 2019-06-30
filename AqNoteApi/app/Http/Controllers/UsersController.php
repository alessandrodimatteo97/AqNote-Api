<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{
  public function __construct()
   {
     //  $this->middleware('auth:api');
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function authenticate(Request $request)
   {
       $this->validate($request, [
       'mail' => 'required',
       'password' => 'required'
        ]);
      $user = DB::table('users')->where('mail', $request->input('mail'))->first();
         if(Hash::check($request->input('password'), $user->password)){
              $apikey = base64_encode(str_random(40));
              DB::table('users')->where('mail', $request->input('mail'))->update(['api_key' => "$apikey"]);;
              return response()->json(['status' => 'success','api_key' => $apikey]);
          }else{
              return response()->json(['status' => 'fail'],401);
          }
    }

    public function signUp (Request $request)
    {
      $this->validate($request, [
      'mail' => 'required',
      'password' => 'required',
      'repeatPassword' => 'required',
      'name' => 'required',
      'surname' => 'required',
      'matriculationNumber' => 'required'
       ]);

       if(($request->input('password')) != ($request->input('repeatPassword'))){
         return response()->json(['status' => 'Password are different'],401);
       }

       $alreadyExists = DB::table('users')->
                        where('matriculationNumber', '=', $request->input('matriculationNumber'))->
                        get();

       if (!($alreadyExists->isEmpty())) {
        return response()->json(['status' => 'Already exists this user'], 401);
       }

       $hashed = Hash::make($request->input('password'));

       DB::table('users')->insert([
          ['mail' => $request->input('mail'),
           'password' => $hashed,
           'name' => $request->input('name'),
           'surname' => $request->input('surname'),
           'matriculationNumber' => $request->input('matriculationNumber')
          ]
        ]);

        return response()->json(['status' => 'Registration Complete'], 200);

    }

    public function infoUser($id)
    {

      $user = DB::table('users')->
              select('idU', 'name', 'surname', 'mail', 'matriculationNumber')->
              where('idU', $id)->
              get();

      return response()->
              json([
                      'user' => $user
                  ]);
    }
}
