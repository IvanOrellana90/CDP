<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Region;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::select('id as key','name as label')->get();

        return $regions;
    }
}