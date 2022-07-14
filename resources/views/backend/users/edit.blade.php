@extends('layouts.app')
@section('content')
    <div class="container py-3">
        <div class="card mt-3">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div >
                        {{ !empty($users->name) ? $users->name : __('global.users.title') }}
                    </div>
                    <div >
                        <a href="{{ route('users.index') }}" class="btn btn-primary" title="Show All Users">
                            <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                        </a>
                        <a href="{{ route('users.create') }}" class="btn btn-success" title="Create New Users">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $users->id) }}" name="edit_users_form" accept-charset="UTF-8" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    @include ('backend.users.form', ['users' => $users, 'roles' => $roles])

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="{{__('global.update')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
