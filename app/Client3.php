<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client3 extends Model
{
    //
    protected $connection = 'pgsql3';
    protected $table = 'clients';
    protected $fillable = ['title','name', 'last_name', 'address', 'zip_code', 'city', 'state', 'email'];

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
