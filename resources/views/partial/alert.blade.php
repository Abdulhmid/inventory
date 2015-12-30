@if (count($errors) > 0)
<div class="alert alert-danger autohide">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<?php if (Session::has('error')): ?>
    <div class="alert alert-danger autohide" role="alert"><?= Session::get('error') ?></div>
<?php endif; ?>

<?php if (Session::has('success')): ?>
    <div class="alert alert-success autohide" role="alert"><?= Session::get('success') ?></div>
<?php endif; ?>