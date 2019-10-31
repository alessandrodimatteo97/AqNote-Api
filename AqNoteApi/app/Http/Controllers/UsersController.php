<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Middleware\CorsMiddleware;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use App\Model\Cdl;
use App\Model\Subject;

class UsersController extends Controller
{
  public function __construct()
   {
       //$this->middleware('CorsMiddleware');
     //
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

             return response()->json($user , 200 )->withHeaders([
                                                                          'Access-Control-Expose-Headers' => 'Authorization',
                                                                          'Authorization' => $apikey,
                                                                          //'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',

              ]);
          }else{
              return response()->json('fail' ,411);
          }
    }

    public function signUp (Request $request)
    {
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required',
      'repeatPassword' => 'required',
      'name' => 'required',
      'surname' => 'required',
      'cdl' => 'required',
       ]);


        $id_cdl = DB::table('degree_courses')
                        ->select('idDC')
                        ->where('nameDC', '=', $request->input('cdl'))
                        ->pluck('idDC');

       if(($request->input('password')) != ($request->input('repeatPassword'))){
         return response()->json('Password are different',401);
       }

       $userExists = DB::table('users')
                        ->select('mail')
                        ->where('mail', '=', $request->input('email'))
                        ->pluck('mail');

       if($userExists == null){
           return response()->json('UserExists Already',411);
       }

       $hashed = Hash::make($request->input('password'));

       DB::table('users')->insert([
          [
           'mail' => $request->input('email'),
           'password' => $hashed,
           'name' => $request->input('name'),
           'surname' => $request->input('surname'),
           'cdl_id' => $id_cdl[0]
          ]
        ]);
        echo  $request->input('email');
        echo  $hashed;
           echo  $request->input('name');
          echo  $request->input('surname');
          echo  $id_cdl[0];
        //return response()->json('Registration Complete', 200);

    }

    public function updateProfile(Request $request)
    {/*
        $this->validate($request, [
            'mail' => 'required',
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'DegreeCourse' => 'required'
        ]);
*/
        // OldPassword, NewPAssword, cdlId, mail

        $user = DB::table('users')->where('api_key', $request->header('Authorization'))->first();
        if(($request->input('OldPassword') ==! null) && !(Hash::check($request->input('OldPassword'), $user->password))) {

            return response()->json($user, '409');
        }
        else {
            if($request->input('mail') != $user->mail){
                $hashed = Hash::make($request->input('Newpassword'));
                $finish = DB::table('users')
                    ->where('api_key', $request->header('Authorization'))
                    ->update(
                        [
                            'mail' => $request->input('mail'),
                            'password' => $hashed,
                            'cdl_id' => $request->input('cdl_id')
                        ]
                    );
            }
            else {
                $hashed = Hash::make($request->input('Newpassword'));
                $finish = DB::table('users')
                    ->where('api_key', $request->header('Authorization'))
                    ->update(
                        [
                            'password' => $hashed,
                            'cdl_id' => $request->input('cdl_id')
                        ]
                    );

            }
        }
        if($finish == 1){
            $final = DB::table('users')->where('api_key', '=', $request->header('Authorization'))->first();
            return response()->json($final, 200);
        } else {
            return response()->json($user, 501);
        }

    }

    public function ImageProfile(Request $request)
    {
        if ($request->hasFile('file'))
        {
            $idU = DB::table('users')->where('api_key', '=', $request->header('Authorization'))->first('idU');

            $namePic = $request->file('file')->getClientOriginalName();
            if(file_exists('../public/profiles/' . $idU->idU)) {
                unlink(glob('../public/profiles/' . $idU->idU . '/*.*')[0]);

            }
            $pathWhereSave = '../public/profiles/'.$idU->idU;
            $imageB64 = $request->file('file');
            $imageB64->move($pathWhereSave, $namePic);

            return response()->json('OK', 200);
          // file glob('../public/profiles/'.$user->idU.'/*.*')glob('../public/profiles/'.$user->idU.'/*.*')
        } else {
            return response()->json('Internal Server Error', 555)
                ->header('Content-Type', 'application/json');
        }
    }

    public function downloadImageProfile(Request $request){

       $user = DB::table('users')->where('api_key', '=', $request->header('Authorization'))->first();
       //return response()->json($user->idU);
        if( glob('../public/profiles/'.$user->idU.'/*.*')==null){
           return ;
        }
        return response()->json( 'data:image/jpg;base64, '.base64_encode(file_get_contents(glob('../public/profiles/'.$user->idU.'/*.*')[0])), 200);
       // return $collection->put('image', 'data:image/jpg;base64, '.base64_encode(file_get_contents(glob('../public/profiles/'.$user->idU.'/*.*')[0])))->toJson();
      //  return $ImageProfile= 'data:image/jpg;base64, '.base64_encode(file_get_contents(glob('../public/profiles/'.$user->idU.'/*.*')[0]));


   }

   public function getMyComments (Request $request)
   {

       $user = DB::table('users')->where('api_key', '=', $request->header('Authorization'))->first();
       $comments = DB::table('comments')
                    ->join('notes', 'comments.note_id', '=', 'notes.idN')
                    ->join('users', 'notes.user_id', '=', 'users.idU')
                    ->select('comments.titleC', 'comments.text', 'comments.like', 'notes.title', 'users.name', 'users.surname')
                    ->where('comments.user_id', '=', $user->idU)
                    ->get();

       return response()->json($comments, 200);
   }

   public function favouriteNote($idU) {
       $fav = DB::table('subjects')
           ->join('notes', 'notes.subject_id', '=', 'subjects.id')
           ->join('favourites', 'favourites.note_id', '=', 'notes.idN')
           ->select('subjects.nameS', 'notes.title', 'favourites.id')
           ->where('favourites.user_id', '=', $idU)
           ->get();
       // ->groupBy('nameS')->values();
       return $fav->groupBy('nameS');
   }


}

/*
 *
 *
 *
 */
