@extends('main')

@section('style')
	<link href="{!! asset('plugins/iCheck/all.css') !!} "rel="stylesheet" type="text/css"/>
@stop

@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12">
		<!-- general form elements -->
		<div class="box box-primary ">
			<div class="box-header">
				<div class="row">
					<div class="col-xs-6">
						<h3 class="box-title">{!! str_contains(Request::segment(2), 'create') ? 'Tambah' : 'Ubah' !!} {!! $title !!}</h3>
					</div>
					<div class="col-xs-6">
						<div class="pull-right">
							<a href="{!! URL::to(GlobalHelp::indexUrl())!!}" class="btn btn-default">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="box-body">
				@if(Session::has('message'))
				{!! GlobalHelp::messages(Session::get('message')) !!}
				@endif

				{{-- Form --}}
				{!! form_start($form) !!}

					<div class="col-md-8">
                        {!! form_row($form->username, ['default_value' => isset($row) ? $row->username: '']) !!}
                        {!! form_row($form->name, ['default_value' => isset($row) ? $row->name: '']) !!}
                        {!! form_row($form->email, ['default_value' => isset($row) ? $row->email: '']) !!}
                        {!! form_row($form->password,['default_value' => '']) !!}
                        {!! form_row($form->password_confirmation) !!}
                        {!! form_row($form->active) !!}
                        {!! form_row($form->group_id) !!}
					</div>
					<div class="col-md-4">
						{!! form_label($form->photo) !!}
						{!! form_widget($form->photo, ['attr' => ['style' => 'display:none']]) !!}
						<div class="text-danger">{!! $errors->first('photo') !!}</div>

						{!! form_row($form->upload) !!}
						<br>
						<p class="text-center">
							<img id="preview_img" class="img img-thumbnail" style="margin-top: 25px; max-height:200px" src="{{ isset($row) && !empty($row->photo) ? asset(GLobalHelp::checkImage($row->photo)) : '' }}"  />
						</p>
					</div>

			</div>
					<div class="clearfix"></div>
					@include('partial.form_button')
				{!! form_end($form) !!}

				{{-- End Form --}}
		</div>

	</div>
</div>
</section>
@stop

@section('script')
	<script type="text/javascript" src="{!! asset('plugins/iCheck/icheck.min.js') !!}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('input[type="radio"]').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green'
			});
			$("#password").val("");
			@if(GLobalHelp::actionUrl() == "edit")
				@if(isset($row) && $row->active == 1)
					$("#active_1").iCheck('check');
				@else
					$("#active_2").iCheck('check');
				@endif
			@endif
		});

		function readUrl(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#preview_img').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		function chooseFile()
		{
			$('#file').click();
		}
	</script>
@stop
