@extends('layouts.main')

@section('page-title')
    News | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li class="active">News</li>
    </ul>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong>Timeline filter</strong> isn't working just yet! Try posting something instead.
                </div>
                @if ($errors->has('post_images.*'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong>Upload Fails!</strong> {{ $errors->first('post_images.*') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <!-- START TIMELINE FILTER -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Timeline filter</h3>
                        <form class="form-horizontal" role="form">
                        <div class="form-group">

                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-search"></span></span>
                                    <input type="text" class="form-control" placeholder="Keywords"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                                    <input type="text" class="form-control datepicker" value="2015-10-06"/>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="btn-group btn-group-justified">
                                    <a href="#" class="btn btn-primary active">All</a>
                                    <a href="#" class="btn btn-primary">Year</a>
                                    <a href="#" class="btn btn-primary">Month</a>
                                    <a href="#" class="btn btn-primary">Week</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pull-right">
                                    <button class="btn btn-success"><span class="fa fa-refresh"></span> UPDATE</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- END TIMELINE FILTER -->

            </div>
            <div class="col-md-6">

                <!-- START NEW RECORD -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Post Something</h3>
                        <form class="form-horizontal" action="{{ route('posts.store') }}" role="form" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group @if ($errors->has('title')) has-error @endif">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input class="form-control" placeholder="Title" name="title" value="{{ old('title') }}"/>
                                    </div>
                                    @if ($errors->has('title'))
                                        <span class="help-block">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="">
                                        <textarea class="form-control" rows="5" placeholder="Body" name="body">{{ old('body') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <input name="post_images[]" type="file" multiple id="file-simple" accept="image/*"/>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-danger"><span class="fa fa-share"></span> POST</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END NEW RECORD -->

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="timeline">

                    <!-- START TIMELINE ITEM -->
                    <div class="timeline-item timeline-main">
                        <div class="timeline-date">{{ $posts ? '' : $posts->first()->created_at->year }}</div>
                    </div>
                    <!-- END TIMELINE ITEM -->

                    @foreach ($posts as $key => $post)
                        <!-- TIMELINE ITEM -->
                        <div class="timeline-item @if (($key % 2) == 1) timeline-item-right @endif">
                            <div class="timeline-item-info">{{ $post->created_at->toFormattedDateString() }}</div>
                            <div class="timeline-item-icon"><span class="fa fa-globe"></span></div>
                            <div class="timeline-item-content">
                                <div class="timeline-heading">
                                    <img src="assets/images/users/user.jpg"/> <a href="#">{{ $post->createdBy->name }}</a> posted for <a href="#">{{ $post->branch->name }}</a>
                                </div>
                                <div class="timeline-body">
                                    <h4>{{ $post->title }}</h4>

                                </div>
                                <div class="timeline-body">
                                    <p>{{ $post->body }}</p>
                                </div>
                                <div class="timeline-body" id="links">
                                    @foreach ($post->postImages as $key => $postImage)
                                        <div class="col-md-4">
                                            <a href="{{ asset($postImage->url) }}" title="Nature Image 1" data-gallery>
                                                <img src="{{ asset($postImage->url) }}" class="img-responsive img-text"/>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- TIMELINE ITEM -->
                    @endforeach

                    <!-- START TIMELINE ITEM -->
                    <div class="timeline-item timeline-main">
                        <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
                    </div>
                    <!-- END TIMELINE ITEM -->

                </div>

            </div>
            <div class="col-md-12">
                <div class="pull-right">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>

    </div>

    <!-- BLUEIMP GALLERY -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    <!-- END BLUEIMP GALLERY -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/fileinput/fileinput.min.js') }}"></script>
    <script>
        $(function(){
            $("#file-simple").fileinput({
                showUpload: false,
                showCaption: false,
                uploadUrl: "{{ URL::to('posts') }}",
                browseClass: "btn btn-primary",
                browseLabel: "Upload Photos",
                allowedFileExtensions : ['.jpg', '.png'],
            });
        });

        // Blueimp integration
        document.getElementById('links').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event,onclosed: function(){
                    setTimeout(function(){
                        $("body").css("overflow","");
                    },200);
                }},
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        };
    </script>
@endsection
