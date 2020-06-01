
@extends('layouts.app')

@section('content')
<style>
    body{
      font-family: 'Nunito', sans-serif;
    }
    .header-col{
      background: #E3E9E5;
      color:#536170;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }
    .header-calendar{
      background: #EE192D;color:white;
    }
    .box-day{
      border:1px solid #E3E9E5;
      height:150px;
    }
    .box-dayoff{
      border:1px solid #E3E9E5;
      height:150px;
      background-color: #ccd1ce;
    }
    </style>

    <div class="container">
      <div class="card mb-3" style="max-width: 18rem;border-color: {{$event->color}}">
        <div class="card-header">
          <b>Fecha inicial: {{$event->fecha_i}}</b><br>
          <b>Fecha final: {{$event->fecha_f}}</b><br>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{$event->titulo}}</h5>
          <p class="card-text">{{$event->descripcion}}</p>
        </div>
      </div>

      <a href="#" data-toggle="modal" data-target="#editarEvento" class="btn btn-info" title="Editar"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#enviarInvitacion" class="btn btn-success" title="Invitar"><i class="fas fa-envelope"></i></a>

    </div> <!-- /container -->

    <div class="modal fade" id="editarEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form action="{{ asset('/Evento/edit') }}" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar evento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
              <div class="fomr-group">
                <label>Titulo</label>
                <input type="text" class="form-control" name="titulo" value="{{$event->titulo}}">
              </div>
              <div class="fomr-group">
                <label>Descripcion del Evento</label>
                <input type="text" class="form-control" name="descripcion" value="{{$event->descripcion}}">
              </div>
              <div class="form-group">
                <label>Color</label>
                <input type="color" name="color" class="form-control" value="{{$event->color}}" style="width:200px;">
              </div>
              <div class="fomr-group">
                <label>Fecha inicial</label>
                <input type="date" class="form-control" name="fecha" value="{{$event->fecha_i}}">
              </div>
              <div class="fomr-group">
                <label>Fecha final</label>
                <input type="date" class="form-control" name="fecha_f" value="{{$event->fecha_f}}">
              </div>
              <input type="hidden" name="id_evento" value="{{ $event->id }}">
              <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
        </form>
      </div>
    </div>

        <div class="modal fade" id="enviarInvitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form action="{{ asset('/send-mail') }}" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enviar invitación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
              <input type="hidden" class="form-control" name="titulo" value="{{$event->titulo}}">
              <input type="hidden" class="form-control" name="descripcion" value="{{$event->descripcion}}">
              <input type="hidden" class="form-control" name="fecha" value="{{$event->fecha_i}}">
              <input type="hidden" class="form-control" name="fecha_f" value="{{$event->fecha_f}}">
              <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="email" class="form-control">
              </div>
              <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Enviar</button>
          </div>
        </div>
        </form>
      </div>
    </div>

@endsection