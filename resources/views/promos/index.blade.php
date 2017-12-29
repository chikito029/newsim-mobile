@extends('layouts.main')

@section('page-title')
    Promos | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li class="active">Promos</li>
    </ul>
@endsection

@section('page-content-title')
    <div class="page-title">
        <h2><span class="fa fa-tags"></span> Promos</h2>
        <div class="pull-right">
            <a href="{{ route('promos.create') }}" class="btn btn-danger"><span class="fa fa-plus"></span> New Promo</a>
        </div>
    </div>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">
        <div class="row">

            @if ($promos->count() > 0)
                @foreach ($promos as $key => $promo)
                    <!-- NEWS WIDGET -->
                    <div class="col-md-4">

                        <div class="panel panel-default">
                            <div class="panel-body panel-body-image">
                                <img src="{{ asset($promo->banner_url) }}" alt="Ocean"/>
                                <a href="{{ route('promos.edit', $promo->id) }}" class="panel-body-inform">
                                    <span class="fa fa-pencil"></span>
                                </a>
                            </div>
                            <div class="panel-body">
                                <h3>{{ $promo->title }}</h3>
                                <p>{{ $promo->body }}</p>
                            </div>
                            <div class="panel-body list-group">
                                @foreach ($promo->promoCourses as $key => $promoCourse)
                                    <a href="#" class="list-group-item"><span class="fa fa-circle"></span> {{ $promoCourse->name }} <span class="pull-right">{{ $promoCourse->price }}</span> </a>
                                @endforeach
                            </div>
                            <div class="panel-footer">
                                <span class="fa fa-calendar"></span> &nbsp;{{ \Carbon\Carbon::createFromFormat('Y-m-d', $promo->start_date)->format('M d, Y') }} to {{ \Carbon\Carbon::createFromFormat('Y-m-d', $promo->end_date)->format('M d, Y') }}
                                <span class="pull-right text-muted">{{ $promo->branch->name }}</span>
                            </div>
                            <div class="panel-footer">
                                <button type="button" name="button" class="btn btn-danger btn-block" onclick="delete_promo({{ $promo->id }})"><i class="fa fa-times"></i> REMOVE</button>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('promos.destroy', $promo->id) }}" accept-charset="UTF-8" id="formDelete{{ $promo->id }}">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                        </form>

                    </div>
                    <!-- END NEWS WIDGET -->
                @endforeach
            @else
                <div class="col-md-12" style="margin-top: 150px;">
                    <div class="icon-preview">
                        <i class="fa fa-tags" style="color: rgb(102, 102, 102)"></i>
                    </div>
                    <h1 class="text-center" style="color: rgb(102, 102, 102)">No Active Promo as of the Moment!</h1>
                </div>
            @endif

        </div>
    </div>

    <!-- DELETE ITEM MESSAGE BOX -->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete-promo">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Promo</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to remove this Promo?</p>
                    <p>Press Yes to remove promo.</p>
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
    <script type="text/javascript">
        function delete_promo(row) {

            var box = $("#mb-delete-promo");
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
