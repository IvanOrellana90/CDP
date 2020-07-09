<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Street;

class StreetController extends Controller
{
    public function index()
    {
        $streets = Street::select('id','name as title')->get();

        return $streets;
    }
}