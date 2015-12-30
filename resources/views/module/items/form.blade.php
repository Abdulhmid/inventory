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
			{!! Form::open(array('url'=>GLobalHelp::indexUrl().'/store', 'class'=>'form-horizontal')) !!}
			<div class="box-body">
				<!-- Validation Start -->
				@if(Session::has('message'))
				{!! GlobalHelp::messages(Session::get('message')) !!}
				@endif

                @include('partial.validation')
                <!-- Validation Stop -->

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
								<div class="form-group">
								    <label for="supplier_id" class="control-label">Supplier</label>
								    <select class="frm-e form-control" id="supplier_id" name="supplier_id">
								    	<option value="" selected="selected">- Pilih Supplier -</option>
								    	@foreach($supplier->toArray() as $key => $valueSupplier)
								    		<option value="{!! $valueSupplier['supplier_id'] !!}">
								    			{!! $valueSupplier['name_company'] !!}</option>
								    	@endforeach
								    </select>    
								</div>
								<div class="form-group">
								    <label for="category_id" class="control-label">Kategori</label>
								    <select class="frm-e form-control" id="category_id" name="category_id">
								    	<option value="" selected="selected">- Pilih Kategori-</option>
								    	@foreach($category->toArray() as $key => $valueCategory)
								    		<option value="{!! $valueCategory['item_category_id'] !!}">
								    			{!! $valueCategory['name_category'] !!}</option>
								    	@endforeach
								    </select>    
								</div>
								<div class="form-group">
									<label for="name_item" class="control-label">Nama Barang</label>
									<input class="form-control" name="name_item" type="text" id="name_item">
								</div>
					      </div><!-- /.tab-pane -->
					      <div class="tab-pane" id="tab_2">
								<div class="form-group">
									<label for="price_buy" class="control-label">Harga Beli</label>
									<input class="form-control" name="price_buy" type="number" min="0" value="0" id="price_buy">
								</div>
								<div class="form-group">
									<label for="price_selling" class="control-label">Harga Jual</label>
									<input class="form-control" name="price_selling" type="number" min="0" value="0" id="price_selling">
								</div>
					      </div><!-- /.tab-pane -->
					      <div class="tab-pane" id="tab_3">
								<div class="form-group">
									<label for="stok" class="control-label">Stok</label>
									<input class="form-control" name="stok" type="number" min="0" id="stok">
								</div>
								<div class="form-group">
									<label for="note" class="control-label">Keterangan</label>
									<textarea class="wysihtml52 form-control" name="note" cols="50" rows="10" id="note">
									</textarea>
								</div>
					      </div><!-- /.tab-pane -->
					    </div><!-- /.tab-content -->
					  </div><!-- nav-tabs-custom -->
					  <b>Tambah Barang Baru:</b>
					  <p>Isikan Sesuai Dengan Kebutuhan</p>
					</div><!-- /.col -->
				</div>

			</div>
			<div class="clearfix"></div>
			@include('partial.form_button')
			{!! Form::close() !!}
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
