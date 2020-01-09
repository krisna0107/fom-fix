<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meja;

class MejaController extends Controller
{
    public function index($id){
        return Meja::where("id", $id)->first();
    }
}
