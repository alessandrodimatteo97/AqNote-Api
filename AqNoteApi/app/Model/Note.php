<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Note extends Pivot
{
    protected $connection =  'mysql';
    protected $table = 'notes';
    protected $primaryKey = 'idN';
    protected $fillable = ['title', 'description'];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
    public $incrementing = true;

    public function users()
    {
        return $this->hasOne('App\Model\User', 'idU', 'user_id');
    }

    public function subjects()
    {
        return $this->hasOne('App\Model\Subject', 'idS', 'subject_id');
    }

    public function noteWithUser()
    {
    }

}
