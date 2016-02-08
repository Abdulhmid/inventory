<?php
namespace App\Additionals\Datatables;

class HistoryBuyDatatable {

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
			->scopeTakeData();

	}

	public function make()
	{
		return \Datatables::of($this->data)
			->addColumn('code','{!! $key_transaction !!}')
			->addColumn('item','{!! $item->name_items !!}')
			->addColumn('total','{!! GLobalHelp::idrFormat($qty * $price_buy) !!}')
			// ->addColumn('action','
			// 	<a href="{!! url(GLobalHelp::indexUrl().\'/edit/\'.$key_transaction) !!}" class="btn btn-flat btn-default btn-sm" data-toggle="tooltip" data-original-title="Edit">
			// 		<i class="fa fa-pencil"></i> Ubah
			// 	</a>
			// 	<a href="{!! url(GLobalHelp::indexUrl().\'/delete/\'.$key_transaction) !!}" class="btn btn-flat btn-danger btn-sm btn-delete" data-toggle="tooltip" data-original-title="Delete" onclick="swal_alert(this); return false;">
			// 		<i class="fa fa-trash-o"></i> Hapus
			// 	</a>
			// 	')
			->editColumn('created_at','{!! GlobalHelp::formatDate($created_at) !!}')
			// ->removeColumn('key_transaction')
			->make(true);
	}
}
