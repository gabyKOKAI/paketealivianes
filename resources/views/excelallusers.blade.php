@foreach ($users as $user)
	<?php $first_reg= $user->register()->first()?>
		@if ($first_reg)
			<?php $date1= $first_reg->date ?>
			<?php $hour1= $first_reg->time ?>
			<h3> {{$user->name}} {{$user->last_name}}</h3>
			<div class="table-responsive">
				<table class="table table-hover">
					<?php $flag=1; ?>
					<thead>
						<tr>
							<th>Fecha </th>
							<th>Hora </th>
							<th>Tipo de registro </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($user->register as $register)
							<tr>
								@if ($register->date == $date1 && $flag!= 1)
									<td> </td>
								@else
									<td>{{$register->date}}</td>
									<?php $date1= $register->date ?>
									<?php $flag=0; ?>
								@endif
								<td>{{$register->time}}</td>
						
								@if ($register->type == "other_entry")
									<td>Entrada: en otro lugar</td>
								@endif
								@if ($register->type == "other_exit")
									<td>Salida: en otro lugar</td>
								@endif
								@if ($register->type == "error en direccion")
									<td>No leyo dirección</td>
								@endif
								@if ($register->type == "entry")
									<td>Entrada</td>
								@endif
								@if ($register->type == "exit")
									<td>Salida</td>
								@endif
															
							</tr>
						@endforeach
					</tbody>
					</table>
		@endif
		@endforeach
			
			
			