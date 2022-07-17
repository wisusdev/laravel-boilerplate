@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        {{__('global.permissions')}}
                    </div>
                    <div>
                        @can('permission.create')
                        <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-10">{{__('global.name')}}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                            <tr data-entry-id="{{ $key }}">
                                <td>{{ $permission }}</td>
                                <td>
                                    @can('permission.edit')
                                    <a href="{{ route('permissions.edit', $key) }}" class="btn btn-primary btn-sm">{{__('global.edit')}}</a>
                                    @endcan
                                </td>
                                <td>
                                    @can('permission.delete')
                                    <form method="POST" action="{{ route('permissions.destroy', $key) }}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group-xs" role="group">
                                            <button type="submit" class="btn btn-danger btn-sm" title="{{__('global.delete')}}">
                                                {{__('global.delete')}}
                                            </button>
                                        </div>
                                    </form>
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
