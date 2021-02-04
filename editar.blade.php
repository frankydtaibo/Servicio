@extends('layouts.dashboard')
@section('contentSidebar')
<h1>Editar nota {{ $nota->id_servicio_psicologo }}</h1>
@if (session('mensaje'))
<div class="alert alert-success">
{{session('mensaje')}}</div>
@endif
<form action="{{ route('notas.updates', $nota->id_servicio_psicologo)}}" method="POST">
@method('PUT')
@csrf

@error('nombre')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
El nombre es obligatorio
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button> </div>
@enderror

@error('descripcion')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
la descripcion es obligatorio
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button> </div>
@enderror

    <input type="text" name="duracion" placeholder="duracion" class="form-control mb-2" value ="{{ $nota->duracion }}">
    <input type="text" name="estado_servicio" placeholder="estado_servicio" class="form-control mb-2" value ="{{ $nota->estado_servicio }}">
    <input type="text" name="precio_particular" placeholder="precio_particular" class="form-control mb-2" value ="{{ $nota->precio_particular }}">
    <input type="text" name="servicioPsicologo" placeholder="servicioPsicologo" class="form-control mb-2" value ="{{ $nota->servicioPsicologo }}">

<button class="btn btn-dark btn-block" type="submit ">Guardar</button>
</form>

@endsection