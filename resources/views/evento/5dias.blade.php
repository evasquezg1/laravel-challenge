
@extends('layouts.app')

@section('content')
    <script src="{{asset('plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>

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
      background: #17a2b8;color:white;
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
      <a href="{{asset('Evento/form')}}" class="btn btn-info"><i class="fas fa-plus"></i> Crear evento</a><br><br>
      <a href="{{asset('Evento/dia')}}" class="btn btn-outline-primary btn-sm">Eventos del día</a>&nbsp;&nbsp;<a href="{{asset('Evento/5dias')}}" class="btn btn-outline-primary btn-sm">Próximos 5 días</a>&nbsp;&nbsp;<a href="{{asset('Evento/todos')}}" class="btn btn-outline-primary btn-sm">Todos los eventos</a>
      <hr>

      <h3>{{$dia}} / {{$Fdias}}</h3>

      <table class="display table table-striped table-bordered table-hover dataTable no-footer" id="datatable">
      	<tr>
      		<th>Titulo</th>
      		<th>Descripción</th>
      		<th>Fecha inicial</th>
      		<th>Fecha final</th>
      	</tr>
      	@foreach($eventos as $evento)
      		<tr>
      			<td>{{$evento->titulo}}</td>
      			<td>{{$evento->descripcion}}</td>
      			<td>{{$evento->fecha_i}}</td>
      			<td>{{$evento->fecha_f}}</td>
      		</tr>
      	@endforeach
      </table>

    </div> <!-- /container -->

    <script type="text/javascript">
    	$('#datatable').DataTable({
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ]
        });
    </script>
@endsection