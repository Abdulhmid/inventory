<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as Md;
use App\Additionals\Datatables\HistoryBuyDatatable;

class Buying extends Controller
{

    protected $model;
    protected $title = "Transaksi Pembelian Barang";
    protected $url = "buy";
    protected $folder = "module.buy";
    protected $form;

    public function __construct(
        Md\Items $table,
        Md\ItemDetail $itemDetail,
        Md\ItemPrice $itemPrice,
        Md\Suppliers $suppliers,
        Md\TransactionBuy $transactionBuy
    )
    {
        $this->model            = $table;
        $this->itemDetail       = $itemDetail;
        $this->itemPrice        = $itemPrice;
        $this->suppliers        = $suppliers;
        $this->transactionBuy   = $transactionBuy;
    }

    public function getIndex()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.index', $data);
    }

    public function getHistory()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.history', $data);
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
            $keyTrans = \Uuid::generate();
            for ($i=0; $i < count($itemId) ; $i++) { 
                /* Update Stok */
                    $this->updateStok($itemId[$i], $qty[$i]);

                /* Update Price */
                    $this->updatePrice($itemId[$i], $priceBuy[$i]);

                /* Update Price */
                    $this->updatePriceSell($itemId[$i], $priceBuy[$i]);

                $insert['item_id'] = $itemId[$i] ;
                $insert['qty'] = $qty[$i] ;
                $insert['price_buy'] = $priceBuy[$i] ;
                $insert['expedition'] = "-";
                $insert['created_at'] = \Carbon\Carbon::now();
                $insert['updated_at'] = \Carbon\Carbon::now();
                $insert['key_transaction'] = $keyTrans;
                array_push($arrayData, $insert);
            }

            $data = $this->transactionBuy->insert($arrayData);
            return $keyTrans;            
        } catch (Exception $e) {
            return "0";
        }

    }

    private function updateStok($itemId, $stok){
        $query = $this->itemDetail->where(['item_id' => $itemId]);
        $input['stok'] = $query->first()->stok + $stok;
        $query->update($input);
    }

    private function updatePrice($itemId, $price){
        $query = $this->itemPrice->where(['item_id' => $itemId]);
        $input['price_buy'] = $price;
        $query->update($input);
    }

    private function updatePriceSell($itemId, $price){
        $query = $this->itemPrice->where(['item_id' => $itemId]);
        $priceSell = $price + ((50/100) * $price) ;
        $input['price_selling'] = $priceSell;
        $query->update($input);
    }

    /*
    ** Nota Pembelian
    */

    public function getNota($keyTrans = ""){
        $data['dataQuery'] = $this->transactionBuy->with('item')->where(['key_transaction' => $keyTrans])->get();
        $data['keyTrans'] = $keyTrans;
        $pdf = \PDF::loadView($this->folder.'.nota', $data);
        return $pdf->stream('invoiceoioiio.pdf');
    }

    public function getData(Request $request){
        return (new HistoryBuyDatatable($this->transactionBuy))->make();
    }

}
