@extends('layouts.main')

@section('page-title')
    Courses | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li><a href="{{ route('courses.index') }}">Courses</a></li>
        <li class="active">{{ $course->code }}</li>
    </ul>
@endsection

@section('page-content-title')
    <div class="page-title">
        <h2><span class="fa fa-th-list"></span> Courses</h2>
    </div>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <form class="form-horizontal" action="{{ route('courses.update', $course->id) }}" method="post">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>{{ $course->code }}</strong> - {{ $course->description }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group @if ($errors->has('code')) has-error @endif">
                                            <label class="col-md-3 control-label">* Code</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" class="form-control" name="code" value="{{ old('code') ?: $course->code }}"/>
                                                </div>
                                                <span class="help-block">
                                                    @if ($errors->has('code'))
                                                        {{ $errors->first('code') }}
                                                    @else
                                                        New Course Code
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                                            <label class="col-md-3 control-label">* Description</label>
                                            <div class="col-md-9 col-xs-12">
                                                <textarea class="form-control" rows="5" name="description">{{ old('description') ?: $course->description }}</textarea>
                                                <span class="help-block">
                                                    @if ($errors->has('description'))
                                                        {{ $errors->first('description') }}
                                                    @else
                                                        New Detailed Description of the Course
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">* Duration</label>
                                            <div class="col-md-9">
                                                <input type="number" min="1" class="form-control" name="duration" value="{{ old('duration') ?: $course->duration }}"/>
                                                <span class="help-block">
                                                    @if ($errors->has('duration'))
                                                        {{ $errors->first('duration') }}
                                                    @else
                                                        Enter number of days
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Category</label>
                                            <div class="col-md-9">
                                                <select class="form-control select" name="category">
                                                    <option @if (old('category') == 'Deck') selected @elseif ($course->category == 'Deck') selected @endif>Deck</option>
                                                    <option @if (old('category') == 'Engine') selected @elseif ($course->category == 'Engine') selected @endif>Engine</option>
                                                    <option @if (old('category') == 'Common') selected @elseif ($course->category == 'Common') selected @endif>Common</option>
                                                </select>
                                                <span class="help-block">Select category</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Branch</label>
                                            <div class="col-md-9">
                                                <select class="form-control select" name="branch_id">
                                                    @foreach ($branches as $key => $branch)
                                                        <option value="{{ $branch->id }}" @if (old('branch_id') == $branch->id) selected @elseif ($course->branch_id == $branch->id) selected @endif>{{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="help-block">Select branch</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            Created on <strong>{{ $course->created_at->toDayDateTimeString() }}</strong> by <strong>{{ $course->createdBy->name }}</strong>
                            <button class="btn btn-primary pull-right" type="submit">Update</button>
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
