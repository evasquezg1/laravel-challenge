<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use Auth;

class ControllerEvent extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //
    // formulario de evento
    public function form(){
      return view("evento/form");
    }

    // guardar evento
    public function create(Request $request){

      // validacion
     $this->validate($request, [
     'titulo'     =>  'required',
     'descripcion'  =>  'required',
     'fecha' =>  'required'
    ]);

    // guarda la base de datos
     Event::insert([
       'titulo'       => $request->input("titulo"),
       'descripcion'  => $request->input("descripcion"),
       'color'  => $request->input("color"),
       'fecha_i'        => $request->input("fecha"),
       'fecha_f'        => $request->input("fecha_f"),
       'id_user'        => $request->input("id_user")
     ]);

     // devuelve el mensaje de exito
     return back()->with('success', 'Evento guardado');

   }

   public function edit(Request $request){

      // validacion
     $this->validate($request, [
     'titulo'     =>  'required',
     'descripcion'  =>  'required',
     'fecha' =>  'required',
     'fecha_f' => 'required'
    ]);

    // guarda la base de datos
    Event::where('id',$request->input('id_evento'))->update(array(
      'titulo'=>$request->input("titulo"),"descripcion"=>$request->input("descripcion"),"color"=>$request->input("color"),"fecha_i"=>$request->input("fecha"),"fecha_f"=>$request->input("fecha_f")
    ));

     // devuelve el mensaje de exito
     return back();

   }


   public function details($id){

      // llamar evento por id
      $event = Event::find($id);

      return view("evento/evento",[
        "event" => $event
      ]);

    }

   // ======================== CANDELARIO =================
   public function index(){

      $month = date("Y-m");
      //
      $data = $this->calendar_month($month);
      $mes = $data['month'];
      // obtener mes en espanol
      $mespanish = $this->spanish_month($mes);
      $mes = $data['month'];

      return view("evento/calendario",[
        'data' => $data,
        'mes' => $mes,
        'mespanish' => $mespanish
      ]);

  }

  public function dia(){
    $dia = date("Y-m-d");
    
    $datanew = Event::where(["fecha_i"=>$dia,"id_user"=>Auth::user()->id])->get();

    return view('evento/dia', [
      'eventos' => $datanew,
      'dia' => $dia
    ]);
  }

  public function fivedays(){
    $dia = date("Y-m-d");

    $nuevafecha = strtotime ( '+4 day' , strtotime ( $dia ) ) ;
    $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
    
    $datanew = Event::where("id_user",Auth::user()->id)->whereBetween("fecha_i",array($dia, $nuevafecha))->get();

    return view('evento/5dias', [
      'eventos' => $datanew,
      'dia' => $dia,
      'Fdias' => $nuevafecha
    ]);
  }

  public function index_month($month){

     $data = $this->calendar_month($month);
     $mes = $data['month'];
     // obtener mes en espanol
     $mespanish = $this->spanish_month($mes);
     $mes = $data['month'];

     return view("evento/calendario",[
       'data' => $data,
       'mes' => $mes,
       'mespanish' => $mespanish
     ]);

   }

   public static function calendar_month($month){
     //$mes = date("Y-m");
     $mes = $month;
     //sacar el ultimo de dia del mes
     $daylast =  date("Y-m-d", strtotime("last day of ".$mes));
     //sacar el dia de dia del mes
     $fecha      =  date("Y-m-d", strtotime("first day of ".$mes));
     $daysmonth  =  date("d", strtotime($fecha));
     $montmonth  =  date("m", strtotime($fecha));
     $yearmonth  =  date("Y", strtotime($fecha));
     // sacar el lunes de la primera semana
     $nuevaFecha = mktime(0,0,0,$montmonth,$daysmonth,$yearmonth);
     $diaDeLaSemana = date("w", $nuevaFecha);
     $nuevaFecha = $nuevaFecha - ($diaDeLaSemana*24*3600); //Restar los segundos totales de los dias transcurridos de la semana
     $dateini = date ("Y-m-d",$nuevaFecha);
     //$dateini = date("Y-m-d",strtotime($dateini."+ 1 day"));
     // numero de primer semana del mes
     $semana1 = date("W",strtotime($fecha));
     // numero de ultima semana del mes
     $semana2 = date("W",strtotime($daylast));
     // semana todal del mes
     // en caso si es diciembre
     if (date("m", strtotime($mes))==12) {
         $semana = 5;
     }
     else {
       $semana = ($semana2-$semana1)+1;
     }
     // semana todal del mes
     $datafecha = $dateini;
     $calendario = array();
     $iweek = 0;
     while ($iweek < $semana):
         $iweek++;
         //echo "Semana $iweek <br>";
         //
         $weekdata = [];
         for ($iday=0; $iday < 7 ; $iday++){
           // code...
           $datafecha = date("Y-m-d",strtotime($datafecha."+ 1 day"));
           $datanew['mes'] = date("M", strtotime($datafecha));
           $datanew['dia'] = date("d", strtotime($datafecha));
           $datanew['fecha'] = $datafecha;
           //AGREGAR CONSULTAS EVENTO
           // consulta evento y filtra por fecha
           $datanew['evento'] = Event::where(["fecha_i"=>$datafecha,"id_user"=>Auth::user()->id])->get();
           //var_dump($datanew['evento']);
           array_push($weekdata,$datanew);
         }
         $dataweek['semana'] = $iweek;
         $dataweek['datos'] = $weekdata;
         //$datafecha['horario'] = $datahorario;
         array_push($calendario,$dataweek);
     endwhile;
     $nextmonth = date("Y-M",strtotime($mes."+ 1 month"));
     $lastmonth = date("Y-M",strtotime($mes."- 1 month"));
     $month = date("M",strtotime($mes));
     $yearmonth = date("Y",strtotime($mes));
     //$month = date("M",strtotime("2019-03"));
     $data = array(
       'next' => $nextmonth,
       'month'=> $month,
       'year' => $yearmonth,
       'last' => $lastmonth,
       'calendar' => $calendario,
     );
     return $data;
   }

   public static function spanish_month($month)
   {

       $mes = $month;
       if ($month=="Jan") {
         $mes = "Enero";
       }
       elseif ($month=="Feb")  {
         $mes = "Febrero";
       }
       elseif ($month=="Mar")  {
         $mes = "Marzo";
       }
       elseif ($month=="Apr") {
         $mes = "Abril";
       }
       elseif ($month=="May") {
         $mes = "Mayo";
       }
       elseif ($month=="Jun") {
         $mes = "Junio";
       }
       elseif ($month=="Jul") {
         $mes = "Julio";
       }
       elseif ($month=="Aug") {
         $mes = "Agosto";
       }
       elseif ($month=="Sep") {
         $mes = "Septiembre";
       }
       elseif ($month=="Oct") {
         $mes = "Octubre";
       }
       elseif ($month=="Oct") {
         $mes = "December";
       }
       elseif ($month=="Dec") {
         $mes = "Diciembre";
       }
       else {
         $mes = $month;
       }
       return $mes;
   }
}
