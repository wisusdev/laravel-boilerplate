@extends('layouts.app')
@section('content')
	<div class="container py-5">
		<div class="card">
			<div class="card/body">
				<table class="table table-bordered">
					<tbody>
						@foreach($keys as $id => $key)
							<tr id="{{$id}}">
								<td>{{$id}}</td>
								<th>{{$key['value']}}</th>
								<td><a href="javascript:void(0)" id="editEnv" data-id="{{ $id }}" class="btn btn-info">Editar</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="postCrudModal"></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="envForm" name="envForm" class="form-horizontal">

						<div class="mb-3">
							<label for="name" class="control-label">Llave</label>
							<input type="text" class="form-control" id="key" name="key" value="" required="">
						</div>

						<div class="mb-3">
							<label class="control-label">Valor</label>
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