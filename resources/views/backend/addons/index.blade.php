@extends('layouts.app')
@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="float-left">
                        {{__('global.addons')}}
                    </div>
                    <div class="float-right">
                        <form method='post' class="form-inline" action="{{route('addons.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group d-flex justify-content-end">
                                <label for="file">
                                    <span class="btn btn-outline-primary"> <i class="bi bi-plus"></i> <span id="file_count"></span></span>
                                </label>
                                <input type="file" id="file" name="addon" hidden accept='application/zip' required>
                                <button type="submit" id="sendFile" class="btn btn-primary ms-2" disabled><i class="bi bi-upload"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="addonsLoop">
                    @foreach($modules as $module)
                        <div class="col-md-4 mb-3" id="addon-{{ $module->get('alias') }}">
                            <div class="card">
                                <div class="card-body">
                                    <p class="fs-2"><b>{{ $module->get('name') }}</b></p>
                                    <p>{{ $module->get('description') }}</p>
                                    <p><span class="fw-bold">Version</span> {{ $module->get('version') }}</p>
                                    <p><span class="fw-bold">By</span> {{ $module->get('author') }}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <form action="{{route('addons.active')}}" method="POST">
                                                @csrf
                                                <input type="text" hidden name="addons_name" value="{{ $module->get('name') }}">
                                                <button type="submit" class="btn btn-{{ $module->isEnabled() ? 'success' : 'secondary' }} btn-sm">{{ $module->isEnabled() ? __('global.active') : __('global.inactive') }}</button>
                                            </form>
                                        </div>
                                        <div class="addonFooter">
                                            <div>
                                                @if($module->isEnabled())
                                                    <a href="{{ $module->get('alias') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-gear-wide-connected"></i></a>
                                                @else
                                                    <button type="button" class="btn btn-primary btn-sm" disabled><i class="bi bi-gear-wide-connected"></i></button>
                                                @endif

                                                <a class="btn btn-outline-primary btn-sm" href="{{ route('addons.download', $module->get('name')) }}" title="{{ __('global.download') }}">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                                    <button type="button" class="btn btn-outline-danger btn-sm deleteAddon" data-id="{{ $module->get('alias') }}">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                @can('addons.migrate')
                <div class="float-end">
                    <form action="{{ route('addons.migrate', $module->get('name')) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning"><i class="bi bi-terminal-fill"></i> Migrar</button>
                    </form>
                </div>
                @endcan
            </div>
        </div>
    </div>
@stop
