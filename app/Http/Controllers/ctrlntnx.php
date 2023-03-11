<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modelntnx as modelntnx;

class ctrlntnx extends Controller
{
    //

    public function all(modelntnx $modelntnx)
    {
        $this->modelntnx = $modelntnx->list_semua();
        $data = $this->modelntnx;
        //dd($data);
        return view ('view_se')->with('data', $data);
    }
}
