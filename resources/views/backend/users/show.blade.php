@extends('layouts.app')
@push('title', __('global.users.title'))
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <h3 class="profile-username text-center">{{ $users->name }}</h3>
                        <p class="text-muted text-center"><a href="mailto:{{ $users->email }}">{{ $users->email }}</a></p>
                        <hr>
                        <p><b>Created At:</b> {{ \Carbon\Carbon::parse($users->created_at)->diffForHumans() }}</p>
                        <p><b>Updated At:</b> {{ \Carbon\Carbon::parse($users->updated_at)->diffForHumans() }}</p>

                        <form method="POST" action="{!! route('users.destroy', $users->id) !!}" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            {{ csrf_field() }}
                            <div class="btn-group btn-block btn-group-sm" role="group">
                                <a href="{{ route('users.index') }}" class="btn btn-primary" title="Show All Users">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </a>

                                <a href="{{ route('users.create') }}" class="btn btn-success" title="Create New Users">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </a>

                                <a href="{{ route('users.edit', $users->id ) }}" class="btn btn-primary" title="Edit Users">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <button type="submit" class="btn btn-danger" title="Delete Users" onclick="return confirm(&quot;{{ __('global.confirm_delete') }}&quot;)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Blogs
                        <span class="badge badge-primary badge-pill">{{count($users->blog)}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pages
                        <span class="badge badge-primary badge-pill">{{count($users->page)}}</span>
                    </li>
                </ul>
            </div>

            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#blog" data-toggle="tab">Blogs</a></li>
                            <li class="nav-item"><a class="nav-link" href="#pages" data-toggle="tab">Pages</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="blog">
                                @if(count($users->blog) >= 1)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Published Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users->blog as $blog)
                                            <tr>
                                                <td>{{ $blog->title }}</td>

                                                <td>{{ \Carbon\Carbon::parse($blog->updated_at)->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                    <div class="alert alert-dismissible alert-warning">
                                        <h4 class="alert-heading text-center">No blogs associated with the user were found!</h4>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="pages">
                                @if(count($users->page) >= 1)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Published Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users->page as $page)
                                            <tr>
                                                <td>{{ $page->title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($page->updated_at)->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                    <div class="alert alert-dismissible alert-warning">
                                        <h4 class="alert-heading text-center">No pages associated with the user were found!</h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
