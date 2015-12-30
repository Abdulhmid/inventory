<?php
namespace App\Additionals\Datatables;

class ItemsCategoryDatatable {

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
			->select('item_category_id','name_category','description','created_at');

	}

	public function make()
	{
		return \Datatables::of($this->data)
			->addColumn('action','
				<a href="{!! url(GLobalHelp::indexUrl().\'/edit/\'.$item_category_id) !!}" class="btn btn-flat btn-default btn-sm" data-toggle="tooltip" data-original-title="Edit">
					<i class="fa fa-pencil"></i> Ubah
				</a>
				<a href="{!! url(GLobalHelp::indexUrl().\'/delete/\'.$item_category_id) !!}" class="btn btn-flat btn-danger btn-sm btn-delete" data-toggle="tooltip" data-original-title="Delete" onclick="swal_alert(this); return false;">
					<i class="fa fa-trash-o"></i> Hapus
				</a>
				')
			->editColumn('created_at','{!! GlobalHelp::formatDate($created_at) !!}')
			->removeColumn('item_category_id')
			->make(true);
	}
}
