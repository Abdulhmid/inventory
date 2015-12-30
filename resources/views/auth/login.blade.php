@extends('app')
@section('style')
<link href="{!! asset('plugins/iCheck/all.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="container" >
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-logo">
                <h2> <img src=""></h2>		
            </div>
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a  class="active" style="color:rgb(144, 196, 83);"><p class="text-center">Login </p></a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="login-form" action="{{ url('/auth/login') }}" method="post" role="form" style="display: block;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group has-feedback">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" autofocus value="{{ old('username') }}">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="padding:10px">
                                        <input type="checkbox" tabindex="3" class="icheck" name="remember" id="remember">
                                        <label for="remember"> Remember Me</label>
                                    </div>
                                </div>		
                                <div class="col-md-6">
                                    <div class="form-group" style="padding:10px;float:right">
                                        <!-- <a href="<?= url('auth/forgot-password') ?>" tabindex="5" class="forgot-password">Forgot Password?</a> -->
                                    </div>
                                </div>
                                <div class="clear-fix"></div>
                                <div class="form-group text-center" >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Sign In ">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{!! asset('plugins/iCheck/icheck.min.js') !!}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.icheck').iCheck({
            checkboxClass: 'icheckbox_flat'
        });
    });
</script>
@endsection
