<?php
namespace App\Additionals\Datatables\Reports;

class IncomesDatatable {

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
			->select(
				'id',
				'file_name',
				'path',
				'type',
				'note',
				'created_at'
			)->where('type','income')->orderBy('created_at','desc');
	}

	public function make()
	{
		return \Datatables::of($this->data)
			->editColumn('id','
					<a href="{!! url($path.$file_name) !!}" target="_blank"> Unduh </a>
				')
			->removeColumn('note')
			->editColumn('created_at','{!! GlobalHelp::formatDate($created_at) !!}')
			->make(true);
	}
}
