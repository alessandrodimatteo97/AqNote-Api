<?php


namespace App\Model;
use App\Model\Cdl;
use App\Model\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model
{
   //
   use AuthenticableTrait;
   protected $table = 'users';
   protected $primaryKey = 'idU';
   protected $fillable = ['name', 'surname', 'mail', 'password', 'api_key'];
   protected $hidden = [
       'password', 'api_key'
   ];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
   /*
   * Get Todo of User
   *
   */
    public function Cdls()
    {
        return $this->belongsTo('App\Model\Cdl', 'cdl_id');
    }

    public function notes()
    {
        return $this->belongsToMany('App\Model\Subject', 'notes', 'user_id')->using('App\Model\Note')
                    ->withPivot([
                        'title',
                        'description',
                        'user_id',
                        'subject_id'
                    ]);
    }


}
