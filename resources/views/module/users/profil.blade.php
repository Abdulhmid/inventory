@extends('main')

@section('style')
<link href="{!! asset('plugins/iCheck/all.css') !!} "rel="stylesheet" type="text/css"/>	
<link href="{!! asset('plugins/select2/select2.min.css') !!} "rel="stylesheet" type="text/css"/>
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box ">
				<div class="box-header">
					<div class="row">
						<div class="col-xs-6">
							<h3 class="box-title">{!! $title !!}</h3>
						</div>
						<div class="col-xs-6">
							<div class="pull-right">
								<a href="{!! url('dashboard') !!}" class="btn btn-default"> 
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

                    @if(Session::has('error'))
                        {!! GlobalHelp::messages(Session::get('error'), true) !!}
                    @endif

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
					<form action="{{ url('/users/store-profil/'.Auth::user()->id) }}" method="post" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="col-md-8">
							<div class="form-group">
					        	<label for="parent" class="control-label">Nama</label>    
					            <input class="form-control" id="name" name="name" type="text" value="{!! !empty($row->name) ? $row->name : '' !!}">  
					        </div>
							<div class="form-group">
						        <label for="password" class="control-label">Password</label>    
						        <input class="form-control" id="password" name="password" type="password" value=""> 
						        <p> Kosongkan Password jika tidak mau diubah </p>     
					        </div>
							<div class="form-group">
						        <label for="password_confirmation" class="control-label">Password Confirmation</label>    
						        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" value="">            
					        </div>
				        </div>
				        <div class="col-md-4">
					        <div class="form-group">
								<label for="photo" class="control-label">Photo</label>    

								<input class="form-control" id="file" onchange="readUrl(this)" style="display:none" name="photo" type="file">    

								<div class="text-danger"></div>
								<button class="form-control btn bg-gray" id="upload" type="button" onclick="chooseFile()"><i class="fa fa-upload"></i> Browse</button>
								<br>						
								<p class="text-center">
									<img id="preview_img" class="img img-thumbnail" style="margin-top: 25px; max-height:200px" src="{{ !empty($row->photo) ? asset(GLobalHelp::checkImage($row->photo)) : '' }}">
								</p>					        	
					        </div>
				        </div>
				        <div class="col-md-12">
						<div class="box-footer">
							<div class="pull-right">
								<button class="btn btn-danger" type="button" id="reset">
									<i class="fa fa-refresh" style="margin-right:5px"></i> Perbaruhi Data
								</button>
								<button class="btn btn-primary" type="submit">
									<i class="fa fa-file" style="margin-right:5px"></i> Simpan
								</button>
							</div>
							<div class="clearfix"></div>
						</div>
						</div>
			        </form>

				</div>
				<div class="clearfix"></div>

				{{-- End Form --}}
			</div>

		</div>
	</div>
</section>
@stop

@section('script')
<script type="text/javascript" src="{!! asset('plugins/iCheck/icheck.min.js') !!}"></script>
<script src="{!! asset('plugins/select2/select2.min.js') !!} " type="text/javascript"></script>
<script src="{!! asset('js/reset.js') !!}"></script>
<script type="text/javascript">
	$(document).ready(function(){
	

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

    function scopeAction(data)
    {

        if (data=='all') {
            $("select#regional option").prop("selected", false);
            $("select#site option").prop("selected", false);
        }
        else if (data=='regional') {
            $("#inputRegional").show();
            $("select#site option").prop("selected", false);
        }
        else {
            $("#inputRegional").show();
            $("#inputSite").show();
        }
    }

</script>
@stop
