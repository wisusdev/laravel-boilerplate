@extends('layouts.app')
@section('content')
    <div class="container py-3">
        <form action="{{route('setting.store')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
            <div class="card card-primary">
                <div class="card-header">
                    <p class="fw-bold m-0">{{__('global.setting')}}</p>
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
                    <div class="float-end">
                        <button type="submit" class="btn btn-primary">{{__('global.update')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection