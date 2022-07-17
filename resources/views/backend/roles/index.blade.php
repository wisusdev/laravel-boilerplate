@extends('layouts.app')
@section('content')
    <div class="container py-3">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                   <p class="fw-bold m-0">{{__('global.roles')}}</p>
                </div>
                <div>
                    @can('role.create')
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{__('global.name')}}</th>
                            <th>{{__('global.permissions')}}</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($roles) > 0)
                            @foreach ($roles as $role)
                                <tr data-entry-id="{{ $role->id }}">
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->permissions()->pluck('name') as $permission)
                                            <span class="badge bg-secondary">{{ $permission }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('role.edit')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-primary btn-sm">{{__('global.edit')}}</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('role.delete')
                                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="{{__('global.delete')}}" onclick="return confirm(&quot;{{ __('global.confirm_delete') }}&quot;)">
                                                {{__('global.delete')}}
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@stop
