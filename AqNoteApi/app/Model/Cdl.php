<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Cdl extends Model
{
    protected $table = 'degree_courses';
    protected $primaryKey = 'idDC';
    protected $fillable = ['nameDC'];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public function users()
    {
        return $this->hasMany('App\Model\User');
    }

    public function departments()
    {
        return $this->belongsTo('App\Model\Department');
    }
}
