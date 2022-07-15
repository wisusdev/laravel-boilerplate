@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="card">

            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div >
                        {{__('global.title')}}
                    </div>
                    <div class="float-end">
                        @can('users.create')
                            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm" title="{{__('global.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{__('global.name')}}</th>
                                <th>{{__('global.email')}}</th>
                                <th>{{__('global.email_verified_at')}}</th>
                                <th>{{__('global.update_at')}}</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->email_verified_at}}</td>
                                    <td>{{$user->email_verified_at}}</td>
                                    <td>{{$user->update_at}}</td>
                                    <td>
                                        @can('users.edit')
                                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm">{{__('global.edit')}}</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('users.delete')    
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" accept-charset="UTF-8">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" title="{{__('global.delete')}}" onclick="return confirm(&quot;{{ __('global.confirm_delete') }}&quot;)">
                                                    {{__('global.delete')}}
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer pb-0">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
