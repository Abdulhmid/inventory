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
        
        try {
            $arrayData = [];
            $itemId       = explode(",", $input['idItemPart']);
            $qty           = explode(",", $input['qty']);
            $priceBuy     = explode(",", $input['priceBuy']);

            for ($i=0; $i < count($itemId) ; $i++) { 
                $insert['item_id'] = $itemId[$i] ;
                $insert['qty'] = $qty[$i] ;
                $insert['price_buy'] = $priceBuy[$i] ;
                $insert['expedition'] = "-";
                $insert['created_at'] = \Carbon\Carbon::now();
                $insert['updated_at'] = \Carbon\Carbon::now();
                array_push($arrayData, $insert);
            }

            $data = $this->transactionBuy->insert($arrayData);
            return "1";            
        } catch (Exception $e) {
            return "0";
        }

    }

}
