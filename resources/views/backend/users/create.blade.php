@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-end">
                    <div>
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm" title="{{__('global.return_back')}}">
                            <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8" id="create_users_form" name="create_users_form" class="form-horizontal">
                    @csrf
                    @include ('backend.users.form', ['user' => null, 'roles' => $roles])

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="{{__('global.add')}}">
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection


