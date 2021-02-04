@extends('layouts.dashboard')
@section('contentSidebar')
<h1>Detalle de nota</h1>
<h4>id: {{ $notas->id_servicio_psicologo}}</h4>
<h4>Nombre: {{ $nota->duracion }}</h4>
<h4>Detalle: {{ $nota->estado_servicio }}</h4>
<h4>Detalle: {{ $nota->precio_particular }}</h4>
<h4>Detalle: {{ $nota->servicioPsicologo }}</h4>


@endsection