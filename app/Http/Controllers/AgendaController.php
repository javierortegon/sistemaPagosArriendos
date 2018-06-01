<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Agenda;
 
use Calendar;
 
class AgendaController extends Controller
{
    public function getAgenda(){
        return view('agenda.tablaAgenda');
    }
    public function getDataTableAgenda(){
        $queryConsulta = Agenda::select( 'agenda.event_name',
                                        'agenda.start_date',
                                        'propiedades.codigo as inmueble',
                                        'users.name as cliente')
        ->join('users','agenda.cliente','=','users.id')
        ->join('ventas','agenda.venta','=','ventas.id')
        ->join('propiedades','ventas.propiedad','=','propiedades.id')
        ->get();
        return \DataTables::of($queryConsulta)->make(true);
    }
    public function index(){
    	$events = Agenda::get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
                $event->event_name,
                true,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date.' +1 day')
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
 
        return view('agenda.agenda', compact('calendar_details') );
    }
 
    public function addEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
 
        if ($validator->fails()) {
        	\Session::flash('warnning','Please enter the valid details');
            return Redirect::to('/agenda')->withInput()->withErrors($validator);
        }
 
        $event = new Agenda;
        $event->event_name = $request['event_name'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->save();
 
        \Session::flash('success','Event added successfully.');
        return Redirect::to('/agenda');
    }
 
 
}