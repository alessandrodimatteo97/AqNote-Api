<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExampleController extends Controller
{   // funzione per la home page, da aggiungere ancora la distinzione 1,2,3 anno
    function homePage($NameDC)
    {
        //in input abbiamo il nome di degreeCourse
        $idDc = DB::table('degree_courses')
            ->select('idDC')
            ->where('nameDC', '=', $NameDC)
            ->pluck('idDC');
        //return $idDc;

        $hello = DB::select(DB::raw("SELECT *
                        FROM (SELECT u.name, n.idN ,s.nameS,s.year, n.title, n.description ,count(c.note_id) as comments,avg(c.like)-1 as avarage  from subjects as s  join notes as n on n.subject_id=s.id inner join comments as c on n.idN=c.note_id join users u on u.idU = n.user_id join photos p on n.idN = p.note_id where s.degreeCourse_id =1 group by s.nameS, c.note_id
                        )  t1   join (SELECT title, idN, idP FROM notes n left join photos p on n.idN = p.note_id where p.note_id is null or p.note_id is not null)  t2
                            on t1.idN = t2.idN order by t1.nameS;")->getValue());
      //  $prova= collect($hello)->groupBy('nameS');//->groupBy('year')->groupBy('nameS');//;

        $prova = collect($hello)->groupBy(['year',function($item){
             return $item->nameS;
         },
             ]);
         return $prova;
    }
    /*
     * $result = $data->groupBy([
    'skill',
    function ($item) {
        return $item['roles'];
    },
], $preserveKeys = true);
     */



/*
 * QUESTA NON CALCOLA BENE GLI AVERAGE E IL NUMERO DI COMMENTI
SELECT *
FROM (SELECT u.name, n.idN ,s.nameS, n.title, n.description ,count(c.note_id) as comments,avg(c.like)-1 as avarage  from subjects as s  join notes as n on n.subject_id=s.id inner join comments as c on n.idN=c.note_id join users u on u.idU = n.user_id join photos p on n.idN = p.note_id where s.degreeCourse_id =1 group by s.nameS, c.note_id
)  t1   join (SELECT title, idN, idP FROM notes n left join photos p on n.idN = p.note_id where p.note_id is null or p.note_id is not null)  t2
on t1.idN = t2.idN order by t1.nameS;

// non mi ricordo la differenza tra queste 2
QUESTA DOVREBBER ESSERE QUELLA GIUSTA
SELECT *
                                            FROM (SELECT u.name, n.idN ,s.nameS, s.year, n.title, n.description ,count(c.note_id) as comments,avg(c.like)-1 as avarage  from subjects as s  join notes as n on n.subject_id=s.id inner join comments as c on n.idN=c.note_id join users u on u.idU = n.user_id join photos p on n.idN = p.note_id where s.degreeCourse_id ='$idDc[0]' group by s.nameS, c.note_id
                                            )  t1  join (SELECT  note_id as idN,count(note_id) FROM  AqNoteApi.photos join  notes n on n.idN = photos.idP group by note_id)  t2
                                             on t1.idN = t2.idN
 */
    function download(){

        $file= "../public/storage/1/13/1-.jpg";
        //$file = new Array_("../public/storage/1/13/1-.jpg");
        //$file->
        $type = 'image/jpg';
        $headers = ['Content-Type' => $type];
        $path=storage_path('pr.jpeg');
        $image = new Image();
        $image = $file;
        $response = new BinaryFileResponse($file, 200 , $headers);
        //return $response;
        return $image;
    }

}
