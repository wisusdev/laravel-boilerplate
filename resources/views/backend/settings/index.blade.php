@extends('layouts.app')
@section('content')
    <div class="container py-3">
        <form action="{{route('setting.store')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{__('global.general')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="site_logo" class="form-label">{{__('global.site_logo')}}</label>
                                <input class="form-control" type="file" id="site_logo" name="site_logo">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="google_analytics" class="form-label">{{__('global.google_analytics')}}</label>
                                <input id="google_analytics" type="text" class="form-control" name="google_analytics" value="{{ setting('google_analytics') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="site_description" class="form-label">{{__('global.description')}}</label>
                        <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ setting('site_description') }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">{{__('global.update')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <div class="modal fade" id="settingModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="settingTitleModal"></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="settingForm" name="settingForm" class="form-horizontal">

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