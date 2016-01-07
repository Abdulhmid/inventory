<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as Md;

class Buying extends Controller
{

    protected $model;
    protected $title = "Transaksi Pembelian Barang";
    protected $url = "buy";
    protected $folder = "module.buy";
    protected $form;

    public function __construct(Md\Items $table,
                                Md\Suppliers $suppliers
                               )
    {
        $this->model         = $table;
        $this->suppliers     = $suppliers;
    }

    public function getIndex()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.index', $data);
    }

    public function getSuppliers(Request $request){
        $term = $request->get('term');
        return json_encode($this->suppliers->where('name_company', 'like', '%'.$term.'%')
                                           ->get()->toArray());
    }

    public function getItems(Request $request){
        $term = $request->get('term');
        return json_encode($this->model->where('name_items', 'like', '%'.$term.'%')
                                           ->get()->toArray());
    }

}
