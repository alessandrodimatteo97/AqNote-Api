<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class Subject extends Model
{
    protected $connection =  'mysql';
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $fillable = ['nameS', 'year'];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public function cdls()
    {
        return $this->belongsTo('App\Cdl');
    }

    public function notes()
    {
        return $this->belongsToMany('App\Model\User', 'notes', 'subject_ids')->using('App\Model\Note')
                    ->withPivot([
                        'title',
                        'description',
                        'user_id',
                        'subject_id'
                    ]);
    }
}
