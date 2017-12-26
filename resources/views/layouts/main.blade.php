<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>@yield('page-title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{ url('css/theme-dark-head-light.css') }}"/>
        <!-- EOF CSS INCLUDE -->

        @yield('styles')
    </head>
    <body class="page-container-boxed">
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top">
            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal">
                    <li class="xn-logo">
                        <a href="{{ url('home') }}">ATLANT</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-openable">
                        <a href="{{ route('posts.index') }}"><span class="fa fa-bullhorn"></span> <span class="xn-text">News & Events</span></a>
                    </li>
                    <li class="xn-openable">
                        <a href="{{ route('courses.index') }}"><span class="fa fa-th-list"></span> <span class="xn-text">Courses</span></a>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-calendar"></span> <span class="xn-text">Schedules</span></a>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-tags"></span> <span class="xn-text">Promos</span></a>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file-text"></span> <span class="xn-text">Circulars</span></a>
                    </li>

                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                        </ul>
                    </li>
                    <!-- END POWER OFF -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- START BREADCRUMB -->
                @yield('breadcrumb')
                <!-- END BREADCRUMB -->

                @yield('page-content-title')

                <!-- PAGE CONTENT WRAPPER -->
                @yield('page-content-wrapper')
                <!-- PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages-login.html" class="btn btn-success btn-lg" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{ url('audio/alert.mp3') }}" preload="auto"></audio>
        <audio id="audio-fail" src="{{ url('audio/fail.mp3') }}" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{ url('js/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/plugins/jquery/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap.min.js') }}"></script>
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src="{{ url('js/plugins/icheck/icheck.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>
        <script type='text/javascript' src="{{ url('js/plugins/noty/jquery.noty.js') }}"></script>
        <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topRight.js') }}"></script>
        <script type='text/javascript' src="{{ url('js/plugins/noty/themes/default.js') }}"></script>

        @yield('scripts')
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{ url('js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/actions.js') }}"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
