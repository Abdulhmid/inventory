<?php
namespace App\Additionals\Datatables;

class UsersDatatable {

	protected $model;
	public $data;

	public function __construct($model)
	{
		$this->model = $model;
		$this->getData();
	}

	protected function getData()
	{
		$this->data = $this
			->model
			->join('groups','groups.group_id','=','users.group_id')
			->select('id','username', 'photo' ,'email','name', 'active', 'groups.group_name' ,'users.created_at');

	}

	public function make()
	{
		return \Datatables::of($this->data)
            ->editColumn('photo','<img src="{!! GLobalHelp::checkImage($photo) !!}" style="max-height:100px" class="thumbnail"> ')
            ->editColumn('active','
					<span class="label {{ $active == 1 ? \'label-success\' : \'label-danger\' }}">
						{{$active == 1 ? "Active" : "Tidak Active"}}
					</span>
            	')
			->addColumn('action','
				<a href="{!! url(GLobalHelp::indexUrl().\'/edit/\'.$id) !!}" class="btn btn-flat btn-default btn-sm" data-toggle="tooltip" data-original-title="Edit">
					<i class="fa fa-pencil"></i> Ubah
				</a>
				<a href="{!! url(GLobalHelp::indexUrl().\'/delete/\'.$id) !!}" class="btn btn-flat btn-danger btn-sm btn-delete" data-toggle="tooltip" data-original-title="Delete" onclick="swal_alert(this); return false;">
					<i class="fa fa-trash-o"></i> Hapus
				</a>
				')
			->editColumn('created_at','{!! GlobalHelp::formatDate($created_at) !!}')
			->removeColumn('id')
			->make(true);
	}
}
