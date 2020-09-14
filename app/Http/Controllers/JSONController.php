<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Organization;
use Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class JSONController extends Controller
{
    public function initiativesData () {

        if(Request::get('commune') != '') 
        {
            $events = Event::select('id','name','verified','support_id', 'direction_id', 'contact_id', DB::raw('1 as initiative'))
            ->with('support.categories:name', 'support', 'direction.commune', 'direction.region', 'contact', 'support.beneficiaries')
            ->whereHas('direction.region', function($q) {
                $q->where('id', Request::get('region'));
            })
            ->whereHas('direction.commune', function($q) {
                $q->where('id', Request::get('commune'));
            })
            ->get()
            ->toArray();

            $organizations = Organization::select('id','name','verified','support_id', 'area_id', 'operation_id', 'contact_id', DB::raw('0 as initiative'))
            ->with('support.categories:name', 'support', 'area.regions:name', 'area.communes:name', 'operation:id', 'contact', 'support.beneficiaries')
            ->WhereHas('operation', function($q) {
                $q->where('id', 9);
            })
            ->orWhereHas('area.regions', function($q) {
                $q->where('area_region.region_id', Request::get('region'));
            })
            ->orWhereHas('area.communes', function($q) {
                $q->where('area_commune.commune_id', Request::get('commune'));
            })
            ->get()
            ->toArray();
        } elseif (Request::get('region') != '') 
        {
            $events = Event::select('id','name','verified','support_id', 'direction_id', 'contact_id', DB::raw('1 as initiative'))
            ->with('support.categories:name', 'support', 'direction.commune', 'direction.region', 'contact', 'support.beneficiaries')
            ->whereHas('direction.region', function($q) {
                $q->where('id', Request::get('region'));
            })
            ->get()
            ->toArray();

            $organizations = Organization::select('id','name','verified','support_id', 'area_id', 'operation_id', 'contact_id', DB::raw('0 as initiative'))
            ->with('support.categories:name', 'support', 'area.regions:name', 'area.communes:name', 'operation:id', 'contact', 'support.beneficiaries')
            ->WhereHas('operation', function($q) {
                $q->where('id', 9);
            })
            ->orWhereHas('area.regions', function($q) {
                $q->where('area_region.region_id', Request::get('region'));
            })
            ->get()
            ->toArray();
        } else 
        {
            $events = Event::select('id','name','verified','support_id', 'direction_id', 'contact_id', DB::raw('1 as initiative'))
            ->with('support.categories:name', 'support', 'direction.commune', 'direction.region', 'contact', 'support.beneficiaries')
            ->get()
            ->toArray();

            $organizations = Organization::select('id','name','verified','support_id', 'area_id', 'operation_id', 'contact_id', DB::raw('0 as initiative'))
            ->with('support.categories:name', 'support', 'area.regions:name', 'area.communes:name', 'operation:id', 'contact', 'support.beneficiaries')
            ->get()
            ->toArray();
        }

        

        $data = array_merge($events, $organizations);

        return $data;

    }

    public function organizationNames()
    {
        $organizations = Organization::select('name')->get();

        $organizationNames = array();

        foreach ($organizations as $organization) {
            array_push($organizationNames, $organization->name);
        }

        return $organizationNames;
    }
}
