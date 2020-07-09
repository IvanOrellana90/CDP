<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Organization;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class JSONController extends Controller
{
    public function initiativesData () {

        $events = Event::select('id','name','verified','support_id', 'direction_id', DB::raw('1 as initiative'))
            ->with('support.categories:name', 'direction.commune')
            ->get()
            ->toArray();

        $organizations = Organization::select('id','name','verified','support_id', 'area_id', 'operation_id', DB::raw('0 as initiative'))
            ->with('support.categories:name', 'area.regions:name', 'area.communes:name', 'operation:id,name,description')
            ->get()
            ->toArray();

        $data = array_merge($events, $organizations);

        return $data;

    }
}
