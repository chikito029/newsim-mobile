@extends('layouts.main')

@section('page-title')
    Promos | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li><a href="{{ route('promos.index') }}">Promos</a></li>
        <li><a href="#">{{ $promo->title }}</a></li>
        <li class="active">Edit</li>
    </ul>
@endsection

@section('page-content-title')
    <div class="page-title">
        <h2><span class="fa fa-tags"></span> Promos</h2>
    </div>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">New Promo</h3>
                    </div>
                    <form class="form-horizontal" action="{{ route('promos.update', $promo->id) }}" enctype="multipart/form-data" method="post">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="panel-body">
                            <p>Note: If you submit the form and fails you have to re-enter all courses again.</p>
                        </div>
                        <div class="panel-body" id="form-body">

                            <div class="form-group @if ($errors->has('title')) has-error @endif">
                                <label class="col-md-3 col-xs-12 control-label">* Title</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" class="form-control" name="title" value="{{ old('title') ?: $promo->title }}"/>
                                    </div>
                                    <span class="help-block">
                                        @if ($errors->has('title'))
                                            {{ $errors->first('title') }}
                                        @else
                                            Promo Title
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('body')) has-error @endif">
                                <label class="col-md-3 col-xs-12 control-label">* Body</label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" rows="5" name="body">{{ old('body') ?: $promo->body }}</textarea>
                                    <span class="help-block">
                                        @if ($errors->has('body'))
                                            {{ $errors->first('body') }}
                                        @else
                                            Enter the mechanics of the promo and other details.
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Cover Period</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <input id="startDate" type="text" class="form-control" name="start_date" value="{{ old('start_date') ?: \Carbon\Carbon::createFromFormat('Y-m-d', $promo->start_date)->format('m/d/Y') }}"/>
                                        <span class="input-group-addon add-on"> - </span>
                                        <input id="endDate" type="text" class="form-control" name="end_date" value="{{ old('end_date') ?: \Carbon\Carbon::createFromFormat('Y-m-d', $promo->end_date)->format('m/d/Y') }}"/>
                                    </div>
                                    <span class="help-block">Dates when the promo will take effect</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Promo Banner</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="file" id="fileSimple" name="promo_banner" accept="image/*"/>
                                    <span class="help-block">Upload a promo banner</span>
                                </div>
                            </div>

                            @foreach ($promo->promoCourses as $key => $promoCourse)
                                <div id="courseRow-{{ $key+1 }}" class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Course</label>
                                    <div class="col-md-3 col-xs-12">
                                        <input class="form-control" type="text" name="course_names[]" placeholder="Course code or name" value="{{ $promoCourse->name }}">
                                    </div>
                                    <div class="col-md-2 col-xs-12">
                                        <input class="form-control" name="course_prices[]" style="text-align: right" placeholder="Discounted price or %" value="{{ $promoCourse->price }}">
                                    </div>
                                    <div id="courseRowButtons-{{ $key+1 }}" class="col-md-1 col-xs-12">
                                        @if ($promo->promoCourses->count() == $key+1)
                                            <button id="btnAddCourse-{{ $key+1 }}" type="button" class="btn btn-success btn-block" name="button" onclick="addCourseField({{ $key+1 }})">Add</button>
                                        @else
                                            <button id="btnRemoveCourse-{{ $key+1 }}" type="button" class="btn btn-danger btn-block" name="button" onclick="removeCourseField({{ $key+1 }})">Remove</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-danger pull-right">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-file-input.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-select.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/fileinput/fileinput.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('#startDate').datepicker();
            $('#endDate').datepicker();
            $("#fileSimple").fileinput({
                showUpload: false,
                showCaption: true,
                uploadUrl: "#",
                browseClass: "btn btn-primary",
                browseLabel: "Browse Document",
                allowedFileExtensions : ['.jpg']
            });

            // addCourseField(null);
        });

        var courseFieldCount = {{ $promo->promoCourses->count() }};

        function addCourseField(id) {
            courseFieldCount += 1;

            if (id != null) {
                // Replace the Add button with Remove button
                var btnRemoveCourse = `<button id="btnRemoveCourse-` + id + `" type="button" class="btn btn-danger btn-block" name="button" onclick="removeCourseField(` + id + `)">Remove</button>`;
                $('#btnAddCourse-' + id).remove();
                $('#courseRowButtons-' + id).append(btnRemoveCourse);
            }

            var courseField = `
                <div id="courseRow-` + courseFieldCount + `" class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Course</label>
                    <div class="col-md-3 col-xs-12">
                        <input class="form-control" type="text" name="course_names[]" placeholder="Course code or name">
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <input class="form-control" name="course_prices[]" style="text-align: right" placeholder="Discounted price or %">
                    </div>
                    <div id="courseRowButtons-` + courseFieldCount + `" class="col-md-1 col-xs-12">
                        <button id="btnAddCourse-` + courseFieldCount + `" type="button" class="btn btn-success btn-block" name="button" onclick="addCourseField(` + courseFieldCount + `)">Add</button>
                    </div>
                </div>
            `;

            $('#form-body').append(courseField);
        }

        function removeCourseField(id) {
            $('#courseRow-' + id).remove();
        }
    </script>
@endsection
