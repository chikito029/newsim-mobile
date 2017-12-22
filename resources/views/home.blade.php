@extends('layouts.main')

@section('page-title')
    Home | NEWSIM Mobile
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="active">Home</li>
    </ul>
@endsection

@section('page-content-title')
    <div class="page-title">
        <h2><span class="fa fa-home"></span> Home</h2>
    </div>
@endsection

@section('page-content-wrapper')
    <div class="page-content-wrap">

        <!-- START WIDGETS -->
        <div class="row">
            <div class="col-md-3">

                <!-- START WIDGET SLIDER -->
                <div class="widget widget-default widget-carousel">
                    <div class="owl-carousel" id="owl-example">
                        <div>
                            <div class="widget-title">Total Visitors</div>
                            <div class="widget-subtitle">27/08/2015 15:23</div>
                            <div class="widget-int">3,548</div>
                        </div>
                        <div>
                            <div class="widget-title">Returned</div>
                            <div class="widget-subtitle">Visitors</div>
                            <div class="widget-int">1,695</div>
                        </div>
                        <div>
                            <div class="widget-title">New</div>
                            <div class="widget-subtitle">Visitors</div>
                            <div class="widget-int">1,977</div>
                        </div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                </div>
                <!-- END WIDGET SLIDER -->

            </div>
            <div class="col-md-3">

                <!-- START WIDGET MESSAGES -->
                <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                    <div class="widget-item-left">
                        <span class="fa fa-envelope"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count">48</div>
                        <div class="widget-title">New messages</div>
                        <div class="widget-subtitle">In your mailbox</div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                </div>
                <!-- END WIDGET MESSAGES -->

            </div>
            <div class="col-md-3">

                <!-- START WIDGET REGISTRED -->
                <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
                    <div class="widget-item-left">
                        <span class="fa fa-user"></span>
                    </div>
                    <div class="widget-data">
                        <div class="widget-int num-count">375</div>
                        <div class="widget-title">Registred users</div>
                        <div class="widget-subtitle">On your website</div>
                    </div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                </div>
                <!-- END WIDGET REGISTRED -->

            </div>
            <div class="col-md-3">

                <!-- START WIDGET CLOCK -->
                <div class="widget widget-danger widget-padding-sm">
                    <div class="widget-big-int plugin-clock">00:00</div>
                    <div class="widget-subtitle plugin-date">Loading...</div>
                    <div class="widget-controls">
                        <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                    </div>
                    <div class="widget-buttons widget-c3">
                        <div class="col">
                            <a href="#"><span class="fa fa-clock-o"></span></a>
                        </div>
                        <div class="col">
                            <a href="#"><span class="fa fa-bell"></span></a>
                        </div>
                        <div class="col">
                            <a href="#"><span class="fa fa-calendar"></span></a>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET CLOCK -->

            </div>
        </div>
        <!-- END WIDGETS -->

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ url('js/plugins/owl/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/morris/raphael-min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/morris/morris.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/rickshaw/d3.v3.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/rickshaw/rickshaw.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/plugins/moment.min.js') }}"></script>
@endsection
