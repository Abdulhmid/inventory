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
							<a href="{!! url(GLobalHelp::indexUrl().'/history') !!}" data-original-title="Add" data-toggle="tooltip" class="btn btn-primary">
								<i class="fa fa-plus"></i> History Penjualan
							</a>
						</div>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				@if(Session::has('message'))
					{!! GlobalHelp::messages(Session::get('message'), true) !!}
				@endif
				{!! Form::open(array('url'=>GLobalHelp::indexUrl().'/store-transaction', 'method' => 'post', 'class'=>'form-horizontal','id'=>'formoid')) !!}
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-6">
						<div class="box box-solid">
							<div class="box-header with-border">
								<i class="fa fa-text-width"></i>
								<h3 class="box-title">Data Supplier</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<div class="form-group">
									<label for="name_supplier" class="control-label">Nama Barang</label>
									<div class="input-group input-group-sm">
										<input type="text" name="item" id="item" class="form-control">
										<span class="input-group-btn">
										  <button class="btn btn-info btn-flat" type="button"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-xs-6">
											<button class="btn btn-info pull-left" id="saveTrans" type="submit">Simpan Transaksi</button>
										</div>
										<div class="col-xs-6">
											<button class="btn btn-info pull-right" id="print">Cetak</button>
										</div>
										<input type="hidden" readonly="true" id="idList" value="">
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
									<label for="ekpedisi" class="control-label">Tanggal Transaksi</label>
									<label class="form-control"><?= date('d F Y') ?></label>
								</div>		
								<div class="form-group">
									<label for="name_category" class="control-label">Total Pembayaran</label><br/>
									<label id="totalFull" class="control-label">0</label>
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
				{!! Form::close() !!}
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
    	$('#print').prop('disabled', true);
    	var itemId = [];

        $( "#item" ).autocomplete({
           	source: "{!! url(GLobalHelp::indexUrl().'/items') !!}",
          	focus: function( event, ui ) {
            	return false;
	        },
	        select: function( event, ui ) {
				if ($.inArray(ui.item.id, itemId) < 0) {
		            $("table tbody").append($('<tr id="item_'+ui.item.id+'">'+
						'<td>#<input type="hidden" name="idItemPart[]" value="'+ui.item.id+'"/></td>'+
						'<td>'+ui.item.name_items+'</td>'+
						'<td><input type="number" min="0" name="qty[]" id="qty_'+ui.item.id+'" class="qty" value="0" class="form-control" />'+
						'<input type="hidden" min="0" name="stok[]" id="stok_'+ui.item.id+'" class="stok" value="'+ui.item.detail.stok+'" class="form-control" /></td>'+
						'<td><input type="number" min="0" name="price-sell[]" id="price-sell_'+ui.item.id+'" class="price" value="'+ui.item.price.price_selling+'" readonly="true" class="form-control" /> / '+ui.item.unit+'</td>'+
						// '<td><input type="number" min="0" id="price-sell" value="0" class="form-control" /></td>'+
						'<td><span class="subtotal_'+ui.item.id+'">0</span></td>'+
		                '<td class="hidden-350"><a rel="tooltip" class="delete_item" title="Hapus Barang" data-original-title="Delete"><button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button></a></td>'+
		            '</tr>').show('slow'));
				  	itemId.push(ui.item.id);
				}else {
				  	console.log('Pakistan found');
				}
				$("#idList").val(itemId);
	            return false;
	        }
        })
        .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .append( "<a><strong>" + item.name_items + "<br/> Suppliers : " + item.supplier.name_company +"</strong></a>" )
            .appendTo( ul );
        };

        /* Action Print Nota */
		$("#print").on('click', function(){
			var url = "{!! url(GLobalHelp::indexUrl().'/nota') !!}"+"/"+$("#idList").val();    
			$(location).attr('href',url);
		});

    });

    $(document).on("keyup change",".qty, .price",function(event){
        event.preventDefault();

        /* Check Stok */
        var idStok      = $(this).attr('id');
        idStok          = idStok.split('_');
        var stok = $("#stok_"+idStok[1]).val();

        if($("#qty_"+idStok[1]).val() > parseInt(stok)) {
			sweetAlert("Oops...", "Jumlah Melebihi Kuota!", "error");
        	$('#saveTrans').prop('disabled', true);
        }else{
        	$('#saveTrans').prop('disabled', false);
        }

        var qty         = $(this).val();
        var lastChar    = qty.slice(-1);
        if(parseInt(qty)<0 || lastChar=='-' || lastChar=='+' || lastChar==':' || lastChar=='*') {
            $(this).val('1');
            $("#total").change();
        }else{
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
                var price   = (className == "qty" ? $("#price-sell_"+id[1]).val() : $("#qty_"+id[1]).val())  ;

                var total   = qty*price;
                
                var subtotal = total;
                if(subtotal!="NaN") {
                	$(".subtotal_"+id[1]).text(addCommas(subtotal));
                    $(this).parent().parent().next().next().next().children('span').text(addCommas(subtotal));
                }else{
                    $(this).parent().parent().next().next().next().children('span').text('0');
                }
            }
        }
        var arrayData = $("#idList").val().split(",");
        	sum = 0;
		$.each( arrayData, function( index, value ){
			sum += parseInt($(".subtotal_"+value).text().replace(/,/g, ''), 10); 
		});
		var fullTotal = (sum != "NaN" ? sum : "0") ;
        $("#totalFull").text(addCommas(fullTotal));

    });

  	$(function() {

	    // Action Post
	    $("#formoid").submit(function(event) {
	      if ($('#id_supplier').val() == "") { alert("Supplier Tidak Boleh Kosong") };
	      /* stop form from submitting normally */
	      event.preventDefault();

	      /* get some values from elements on the page: */
	      var $form = $( this ),
	          url = $form.attr( 'action' );

	      /* Send the data using post */
	      var posting = $.post( url, {
	      	  _token: $('#formoid > input[name="_token"]').val(),
	          qty 	: $('input[name="qty[]"]').map(function() {
	           		return $(this).val(); }).get().join(),
	          priceSell : $('input[name="price-sell[]"]').map(function() {
	           		return $(this).val(); }).get().join(),
	          idItemPart : $('input[name="idItemPart[]"]').map(function() {
	           		return $(this).val(); }).get().join(),
	          supplier : $('#id_supplier').val(),
	          itemId : $('#idList').val(),
	      } );

	      /* Alerts the results */
	      posting.done(function( data ) {
	      		$('button[type="submit"]').prop('disabled', true);
	      		$('.delete_item').prop('disabled', true);
	      		$('.btn-delete').prop('disabled', true);
	      		$('#item').prop('disabled', true);
	      		$('#print').prop('disabled', false);
	      		$("#idList").val(data);
		 		console.log(data);
	      });
	      return false;
	    });
	});

    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

</script>
@stop
