@extends('layouts.main')

@section('page-title')
    User Management | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li><a href="{{ route('users.index') }}">User Management</a></li>
        <li class="active">New User</li>
    </ul>
@endsection

@section('page-content-title')
    <div class="page-title">
        <h2><span class="fa fa-users"></span> User Management</h2>
    </div>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">New User</h3>
                    </div>
                    <form class="form-horizontal" action="{{ route('users.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Branch</label>
                                <div class="col-md-6">
                                    <select class="form-control select" name="branch_id">
                                        @foreach ($branches as $key => $branch)
                                            <option value="{{ $branch->id }}" @if (old('branch_id') == $branch->id) selected @endif>{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">Select branch</span>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <label class="col-md-3 control-label">* Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Juan Dela Cruz"/>
                                    <span class="help-block">
                                        @if ($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @else
                                            Full Name
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                <label class="col-md-3 control-label">* Email</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="test@example.com"/>
                                    </div>
                                    <span class="help-block">
                                        @if ($errors->has('email'))
                                            {{ $errors->first('email') }}
                                        @else
                                            Enter a valid email address
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('username')) has-error @endif">
                                <label class="col-md-3 control-label">* Username</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="john.doe"/>
                                    </div>
                                    <span class="help-block">
                                        @if ($errors->has('username'))
                                            {{ $errors->first('username') }}
                                        @else
                                            Enter a username
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                <label class="col-md-3 control-label">* Password</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                        <input type="password" class="form-control" name="password"/>
                                    </div>
                                    <span class="help-block">
                                        @if ($errors->has('password'))
                                            {{ $errors->first('password') }}
                                        @else
                                            Min: 6 characters
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('confirm_password')) has-error @endif">
                                <label class="col-md-3 control-label">* Confirm Password</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                        <input type="password" class="form-control" name="confirm_password"/>
                                    </div>
                                    <span class="help-block">
                                        @if ($errors->has('confirm_password'))
                                            {{ $errors->first('confirm_password') }}
                                        @else
                                            Min: 6 characters
                                        @endif
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="panel-footer">
                            <button class="btn btn-danger pull-right" type="submit">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-select.js') }}"></script>
@endsection
