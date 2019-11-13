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
;
        if(!($request->filled('password')) ||  !($request->filled('repeatPassword'))){
            return response()->json('password are void',307);
        }

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
        return response()->json('Registration Complete', 200);

    }

    public function updateProfile(Request $request)
    {

        if(!($request->filled('OldPassword'))){
            return response()->json('Old password is void',422);
        }


        $user = DB::table('users')
            ->where('api_key', $request->header('Authorization'))
            ->first();

        if((DB::table('users')
                ->where('mail', '=', $request->input('mail'))
                ->where('api_key', '<>', $request->header('Authorization'))
                ->count('idU')) >= 1
            && ($request->filled('mail')))
        {
            return response()->json('We already have a user with this email',421);
        }

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
                       //     'password' => $hashed,
                            'cdl_id' => $request->input('cdl_id')
                        ]
                    );
            }
            else {
                $finish = DB::table('users')
                    ->where('api_key', $request->header('Authorization'))
                    ->update(
                        [
                           // 'password' => $hashed,
                            'cdl_id' => $request->input('cdl_id')
                        ]
                    );

            }
            if($request->input('Newpassword')!=''){
                $hashed = Hash::make($request->input('Newpassword'));

                $finish = DB::table('users')
                    ->where('api_key', $request->header('Authorization'))
                    ->update(
                        [
                            'password' => $hashed,
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
   public function NotesProfile(Request $request){
      $idU = DB::table('users')
                ->select('idU')
                ->where('api_key', '=', $request->header('Authorization'))
                ->first();

      $query = DB::select(DB::raw("select * from (select notes.idN, notes.title, notes.subject_id as idS,count(comments.idCO) as comment, ifnull(avg(comments.like)-1, 0) as likes from notes  left join comments on  notes.idN = comments.note_id  where (comments.idCO is null || comments.idCO is not null) && notes.user_id = $idU->idU group by notes.idN) t1 join (select idN, count(photos.idP) as pages from notes left join photos on notes.idN = photos.note_id where (photos.idP is null || photos.idP is not null) group by notes.idN) t2 on t1.idN = t2.idN;"));
    return $query;
      //     select * from (select notes.idN, notes.title, count(comments.idCO), ifnull(avg(comments.like)-1, 0) as likes from notes  left join comments on  notes.idN = comments.note_id  where (comments.idCO is null || comments.idCO is not null) && notes.user_id = 13 group by notes.idN) t1 join (select idN, count(photos.idP) from notes left join photos on notes.idN = photos.note_id where (photos.idP is null || photos.idP is not null) group by notes.idN) t2 on t1.idN = t2.idN;
        // la query è qui
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

   public function favouriteNote($idU)
   {



       $fav = DB::table('subjects')
           ->where('favourites.user_id', '=', $idU)
           ->join('notes', 'notes.subject_id', '=', 'subjects.id')
           ->join('favourites', 'favourites.note_id', '=', 'notes.idN')
           ->select('subjects.id', 'subjects.nameS', 'notes.title', 'notes.idN')
           ->get();
       // ->groupBy('nameS')->values();
       $results = $fav->map(function($item, $key){
           $comments = DB::table('comments')->select('idCO')->where('note_id', '=', $item->idN)->count();
           $pages = DB::table('photos')->select('idP')->where('note_id', '=', $item->idN)->count();
         //  $favourites = DB::table('')->select()
           $like = DB::table('comments')->select('like')->where('note_id', '=', $item->idN)->avg('like');
           $item->pages = $pages;
           $item->comments = $comments;
           $item->like = $like-1;
           return $item;
       });
       return $results->groupBy('nameS');
   }


   public function DeleteNote($idN){
      // return response()->json(('idN'));
       $query = DB::table('notes')->where('idN', '=', $idN)->delete();
       return response()->json($query);
   }
// notes deve avere numero di pagine, numero di commenti
// stelline
}

/*
 *
 *
 *
 */
