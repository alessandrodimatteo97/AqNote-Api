<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'idD';
    protected $fillable = ['nameD'];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    public function cdl()
    {
        return $this->hasMany('App\Model\Cdl');
    }
}
