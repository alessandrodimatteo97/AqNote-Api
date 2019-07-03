<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use Symfony\Component\HttpFoundation\Response;



class UsersController extends Controller
{
  public function __construct()
   {
       $this->middleware('auth');
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
              return response('ok' , 200)->header('Authorization', $apikey);
          }else{
              return response()->json('fail' ,401);
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
         return response()->json('Password are different',401);
       }

       $alreadyExists = DB::table('users')->
                        where('matriculationNumber', '=', $request->input('matriculationNumber'))->
                        get();

       if (!($alreadyExists->isEmpty())) {
        return response()->json('User with this matricula already exists!', 401);
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

        return response()->json('Registration Complete', 200);

    }

    public function infoUser(Request $request)
    {
      $user = DB::table('users')
            ->select('name', 'surname', 'mail', 'matriculationNumber', 'password')
            ->where('api_key', $request->header('Authorization'))
            ->get();

      return response()->json( $user );
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'mail' => 'required',
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'repeatPassword' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'matriculationNumber' => 'required'
        ]);

        $user = DB::table('users')->where('api_key', $request->header('Authorization'))->first();
        if(!(Hash::check($request->input('oldPassword'), $user->password)))
        {
            return response()->json('Old password is wrong', 401);
        }

        if(($request->input('newPassword')) != ($request->input('repeatPassword'))){
            return response()->json('Password are different',400);
        }

        $matriculation = DB::table('users')->select('matriculationNumber')->where('api_key', $request->header('Authorization'))->get();

        if( $matriculation != ($request->input('matriculationNumber')) ) {
            return response()->json('You cant change your matriculation number', 400);
        }

        $hashed = Hash::make($request->input('newPassword'));

        $finish = DB::table('users')
            ->where('api_key', $request->header('Authorization'))
            ->update(
                        [
                            'mail' => $request->input('mail'),
                            'password' => $hashed,
                            'name' => $request->input('name'),
                            'surname' => $request->input('surname'),
                            'matriculationNumber' => $request->input('matriculationNumber')
                        ]
                    );

        if($finish == 1){
            return response()->json('Update complete', 200);
        } else {
            return response()->json('Server error, we cannot update', 501);
        }

    }


}
