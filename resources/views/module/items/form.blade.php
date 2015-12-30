@extends('main')

@section('style')
	<link href="{!! asset('plugins/sweet-alert/sweet-alert.css') !!} "rel="stylesheet" type="text/css"/>
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

			</div>
					<div class="clearfix"></div>
					@include('partial.form_button')
		</div>

	</div>
</div>
</section>
@stop

@section('script')
	<script src="{!! asset('plugins/sweet-alert/sweet-alert.js') !!} " type="text/javascript"></script>    
	<script src="{!! asset('js/alert.js') !!} " type="text/javascript"></script>
	<script type="text/javascript">
    </script>
@stop
