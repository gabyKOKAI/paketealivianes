@extends('_master')
	
	@section('title')
		Reportes
	@stop

	@section('content')
		<h1 id="registro"> Reporte </h1>
		{!!Form::open(array('url'=>'/reportes'))!!}
			{!!Form::label('usuario','Selecciona el Usuario:')!!}
            {!!Form::select('usuario', ['all'=>'Todos'] + $users, ['class' => 'form-control'])!!}
        	</br></br>
        	{!!Form::submit('Crear Reporte', ['class'=> 'btn btn-info form-control'])!!}
		{!!Form::close()!!}
            
	@stop

@stop