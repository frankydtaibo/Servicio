<?php

namespace App\Http\Controllers;

use App\Servicio;
use App\ServicioPsicologo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ServiceController extends Controller
{
   


    public function blog(){
        //llama a la tabla servicio_psicologo y se guarda en una variable
        $notas = DB::table('servicio_psicologo')
        //se crea  join 
        ->join('servicio', 'servicio.id_servicio',  '=' , 'servicio_psicologo.id_servicio_psicologo')
        //se crea la consulta select
        ->select('servicio_psicologo.id_servicio_psicologo','servicio_psicologo.duracion', 'servicio_psicologo.estado_servicio as Estado' , 'servicio_psicologo.precio_particular as Precio', 'servicio.nombre as Servicio' , 'servicio.descripcion as Descripcion')
        ->get();
        //se retorna la variable notas a la vista blog
        return view('blog',compact('notas'));
    }

    public function detalle($id){
        $nota = ServicioPsicologo::findOrFail($id);
        return view('detalle', compact('nota'));
    }

    public function crear(Request $request){
        //return $request->all();
        $request->validate(['duracion'=> 'required', 'estado_servicio'=>'required', 'precio_particular'=>'required', 'servicioPsicologo'=>'required']);
       //se crea objeto de ServicioPsicologo
        $notaNueva = new ServicioPsicologo;
         //Asignar datos de los input al objeto
        $notaNueva->duracion = $request->duracion;
        $notaNueva->estado_servicio = $request->estado_servicio;
        $notaNueva->precio_particular = $request->precio_particular;
        $notaNueva->servicioPsicologo = $request->servicioPsicologo;
         //Guardar los precios en la bd
        $notaNueva ->save();
         
        //se llama la variable mensaje del blade
        return back()->with('mensaje', 'Guardado correctamente!');
    }
    

    public function editar($id){
     $nota = ServicioPsicologo::findOrFail($id);
        return view('editar', compact('nota'));
    }

    public function update(Request $request, $id){
    $notaUpdates = ServicioPsicologo::findOrFail($id);
    $notaUpdates->duracion = $request->duracion;
    $notaUpdates->estado_servicio = $request->estado_servicio;
    $notaUpdates->precio_particular = $request->precio_particular;
    $notaUpdates->servicioPsicologo = $request->servicioPsicologo;

    $notaUpdates->save();

    return back()->with('mensaje', 'nota actualizada');

 }
 public function eliminar($id){
     $notaEliminar = ServicioPsicologo::findOrFail($id);
     $notaEliminar->delete();
     return back()->with('mensaje', 'nota eliminada');
 }

 
}