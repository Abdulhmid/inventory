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

				{{-- Form --}}
				{!! form_start($form) !!}
				<div class="row">
					<div class="col-md-12">
						<!-- Custom Tabs -->
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
							  <li class="active"><a href="#tab_1" data-toggle="tab">Data</a></li>
							  <li><a href="#tab_2" data-toggle="tab">Harga</a></li>
							  <li><a href="#tab_3" data-toggle="tab">Keterangan</a></li>
							  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
							</ul>
						    <div class="tab-content">
						      <div class="tab-pane active" id="tab_1">
						      	{!! form_row($form->supplier_id, ['selected' => isset($row) ? $row->supplier_id : '']) !!}
						      	{!! form_row($form->category_id, ['selected' => isset($row) ? $row->category_id : '']) !!}
						      	{!! form_row($form->name_items, ['default_value' => isset($row) ? $row->name_items: '']) !!}
						      </div>
						      <div class="tab-pane" id="tab_2">
						      	{!! form_row($form->price_buy, ['default_value' => isset($row['price']) ? (int)$row['price']->price_buy: '']) !!}
						      	{!! form_row($form->price_selling, ['default_value' => isset($row['price']) ? (int)$row['price']->price_selling: '']) !!}
						      </div>
						      <div class="tab-pane" id="tab_3">
								{!! form_row($form->stok, ['default_value' => isset($row['detail']) ? $row['detail']->stok : '']) !!}
								{!! form_row($form->note, ['default_value' => isset($row['detail']) ? $row['detail']->note : '']) !!}
						      </div>
						    </div>
						</div>
					</div>
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
	<script src="{!! asset('plugins/sweet-alert/sweet-alert.js') !!} " type="text/javascript"></script>    
	<script src="{!! asset('js/alert.js') !!} " type="text/javascript"></script>
	<script type="text/javascript">
    </script>
@stop
