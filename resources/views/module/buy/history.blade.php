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
						<h3 class="box-title">Daftar {!! $title !!}</h3>
					</div>
					<div class="col-xs-6">
						<div class="pull-right">
							<a href="{!! url(GLobalHelp::indexUrl()) !!}" data-original-title="Add" data-toggle="tooltip" class="btn btn-default">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				@if(Session::has('error'))
					{!! GlobalHelp::messages(Session::get('error'), true) !!}
				@endif
				<table id="datatable" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="11%">Kode Transaksi</th>
							<th width="2%">Item</th>
							<th width="2%">Qty</th>
							<th width="2%">Total</th>
							<th width="7%">Pembaruan Terakhir</th>
						</tr>
					</thead>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
</div><!-- /.row -->
</section>
@stop

@section('script')
<script src="{!! asset('plugins/datatables/jquery.dataTables.js') !!}" type="text/javascript"></script>    
<script src="{!! asset('plugins/datatables/dataTables.bootstrap.js') !!} " type="text/javascript"></script>    
<script src="{!! asset('plugins/sweet-alert/sweet-alert.js') !!} " type="text/javascript"></script>    
<script src="{!! asset('js/alert.js') !!} " type="text/javascript"></script>    

<script type="text/javascript">
	$(document).ready(function() {
		var filter = '';
		datatable(filter);
	});

	function datatable(filter){

		return oTable = $('#datatable').DataTable({
			"dom": '<"tableHeader"<"row"<"col-md-6"f><"col-md-6"p>>><"newProcessing"r>t<"tableFooter"<"row"<"col-md-4"l><"col-md-4"i><"col-md-4"p>>>',
			"order": [[ 1, "asc" ]],
			"bPaginate": true,
			"bLengthChange": true,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": true,
			"processing": true,
			"bDestroy": true,
			"serverSide": true,
	        "ajax": {
	            "url": "{!! url(GLobalHelp::indexUrl().'/data') !!}",
			    error: function (xhr, error, thrown) {
			    	sweetAlert("Oops...", "Something went wrong!", "error");
			    },
	            data: function (d) {
	            }
	        },
			"columns": [
				{data: 'code', name: 'code'},
				{data: 'item', name: 'item'},
				{data: 'qty', name: 'qty'},
				{data: 'total', name: 'total'},
				{data: 'created_at', name: 'created_at', searchable : false}
				// {data: 'action', name: 'action', searchable : false}
			], 
			fnDrawCallback: function(){
				$('[data-toggle="tooltip"]').tooltip();
			}
		});
	}

</script>
@stop
