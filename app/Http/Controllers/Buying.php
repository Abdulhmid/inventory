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
                                Md\Suppliers $suppliers,
                                Md\TransactionBuy $transactionBuy
                               )
    {
        $this->model            = $table;
        $this->suppliers        = $suppliers;
        $this->transactionBuy   = $transactionBuy;
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

    public function postStoreTransaction(Request $request){
        $input = $request->only('idItemPart','qty','priceBuy');
        $arrayData = [];
        $insert['item_id']       = explode(",", $input['idItemPart']);
        $insert['qty']           = explode(",", $input['qty']);
        $insert['price_buy']     = explode(",", $input['priceBuy']);
        $insert['expedition']    = "-";

        $dataAct = array(
            array('item_id'=>1,'price_buy'=>34397, 'qty'=>97, 'expedition' => 'KLJKLSD')
            //...
        );


        $data = $this->transactionBuy->create($arrayData);
        return $data;
    }

}
