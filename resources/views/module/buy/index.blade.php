@extends('main')

@section('style')
<link href="{!! asset('plugins/datatables/dataTables.bootstrap.css') !!} "rel="stylesheet" type="text/css"/>    
<link href="{!! asset('plugins/sweet-alert/sweet-alert.css') !!} "rel="stylesheet" type="text/css"/>
@stop

@section('content')
<section class="content">
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="row">
					<div class="col-xs-6">
						<h3 class="box-title">{!! $title !!}</h3>
					</div>
					<div class="col-xs-6">
						<div class="pull-right">
							<a href="{!! url(GLobalHelp::indexUrl().'/create') !!}" data-original-title="Add" data-toggle="tooltip" class="btn btn-primary">
								<i class="fa fa-plus"></i> Tambah
							</a>
						</div>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				@if(Session::has('error'))
				{!! GlobalHelp::messages(Session::get('error'), true) !!}
				@endif
				<div class="row">
					<div class="col-md-6">
						<div class="box box-solid">
							<div class="box-header with-border">
								<i class="fa fa-text-width"></i>
								<h3 class="box-title">Data Supplier</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<div class="form-group">
									<label for="name_supplier" class="control-label">Nama Supplier</label>
									<div class="input-group input-group-sm">
										<input type="text" name="name_supplier" id="name_supplier" class="form-control">
										<span class="input-group-btn">
										  <button class="btn btn-info btn-flat" type="button">Go!</button>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label for="address" class="control-label">Alamat</label>
									<input class="form-control" name="address" type="text" id="address">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-xs-6">
											<label for="no_telp" class="control-label">No Telp</label>
										  	<input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="No Telp">
										</div>
										<div class="col-xs-6">
											<label for="email" class="control-label">Email</label>
										  	<input type="text" id="email" name="email" class="form-control" placeholder="email">
										</div>
									</div>
								</div>
							</div>
						</div><!-- /.box -->
					</div>
					<div class="col-md-6">
						<div class="box box-solid">
							<div class="box-header with-border">
								<i class="fa fa-text-width"></i>
								<h3 class="box-title">Pembayaran</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<div class="form-group">
									<label for="price_buy" class="control-label">Harga Tiap Item</label>
									<input class="form-control" name="price_buy" type="text" id="price_buy">
								</div>		
								<div class="form-group">
									<label for="ekpedisi" class="control-label">Ekpedisi</label>
									<input class="form-control" name="ekpedisi" type="text" id="ekpedisi">
								</div>		
								<div class="form-group">
									<label for="name_category" class="control-label">Total Pembayaran</label><br/>
									<span id="total">8988</span>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
					<div class="col-md-12">
						<div class="box box-solid">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Daftar Barang</h3>
								</div><!-- /.box-header -->
								<div class="box-body no-padding">
									<table class="table table-condensed">
										<tbody>
										<tr>
										  <th style="width: 10px">#</th>
										  <th>Task</th>
										  <th>Progress</th>
										  <th style="width: 40px">Label</th>
										</tr>
										<tr>
										  <td>4.</td>
										  <td>Fix and squish bugs</td>
										  <td>
										    <div class="progress progress-xs progress-striped active">
										      <div class="progress-bar progress-bar-success" style="width: 90%"></div>
										    </div>
										  </td>
										  <td><span class="badge bg-green">90%</span></td>
										</tr>
										</tbody>
									</table>
								</div><!-- /.box-body -->
							</div>

						</div><!-- /.box -->
					</div>
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->
</section>
@stop

@section('script') 
<script src="{!! asset('plugins/sweet-alert/sweet-alert.js') !!} " type="text/javascript"></script>    
<script src="{!! asset('js/alert.js') !!} " type="text/javascript"></script>    

<script type="text/javascript">
	$(document).ready(function() {

	});
</script>
@stop
