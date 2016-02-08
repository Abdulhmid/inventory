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
								<h3 class="box-title">ID Transaksi</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<div class="form-group">
									<label for="name_supplier" class="control-label">Masukkan ID Transaksi</label>
									<div class="input-group input-group-sm">
										<input type="text" name="termKey" id="termKey" class="form-control">
										<span class="input-group-btn">
										  <button class="btn btn-info btn-flat" id="find" type="button">Cari!</button>
										</span>
									</div>
								</div>
							</div>
						</div><!-- /.box -->
					</div>
					<div class="col-md-6">
						<div class="box box-solid">
							<div class="box-header with-border">
								<i class="fa fa-text-width"></i>
								<h3 class="box-title">Total Pembayaran</h3>
							</div><!-- /.box-header -->
							<div class="box-body">	
								<div class="form-group">
									<label for="name_category" class="control-label">Keterangan Pengembalian</label><br/>
									<textarea class="form-control"></textarea>
								</div>
								<!-- <div class="form-group">
									<label for="name_category" class="control-label">Total Pembayaran</label><br/>
									<span id="total">8988</span>
								</div> -->
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
					<div class="col-md-12">
						<div class="box box-solid">
							<div class="box">
								<div class="box-header">
									<div class="col-md-6">
										<div class="pull-left">
											<div class="input-group input-group-sm" style="margin-left: -20px;width: 67%;">
												<span class="input-group-btn">
													<button class="btn btn-info btn-flat" style="margin-left: 2px;" type="submit">Tambah Pembelian</button>
												</span>
												<span class="input-group-btn">
													<button class="btn btn-info btn-flat" style="margin-left: -95px;" id="print" type="button">Cetak</button>
												</span>
												<input type="hidden" readonly="true" id="idList" value="">

											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="pull-right">
											<h3 class="box-title">Daftar Barang</h3>
										</div>
									</div>
								</div><!-- /.box-header -->
								<div class="box-body no-padding">
									<table class="table table-condensed">
										<tbody>
										<tr>
										  <th style="width: 10px">#</th>
										  <th>Nama Barang</th>
										  <th>QTY</th>
										  <th>Harga</th>
										  <!-- <th>Harga Jual</th> -->
										  <th>Sub Total</th>
										  <th style="width: 40px">Aksi</th>
										</tr>
										<tr>

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
		$("#find").click(function(){
			var term = $('#termKey').val();

			$.get("{{ url(GLobalHelp::indexUrl().'/return-find') }}/"+term)
				.success(function(data){

					$.each(data, function(index, value){
						// value.place.address
						/* Action */
						$("table tbody").append($('<tr id="item_'+value.item.id+'">'+
							'<td>#<input type="hidden" name="idItemPart[]" value="'+value.item.id+'"/></td>'+
							'<td>'+value.item.name_items+'</td>'+
							'<td><input type="number" min="0" name="qty[]" id="qty_'+value.item.id+'" class="qty" value="'+value.qty+'" class="form-control" /></td>'+
							'<td><input type="number" min="0" name="price-buy[]" id="price-buy_'+value.item.id+'" class="price" value="'+value.price_sell+'" class="form-control" /> / '+value.item.unit+'</td>'+
							// '<td><input type="number" min="0" id="price-sell" value="0" class="form-control" /></td>'+
							'<td><span class="subtotal_'+value.item.id+'">'+(value.price_sell*value.qty)+'</span></td>'+
						    '<td class="hidden-350"><a rel="tooltip" class="delete_item" title="Hapus Barang" data-original-title="Delete"><button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button></a></td>'+
						'</tr>').show('slow'));

					})

					// $('#loading').hide()
				})
				.fail(function(){

				});  

		});
	});
</script>
@stop
