<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
                                            FROM (SELECT u.name, n.idN ,s.nameS, s.year, n.title, n.description ,count(c.note_id) as comments,avg(c.like)-1 as avarage  from subjects as s  join notes as n on n.subject_id=s.id inner join comments as c on n.idN=c.note_id join users u on u.idU = n.user_id join photos p on n.idN = p.note_id where s.degreeCourse_id ='$idDc[0]' group by s.nameS, c.note_id   
                                            )  t1  join (SELECT  note_id as idN,count(note_id) FROM  AqNoteApi.photos join  notes n on n.idN = photos.idP group by note_id)  t2
                                             on t1.idN = t2.idN ;")->getValue());
        return collect($hello)->groupBy('nameS');

    }

    function download(){

        $file= "../public/storage/1/13/1-.jpg";
        //$file = new Array_("../public/storage/1/13/1-.jpg");
        //$file->
        $type = 'image/jpg';
        $headers = ['Content-Type' => $type];
        $path=storage_path('pr.jpeg');
        $response = new BinaryFileResponse($file, 200 , $headers);

        return $response;

    }

}
