
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
      <div class="col-md-6">
        <form action="{{ asset('/Evento/create/') }}" method="post">
          <div class="fomr-group">
            <h4>Titulo</h4>
            {{ $event->titulo }}
          </div>
          <div class="fomr-group">
            <h4>Descripcion del Evento</h4>
            {{ $event->descripcion }}
          </div>
          <div class="fomr-group">
            <h4>Fecha inicial</h4>
            {{ $event->fecha_i }}
          </div>
          <div class="fomr-group">
            <h4>Fecha final</h4>
            {{ $event->fecha_f }}
          </div>
          <br>
          <input type="submit" class="btn btn-info" value="Guardar">
        </form>
      </div>


      <!-- inicio de semana -->


    </div> <!-- /container -->
@endsection