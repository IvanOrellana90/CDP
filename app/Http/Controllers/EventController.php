<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Support;
use App\Help;
use App\Contact;
use App\Event;
use App\Direction;
use App\Date;
use App\Organization;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('direction','support')->get();

        return $events;
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
            'eventName' => 'required',
            'eventType' => 'required',
            'eventDirectionRegion' => 'required',
            'eventDirectionCommune' => 'required',
            'eventDirectionStreet' => 'required',
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

            // Creando Dirección

            $direction = new Direction();
            
            $direction->country_id = 1;
            $direction->region_id = $request->eventDirectionRegion;
            $direction->commune_id = $request->eventDirectionCommune;
            $direction->street = $request->eventDirectionStreet;
            $direction->number = $request->eventDirectionNumber;
            $direction->detail = $request->eventDirectionDetail;
            
            $direction->save();

            // Creando Contacto

            $contact = new Contact();

            $contact->phone = $request->contactPhone;
            $contact->email = $request->contactEmail;
            $contact->web = $request->contactWeb;
            $contact->facebook = $request->contactFacebook;
            $contact->twitter = $request->contactInstagram;
            $contact->instagram = $request->contactTwitter;

            $contact->save();

            // Creando Evento

            $event = new Event();

            $event->name = $request->eventName;
            $event->direction_id = $direction->id;
            $event->support_id = $support->id;
            $event->contact_id = $contact->id;

            if($request->eventType == 1) {
                // Recurrente

                $event->type = "1";
                $event->save();

                $i = 0; // Cantidad de semanas (dias) que se repite el evento

                while ($i < 21) {
                    foreach ($request->eventHour as $key => $hours) {
                    
                        $date = Carbon::now();
                        $date = $date->startOfWeek();

                        // Dia lunes de esta semana más los días del formulario
                        $date = $date->addDay($key + $i)->format('Y-m-d');

                        foreach ($hours as $value) {

                            $start = Carbon::createFromFormat('Y-m-d H:i', $date .' '.$value, 'America/Santiago');

                            $date = new Date();

                            $date->event_id = $event->id;
                            $date->start = $start->format('Y-m-d H:i:s');

                            $date->save();
                        }
                    }
                    // Sumamos 7 para pasar a la siguiente semana
                    $i = $i + 7;
                }

            } else {
                // Una sola vez

                $event->type = "2";
                $event->save();

                $date = new Date();

                $date->event_id = $event->id;
                $date->start = Carbon::parse($request->dateStart)->setTimezone( 'America/Santiago' )->format('Y-m-d H:i:s');
                $date->end = Carbon::parse($request->dateEnd)->setTimezone( 'America/Santiago' )->format('Y-m-d H:i:s');

                $date->save();
            }
            
        } catch (Exception $ex){
            
            Log::error("Error in store(new-event): ".$ex->getMessage());

            DB::rollBack();

            return;
        }

        DB::commit();

        return;
    }

    public function linkEventOrganization(Request $request) {
        
        $this->validate($request, [
            'eventName' => 'required',
            'organizationName' => 'required'
        ]);

        DB::beginTransaction();

        try {

            $event = Event::where('name', $request->eventName)->latest('created_at')->first();
            $organization = Organization::where('name', $request->organizationName)->latest('created_at')->first();
            
            if($organization == null) {
                return ['title' => 'No tenemos registros de esta organización', 
                        'text' => '¿Te gustaría ingresar esta nueva organización a nuestro sitio?',
                        'color' => 'warning', 
                        'url' => 'new-organization',
                        'type' => 'dialog'];
            }

            $event->organizations()->sync($organization->id);

        } catch (Exception $ex){
            
            Log::error("Error in store(new-event-organization): ".$ex->getMessage());

            DB::rollBack();

            return;
        }

        DB::commit();
        
        return ['title' => 'Gracias por completar tu información', 
                'text' => 'En cuanto verifiquemos tu información la podrás ver en el sitio.',
                'color' => 'success', 
                'url' => '/',
                'type' => 'notify'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
