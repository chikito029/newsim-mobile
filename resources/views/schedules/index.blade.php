@extends('layouts.main')

@section('page-title')
    Schedules | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li class="active">Schedules</li>
    </ul>
@endsection

@section('page-content-wrapper')
    <!-- START CONTENT FRAME -->
    <div class="content-frame">
        <!-- START CONTENT FRAME TOP -->
        <div class="content-frame-top">
            <div class="page-title">
                <h2><span class="fa fa-calendar"></span> Schedules</h2>
            </div>
            <div class="pull-right">
                <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
            </div>
        </div>
        <!-- END CONTENT FRAME TOP -->

        <!-- START CONTENT FRAME LEFT -->
        <div class="content-frame-left">
            <h4>New Schedule</h4>

            <form class="form-horizontal" action="{{ route('schedules.store') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group @if ($errors->has('course_name')) has-error @endif">
                    <input type="text" class="form-control" name="course_name" value="{{ old('course_name') }}" placeholder="Course name or code"/>
                    <span class="help-block">
                        @if ($errors->has('course_name'))
                            {{ $errors->first('course_name') }}
                        @endif
                    </span>
                </div>

                <div class="form-group @if ($errors->has('start_date') || $errors->has('end_date')) has-error @endif">
                    <div class="input-group">
                        <input id="startDate" type="text" class="form-control" name="start_date" value="{{ old('start_date') ?: \Carbon\Carbon::now()->format('m/d/Y') }}"/>
                        <span class="input-group-addon add-on"> - </span>
                        <input id="endDate" type="text" class="form-control" name="end_date" value="{{ old('end_date') ?: \Carbon\Carbon::now()->format('m/d/Y') }}"/>
                    </div>
                    <span class="help-block">
                        @if ($errors->has('start_date'))
                            {{ $errors->first('start_date') }}
                        @elseif ($errors->has('end_date'))
                            {{ $errors->first('end_date') }}
                        @endif
                    </span>
                </div>

                <div class="form-group @if ($errors->has('start_time')) has-error @endif">
                    <div class="input-group">
                        <input type="text" class="form-control timepicker" name="start_time" value="{{ old('start_time') ?: '8:00 AM' }}"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                    </div>
                    <span class="help-block">
                        @if ($errors->has('start_time'))
                            {{ $errors->first('start_time') }}
                        @endif
                    </span>
                </div>
                <div class="form-group @if ($errors->has('end_time')) has-error @endif">
                    <div class="input-group">
                        <input type="text" class="form-control timepicker" name="end_time" value="{{ old('start_time') ?: '8:00 AM' }}"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                    </div>
                    <span class="help-block">
                        @if ($errors->has('end_time'))
                            {{ $errors->first('end_time') }}
                        @endif
                    </span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-danger btn-block">Submit</button>
                </div>

            </form>

        </div>
        <!-- END CONTENT FRAME LEFT -->

        <!-- START CONTENT FRAME BODY -->
        <div class="content-frame-body padding-bottom-0">

            <div class="row">
                <div class="col-md-12">
                    <div id="alert_holder"></div>
                    <div class="calendar">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END CONTENT FRAME BODY -->

    </div>
    <!-- END CONTENT FRAME -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-timepicker.min.js') }}"></script>
    <script>

        $('#startDate').datepicker();
        $('#endDate').datepicker();

        var fullCalendar = function(){

            var calendar = function(){

                if($("#calendar").length > 0){

                    function prepare_external_list(){

                        $('#external-events .external-event').each(function() {
                                var eventObject = {title: $.trim($(this).text())};

                                $(this).data('eventObject', eventObject);
                                $(this).draggable({
                                        zIndex: 999,
                                        revert: true,
                                        revertDuration: 0
                                });
                        });

                    }

                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();

                    prepare_external_list();

                    var calendar = $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        editable: false,
                        eventSources: {url: "/api/schedules/calendar"},
                        droppable: true,
                        selectable: false,
                        selectHelper: true,
                        select: function(start, end, allDay) {
                            var title = prompt('Event Title:');
                            if (title) {
                                calendar.fullCalendar('renderEvent',
                                {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                },
                                true
                                );
                            }
                            calendar.fullCalendar('unselect');
                        },
                        drop: function(date, allDay) {

                            var originalEventObject = $(this).data('eventObject');

                            var copiedEventObject = $.extend({}, originalEventObject);

                            copiedEventObject.start = date;
                            copiedEventObject.allDay = allDay;

                            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);


                            if ($('#drop-remove').is(':checked')) {
                                $(this).remove();
                            }

                        },
                        eventClick: function(calEvent, jsEvent, view) {
                            document.location = "{{ route('schedules.index') }}/" + calEvent.id + "/edit";
                        }
                    });

                    $("#new-event").on("click",function(){
                        var et = $("#new-event-text").val();
                        if(et != ''){
                            $("#external-events").prepend('<a class="list-group-item external-event">'+et+'</a>');
                            prepare_external_list();
                        }
                    });

                }
            }

            return {
                init: function(){
                    calendar();
                }
            }
        }();

        fullCalendar.init();
    </script>
@endsection
