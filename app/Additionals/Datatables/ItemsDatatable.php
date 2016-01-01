<?php
namespace App\Additionals\Datatables;

class ItemsDatatable {

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
			->with(['supplier','detail','price']);

	}

	public function make()
	{
		return \Datatables::of($this->data)
			->addColumn('action','
				<a href="{!! url(GLobalHelp::indexUrl().\'/edit/\'.$id) !!}" class="btn btn-flat btn-default btn-sm" data-toggle="tooltip" data-original-title="Edit">
					<i class="fa fa-pencil"></i> Ubah
				</a>
				<a href="{!! url(GLobalHelp::indexUrl().\'/delete/\'.$id) !!}" class="btn btn-flat btn-danger btn-sm btn-delete" data-toggle="tooltip" data-original-title="Delete" onclick="swal_alert(this); return false;">
					<i class="fa fa-trash-o"></i> Hapus
				</a>
				')
            ->addColumn('supplier', function($row){
                return !is_null($row->supplier) ? $row->supplier->name_company : '-';
            })
            ->editColumn('price', '977')
            ->addColumn('stok', function($row){
                return !is_null($row->detail) ? $row->detail->stok : '-';
            })
            ->addColumn('note', function($row){
                return !is_null($row->detail) ? $row->detail->note : '-';
            })
			->editColumn('created_at','{!! GlobalHelp::formatDate($created_at) !!}')
			->removeColumn('id')
			->make(true);
	}
}
