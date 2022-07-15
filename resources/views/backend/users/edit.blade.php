@extends('layouts.app')
@section('content')
    <div class="container py-3">
        <div class="card mt-3">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div >
                        {{ $user->name }}
                    </div>
                    <div >
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm" title="Show All Users">
                            {{__('global.return_back')}}
                        </a>
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm" title="Create New Users">
                            {{__('global.create')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}" name="edit_users_form" accept-charset="UTF-8" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    @include ('backend.users.form', ['user' => $user, 'roles' => $roles])

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="{{__('global.update')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
