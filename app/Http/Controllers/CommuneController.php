<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Commune;

class CommuneController extends Controller
{
    public function index()
    {
        $communes = Commune::join('provinces','provinces.id','=','communes.province_id')
            ->select('communes.id as key','communes.name as label', 'region_id')
            ->get();

        return $communes;
    }
}