@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Atur Ulang Password</div>
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

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

                    <?php if (Session::has('error')): ?>
                        <div class="alert alert-danger" role="alert"><?= Session::get('error') ?></div>
                    <?php endif; ?>

                    <?php if (Session::has('success')): ?>
                        <div class="alert alert-success" role="alert"><?= Session::get('success') ?></div>
                    <?php endif; ?>

                    <form class="form-horizontal" role="form" method="POST" action="<?= url('auth/reset') ?>">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Alamat E-Mail</label>
                            <div class="col-md-6">
                                <input type="email" placeholder="Masukkan email Anda" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Kirim Link Untuk Atur Ulang Password
                                </button>
                                <a href="{!! url('/dashboard') !!}" class="btn btn-default"> Kembali ke Beranda </a>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
