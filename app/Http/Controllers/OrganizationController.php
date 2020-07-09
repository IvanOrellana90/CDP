<?php

namespace App\Http\Controllers;

use App\Support;
use App\Help;
use App\Contact;
use App\Organization;
use App\Direction;
use App\Area;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = Organization::get();

        return $organizations;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nameOrganization' => 'required',
            'categoryOrganization' => 'required',
            'operationOrganization' => 'required',
            'operationCountry' => 'required',
            'supportType' => 'required',
            'supportBeneficiaries' =>'required'
        ]);

        DB::beginTransaction();

        try {

            // Creando Apoyo

            $support = new Support();

            $support->description = $request->supportDescription;
            $support->number_beneficiaries = $request->supportBeneficiariesNumber;
            $support->save();

            // Creando apoyo-categorias y apyo-beneficiarios

            $support->categories()->sync($request->supportType);
            $support->beneficiaries()->sync($request->supportBeneficiaries);

            if($request->showNeedHelp) {

                // Creando Ayuda

                $help = new Help();

                $help->support_id = $support->id;
                $help->description = $request->helpDescription;

                $help->save();

                // Creando ayuda-categorias

                $help->categories()->sync($request->helpType);
            }

            // Creando aréa de acción

            $area = new Area();

            $area->detail = $request->operationDetail;
            $area->save();

            if($request->operationOrganization == 12) {
                $direction = new Direction();

                $direction->street = $request->operationOrganizationStreet;
                $direction->number = $request->operationOrganizationNumber;
                
                $direction->save();

                $area->directions()->attach($direction->id);
                $area->regions()->sync($request->operationCommune);
                $area->communes()->sync($request->operationRegion);

            } elseif ($request->operationOrganization == 11) {
                $area->communes()->sync($request->operationCommune);
                $area->communes()->sync($request->operationRegion);
            } else {
                $area->regions()->sync($request->operationRegion);
            } 

            // Creando Contacto

            $contact = new Contact();

            $contact->phone = $request->contactPhone;
            $contact->email = $request->contactEmail;
            $contact->web = $request->contactWeb;
            $contact->facebook = $request->contactFacebook;
            $contact->twitter = $request->contactInstagram;
            $contact->instagram = $request->contactTwitter;

            $contact->save();

            // Creando Organización

            $organization = new Organization();

            $organization->name = $request->nameOrganization;
            $organization->category_id = $request->categoryOrganization;
            $organization->operation_id = $request->operationOrganization;
            $organization->rut = $request->rutOrganization;
            $organization->support_id = $support->id;
            $organization->contact_id = $contact->id;
            $organization->area_id = $area->id;

            $organization->save();

            if($request->showAddressOrganization) {

                // Creando Dirección Casa Matriz

                $directionOrganization = new Direction();
                $directionOrganization->country_id = 1;
                $directionOrganization->region_id = $request->addressRegionOrganization;
                $directionOrganization->commune_id = $request->addressCommuneOrganization;
                $directionOrganization->street = $request->addressStreetOrganization;
                $directionOrganization->number = $request->addressNumberOrganization;
                $directionOrganization->save();

                $organization->directions()->attach($directionOrganization->id);

            }
            
        } catch (Exception $ex){
            
            Log::error("Error in store(new-organization): ".$ex->getMessage());

            DB::rollBack();

            return;
        }

        DB::commit();

        return;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->destroy();

        return;
    }
}
