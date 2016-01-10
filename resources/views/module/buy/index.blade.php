@extends('main')

@section('style')
<link href="{!! asset('plugins/datatables/dataTables.bootstrap.css') !!} "rel="stylesheet" type="text/css"/>    
<link href="{!! asset('plugins/sweet-alert/sweet-alert.css') !!} "rel="stylesheet" type="text/css"/>
<link href="{!! asset('css/jquery-ui.css') !!} "rel="stylesheet" type="text/css"/>
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
								<i class="fa fa-plus"></i> History Pembelian
							</a>
						</div>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				@if(Session::has('message'))
					{!! GlobalHelp::messages(Session::get('message'), true) !!}
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
										<input type="text" name="supplier" id="supplier" class="form-control">
										<span class="input-group-btn">
										  <button class="btn btn-info btn-flat" type="button"><i class="fa fa-search"></i></button>
										</span>
										<input type="hidden" id="id_supplier" value="">
									</div>
								</div>
								<div class="form-group">
									<label for="address" class="control-label">Alamat</label>
									<input class="form-control" name="address" type="text" id="address" readonly="true">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-xs-6">
											<label for="no_telp" class="control-label">No Telp</label>
										  	<input type="text" name="telp" id="telp" class="form-control" placeholder="No Telp" readonly="true">
										</div>
										<div class="col-xs-6">
											<label for="email" class="control-label">Email</label>
										  	<input type="text" id="email" name="email" class="form-control" placeholder="email" readonly="true">
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
									<label for="ekpedisi" class="control-label">Ekpedisi</label>
									<input class="form-control" name="ekpedisi" type="text" id="ekpedisi">
								</div>	
								<div class="form-group">
									<label for="ekpedisi" class="control-label">Tanggal Transaksi</label>
									<label class="form-control"><?= date('d F Y') ?></label>
								</div>		
								<div class="form-group">
									<label for="name_category" class="control-label">Total Pembayaran</label><br/>
									<label id="total" class="control-label">8988</label>
								</div>
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
												<input type="text" name="item" id="item" class="form-control">
												<span class="input-group-btn">
												 	<button class="btn btn-info btn-flat" type="button"><i class="fa fa-search"></i></button>
												</span>
												<span class="input-group-btn">
													<button class="btn btn-info btn-flat" style="margin-left: 2px;" type="button">Tambah Pembelian</button>
												</span>

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
										  <th>Harga Beli</th>
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
    $( document ).on( "click", ".delete_item", function( e ) {
        var jwb = confirm('Yakin Menghapus Item ini ? ');
        if(jwb){
            $(this).parent().fadeOut('slow', function() {
                $(this).parent().remove();
            });
        }else{
            alert('batal dihapus');
        }
    });   

    $(function() {
        $( "#supplier" ).autocomplete({
           	source: "{!! url(GLobalHelp::indexUrl().'/suppliers') !!}",
          	focus: function( event, ui ) {
            	$( "#supplier" ).val(ui.item.name_company);
            	return false;
	        },
	        select: function( event, ui ) {
	          	$("#id_supplier").val(ui.item.supplier_id);
	          	$("#address").val(ui.item.address);
	          	$("#telp").val(ui.item.telp);
	          	$("#email").val(ui.item.email);

	            return false;
	        }
        })
        .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .append( "<a><strong>" + item.name_company + " | "+ item.website + "</strong><br>" + item.email +"</a>" )
            .appendTo( ul );
        };

        $( "#item" ).autocomplete({
           	source: "{!! url(GLobalHelp::indexUrl().'/items') !!}",
          	focus: function( event, ui ) {
            	return false;
	        },
	        select: function( event, ui ) {
	            $("table tbody").append($('<tr id="item_'+ui.item.id+'">'+
	            				'<td>#</td>'+
	            				'<td>'+ui.item.name_items+'</td>'+
	            				'<td><input type="number" min="0" name="qty['+ui.item.id+']" id="qty_'+ui.item.id+'" class="qty" value="0" class="form-control" /></td>'+
	            				'<td><input type="number" min="0" name="price-buy['+ui.item.id+']" id="price-buy_'+ui.item.id+'" class="price" value="0" class="form-control" /></td>'+
	            				// '<td><input type="number" min="0" id="price-sell" value="0" class="form-control" /></td>'+
	            				'<td><span class="subtotal_'+ui.item.id+'"></span></td>'+
	                            '<td class="hidden-350"><a rel="tooltip" class="delete_item" title="Hapus Barang" data-original-title="Delete"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>'+
	                        '</tr>').show('slow'));

	            return false;
	        }
        })
        .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .append( "<a><strong>" + item.name_items +"</strong></a>" )
            .appendTo( ul );
        };

    });

    $(document).on("keyup change",".qty, .price",function(event){
        event.preventDefault();
        var qty         = $(this).val();
        var lastChar    = qty.slice(-1);
    	console.log(qty);
        if(parseInt(qty)<0 || lastChar=='-' || lastChar=='+' || lastChar==':' || lastChar=='*') {
            $(this).val('1');
            $("#total").change();
        }else{
        	console.log("d");
            var inputVal = $(this).val();
            	inputVal     = inputVal.replace(',','');
            var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
            if(!numericReg.test(inputVal)) {
                $(this).val(1);
            }else{
                var id      = $(this).attr('id');
                id          = id.split('_');
                var qty    	= parseInt($(this).val());
                var className   = $(this).attr('class');
                var price   = (className == "qty" ? $("#price-buy_"+id[1]).val() : $("#qty_"+id[1]).val())  ;

                var total   = qty*price;
                console.log(id[1]);
                
                var subtotal = total;
                if(subtotal!="NaN") {
                	$(".subtotal_"+id[1]).text(subtotal);
                    $(this).parent().parent().next().next().next().children('span').text(subtotal);
                }else{
                    $(this).parent().parent().next().next().next().children('span').text('0');
                }
            }
        }
    });

    $(document).on("keyup change",".price",function(event){
        event.preventDefault();
        var qty         = $(this).val();
        var lastChar    = qty.slice(-1);
    	console.log(qty);
        if(parseInt(qty)<0 || lastChar=='-' || lastChar=='+' || lastChar==':' || lastChar=='*') {
            $(this).val('1');
            $("#total").change();
        }else{

        }
    });


</script>
@stop
