<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as Md;
use App\Additionals\Datatables\ItemsDatatable;

class Items extends Controller
{

    protected $model;
    protected $title = "Data Barang";
    protected $url = "items";
    protected $folder = "module.items";
    protected $form;

    public function __construct(Md\Items $table,
                                Md\Suppliers $suppliers,
                                Md\ItemsCategory $tableCategory)
    {
        $this->model         = $table;
        $this->suppliers     = $suppliers;
        $this->tableCategory = $tableCategory;
    }

    public function getIndex()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.index', $data);
    }

    public function getCreate()
    {
      $data['title']        = $this->title;
      $data['breadcrumb']   = 'new-'.$this->url;
      $data['category']     = $this->tableCategory->scopeTakeData();
      $data['supplier']     = $this->suppliers->scopeTakeData();

      return view($this->folder.'.form', $data);
    }

    public function postStore(){

    }

    public function getData(Request $request){
        return (new ItemsDatatable($this->model))->make();
    }

}
