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
                        <a href="{{ route('users.create') }}" class="btn btn-success" title="{{__('global.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                    </div>
                </div>
            </div>

            <div class="card-body ">
                <table class="table table-striped data-table-users">
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
                                <td><a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm">Editar</a></td>
                                <td><a href="" class="btn btn-danger btn-sm">Borrar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer pb-0">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
