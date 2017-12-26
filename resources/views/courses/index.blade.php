@extends('layouts.main')

@section('page-title')
    Courses | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li class="active">Courses</li>
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
            <div class="col-md-12 col-sm-12">
                <div class="panel panel-default">
                    <form class="form-horizontal" action="{{ route('courses.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <h3>New Course</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group @if ($errors->has('code')) has-error @endif">
                                        <label class="col-md-3 control-label">* Code</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" name="code" value="{{ old('code') }}"/>
                                            </div>
                                            <span class="help-block">
                                                @if ($errors->has('code'))
                                                    {{ $errors->first('code') }}
                                                @else
                                                    Course Code
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('description')) has-error @endif">
                                        <label class="col-md-3 control-label">* Description</label>
                                        <div class="col-md-9 col-xs-12">
                                            <textarea class="form-control" rows="5" name="description">{{ old('description') }}</textarea>
                                            <span class="help-block">
                                                @if ($errors->has('description'))
                                                    {{ $errors->first('description') }}
                                                @else
                                                    Detailed Description of the Course
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">* Duration</label>
                                        <div class="col-md-9">
                                            <input type="number" min="1" class="form-control" name="duration" value="{{ old('duration') ?: 1 }}"/>
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
                                                <option @if (old('category') == 'Deck') selected @endif>Deck</option>
                                                <option @if (old('category') == 'Engine') selected @endif>Engine</option>
                                                <option @if (old('category') == 'Common') selected @endif>Common</option>
                                            </select>
                                            <span class="help-block">Select category</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Branch</label>
                                        <div class="col-md-9">
                                            <select class="form-control select" name="branch_id">
                                                @foreach ($branches as $key => $branch)
                                                    <option value="{{ $branch->id }}" @if (old('branch_id') == $branch->id) selected @endif>{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block">Select branch</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary pull-right" type="submit">Submit</button>
                        </div>
                    </form>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">All Courses</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <p>Displays all courses for all 5 branches</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed table-bordered" id="table-courses">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th style="text-align: center">Duration</th>
                                        <th>Branch</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $key => $course)
                                        <tr>
                                            <td>{{ $course->code }}</td>
                                            <td>{{ $course->description }}</td>
                                            <td>{{ $course->category }}</td>
                                            <td align="center">{{ $course->duration }}</td>
                                            <td>{{ $course->branch->name }}</td>
                                            <td align="center">
                                                <a class="btn btn-primary btn-rounded btn-condensed btn-sm" href="{{ route('courses.edit', $course->id) }}"><span class="fa fa-pencil"></span></a>
                                                <button class="btn btn-danger btn-rounded btn-condensed btn-sm" onclick="delete_course({{ $course->id }});"><span class="fa fa-times"></span>
                                            </td>
                                            <form method="POST" action="{{ route('courses.destroy', $course->id) }}" accept-charset="UTF-8" id="formDelete{{ $course->id }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- DELETE ITEM MESSAGE BOX -->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete-course">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Course</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to remove this Course?</p>
                    <p>Press Yes to remove course.</p>
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
    <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-select.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#table-courses').dataTable({
                "iDisplayLength": 500,
                "bLengthChange": false,
                "order": [[ 0, "asc" ]],
                "columns": [
                    null,
                    null,
                    null,
                    null,
                    { "width": "200px" },
                    { "width": "150px" },
                  ]
            });
        });
        function delete_course(row) {

            var box = $("#mb-delete-course");
            box.addClass("open");

            box.find(".mb-control-yes").on("click",
                function(){
                    box.removeClass("open");
                    document.getElementById('formDelete' + row).submit();
                }
            );
        }
    </script>
@endsection
