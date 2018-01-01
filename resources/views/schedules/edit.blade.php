@extends('layouts.main')

@section('page-title')
    Schedules | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li><a href="{{ route('schedules.index') }}">Schedules</a></li>
        <li class="active">{{ $schedule->course_name }}</li>
    </ul>
@endsection

@section('page-content-title')
    <div class="page-title">
        <h2><span class="fa fa-calendar"></span> Schedules</h2>
    </div>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>{{ $schedule->branch->name }}</strong> - {{ $schedule->course_name }}</h3>
                        <ul class="panel-controls">
                            <li><button type="button" class="btn btn-danger btn-rounded" onclick="delete_schedule()"><span class="fa fa-times"></span>Remove Schedule</button></li>
                            <form method="POST" action="{{ route('schedules.destroy', $schedule->id) }}" accept-charset="UTF-8" id="formDelete">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </div>
                    <form class="form-horizontal" action="{{ route('schedules.update', $schedule->id) }}" method="post">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <div class="panel-body">

                                <div class="form-group @if ($errors->has('course_name')) has-error @endif">
                                    <label class="col-md-3 control-label">* Course Name</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="course_name" value="{{ old('course_name') ?: $schedule->course_name }}"/>
                                        </div>
                                        <span class="help-block">
                                            @if ($errors->has('course_name'))
                                                {{ $errors->first('course_name') }}
                                            @else
                                                Course name or code
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('start_date') || $errors->has('end_date')) has-error @endif">
                                    <label class="col-md-3 control-label">* Course Schedule</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input id="startDate" type="text" class="form-control" name="start_date" value="{{ old('start_date') ?: \Carbon\Carbon::createFromFormat('Y-m-d', $schedule->start_date)->format('m/d/Y') }}"/>
                                            <span class="input-group-addon add-on"> - </span>
                                            <input id="endDate" type="text" class="form-control" name="end_date" value="{{ old('end_date') ?: \Carbon\Carbon::createFromFormat('Y-m-d', $schedule->end_date)->format('m/d/Y') }}"/>
                                        </div>
                                        <span class="help-block">
                                            @if ($errors->has('start_date'))
                                                {{ $errors->first('start_date') }}
                                            @elseif ($errors->has('end_date'))
                                                {{ $errors->first('end_date') }}
                                            @else
                                                Select course period
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('start_time') || $errors->has('end_time')) has-error @endif">
                                    <label class="col-md-3 control-label">* Class Start</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" name="start_time" value="{{ old('start_time') ?: \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('g:i A') }}"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block">
                                            @if ($errors->has('start_time'))
                                                {{ $errors->first('start_time') }}
                                            @else
                                                Select course period
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" name="end_time" value="{{ old('start_time') ?: \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('g:i A') }}"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block">
                                            @if ($errors->has('end_time'))
                                                {{ $errors->first('end_time') }}
                                            @else
                                                Select course period
                                            @endif
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="panel-footer">
                            Created on <strong>{{ $schedule->created_at->toDayDateTimeString() }}</strong> by <strong>{{ $schedule->createdBy->name }}</strong>
                            <button class="btn btn-danger pull-right" type="submit">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

    <!-- DELETE ITEM MESSAGE BOX -->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete-schedule">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Schedule</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to remove this Schedule?</p>
                    <p>Press Yes to remove schedule.</p>
                </div>
                <div class="mb-footer">
    				<div class="pull-right">
    					<button class="btn btn-success btn-lg mb-control-yes">Yes</button>
    					<button class="btn btn-default btn-lg mb-control-close">No</button>
    				</div>
			    </div>
            </div>
        </div>
    </div>
    <!-- DELETE ITEM END MESSAGE BOX-->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-timepicker.min.js') }}"></script>
    <script>
        $('#startDate').datepicker();
        $('#endDate').datepicker();

        function delete_schedule() {

            var box = $("#mb-delete-schedule");
            box.addClass("open");

            box.find(".mb-control-yes").on("click",
                function(){
                    box.removeClass("open");
                    document.getElementById('formDelete').submit();
                }
            );
        }
    </script>
@endsection
