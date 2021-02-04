@extends('layouts.dashboard')
@section('contentSidebar')
  
<div class="row">
         
  <div class="col-md-1">
  </div>
            
  <div class="col-md-10">

    <h1>SERVICIO</h1>

    @if (session('mensaje'))
      <div class="alert alert-success">
        {{session('mensaje')}}
      </div>
    @endif

    <form action="{{ route('notas.crear')}}" method="POST">
    @csrf

    @error('duracion')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        El nombre es obligatorio
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button> 
      </div>
    @enderror

    @error('estado_servicio')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        El nombre es obligatorio
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button> 
      </div>
    @enderror

    @error('precio_particular')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        la descripcion es obligatorio
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button> </div>
    @enderror

    @error('servicioPsicologo')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        la descripcion es obligatorio
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button> 
      </div>
    @enderror

    <input type="text" name="Duracion" placeholder="duracion" class="form-control mb-2" value = "{{ old('nombre') }}">
    <input type="text" name="estado_servicio" placeholder="estado de servicio" class="form-control mb-2" value = "{{ old('nombre') }}">
    <input type="text" name="precio_particular" placeholder="precio particular" class="form-control mb-2" value = "{{ old('nombre') }}">
    <input type="text" name="Descripcion" placeholder="descripcion" class="form-control mb-2" value = "{{ old('nombre') }}">

    <select name="servicioPsicologo" class="form-control mb-2" value= "{{ old('nombre') }}">

    </select>
    <button class="btn btn-primary btn-block" type="submit ">Agregar</button>
    </form>

      <table class="table">
        <thead>
          <tr>
          <th scope="col">#id</th>
            <th scope="col">Duracion</th>
            <th scope="col">Estado</th>
            <th scope="col">Precio</th>
            <th scope="col">Servicio</th>
            <th scope="col">Descripcion</th>
            <th scope="col">ACCIONES</th>
          </tr>
        </thead>
        <tbody>

      @foreach ($notas as $item)

      <tr>
      <th scope="row">{{$item->id_servicio_psicologo}}</th>

      <td>{{$item-> duracion}}</td>
      @if ($item->Estado = 1)
      <td>{{"Habilitado"}}</td>
        @else
        <td>{{"No Habilitado"}}</td>
      @endif

      <td>${{$item->Precio}}</td>
      <td>{{$item->Servicio}}</td>
      <td>{{$item->Descripcion}}</td>

      <td><a href="{{ route('editarService', $item->id_servicio_psicologo)}}" class="btn btn-primary btn-sm">Editar</a>


<button class="btn btn-danger btn-sm" type="submit">Eliminar</button></form>
    </tr>

    @endforeach
    

  </tbody>
</table>
            </div>
            <div class="col-md-1">
            </div>
         


</div>
  
@endsection