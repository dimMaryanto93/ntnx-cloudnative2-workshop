<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modelntnx extends Model
{
    //
    protected $karyawan=['Arief','Petrus','Duga','Yogi','Agung','Yudi'];

    public function list_semua()
    {
        return $this->karyawan;
    }
}
