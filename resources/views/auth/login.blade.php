<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Login | NEWSIM App</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="/css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

        <div class="login-container login-v2">

            <div class="login-box animated fadeInDown">
                <div class="login-body">
                    <div class="login-title"><strong>Welcome</strong>, Please login.</div>
                    <form action="login" role="form" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-user"></span>
                                    </div>
                                    <input class="form-control" placeholder="Username" value="{{ old('username') }}" name="username" required autofocus/>
                                </div>
                                @if ($errors->has('username'))
                                    <span class="help-block successful">
                                        <strong class="text-danger">{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-lock"></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <a href="{{ route('password.request') }}">Forgot your password?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg btn-block">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2017 NEWSIMS
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
