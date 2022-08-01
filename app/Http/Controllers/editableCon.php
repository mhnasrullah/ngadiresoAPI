<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edit;
use App\Http\Resources\BeritaSrc;

class editableCon extends Controller
{
    public function getAll(){
        $data = Edit::first();
        // dd($data);
        return new BeritaSrc(true,'semua data yang bisa di edit',$data);
    }
}
