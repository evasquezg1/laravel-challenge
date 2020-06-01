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

      @if (count($errors) > 0)
        <div class="alert alert-danger">
         <button type="button" class="close" data-dismiss="alert">×</button>
         <ul>
          @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
          @endforeach
         </ul>
        </div>
       @endif
       @if ($message = Session::get('success'))
       <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
       </div>
       @endif

      <div class="col-md-6">
        <form action="{{ asset('/Evento/create') }}" method="post">
          @csrf
          <div class="fomr-group">
            <label>Titulo</label>
            <input type="text" class="form-control" name="titulo">
          </div>
          <div class="fomr-group">
            <label>Descripcion del Evento</label>
            <input type="text" class="form-control" name="descripcion">
          </div>
          <div class="form-group">
            <label>Color</label>
            <input type="color" name="color" class="form-control" value="#007bff" style="width:200px;">
          </div>
          <div class="fomr-group">
            <label>Fecha inicial</label>
            <input type="date" class="form-control" name="fecha">
          </div>
          <div class="fomr-group">
            <label>Fecha final</label>
            <input type="date" class="form-control" name="fecha_f">
          </div>
          <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
          <br>
          <input type="submit" class="btn btn-info" value="Guardar">
        </form>
      </div>


      <!-- inicio de semana -->


    </div> <!-- /container -->
@endsection