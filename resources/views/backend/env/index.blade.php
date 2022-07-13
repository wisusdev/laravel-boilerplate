@extends('layouts.app')
@section('content')
	<div class="container py-3">
		<div class="alert alert-warning" role="alert">
			<p class="my-0"><i class="bi bi-exclamation-triangle"></i> ¡Cuidado!, antes de modificar algún valor, asegurate de saber lo que estas haciendo.</p>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table">
					<tbody>
						@foreach($keys as $id => $key)
							<tr id="{{$id}}">
								<td>{{$id}}</td>
								<th>{{$key['value']}}</th>
								<td><a href="javascript:void(0)" id="editEnv" data-id="{{ $id }}" class="btn btn-primary btn-sm">Editar</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade" id="envModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="envTitleModal"></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="envForm" name="envForm" class="form-horizontal">

						<div class="mb-3">
							<label for="name" class="form-label">Llave</label>
							<input type="text" class="form-control" id="key" name="key" value="" required="" readonly>
						</div>

						<div class="mb-3">
							<label class="form-label">Valor</label>
							<input class="form-control" id="value" name="value" value="" required="">
						</div>

						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary" id="btnSave" value="create">Actualizar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection