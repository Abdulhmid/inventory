<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as Md;
use App\Additionals\Datatables\HistorySellDatatable;

class Selling extends Controller
{
 
    protected $model;
    protected $title = "Transaksi Penjualan Barang";
    protected $url = "selling";
    protected $folder = "module.sell";
    protected $form;

    public function __construct(
        Md\Items $table,
        Md\ItemDetail $itemDetail,
        Md\ItemPrice $itemPrice,
        Md\Suppliers $suppliers,
        Md\TransactionSell $transactionSell
    )
    {
        $this->model         = $table;
        $this->itemDetail       = $itemDetail;
        $this->itemPrice        = $itemPrice;
        $this->suppliers        = $suppliers;
        $this->transactionSell   = $transactionSell;
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
        return json_encode($this->model->with(['supplier','detail','price'])
                                ->where('name_items', 'like', '%'.$term.'%')
                                ->get()->toArray());
    }

    public function postStoreTransaction(Request $request){
<<<<<<< HEAD
        $input = $request->only('idItemPart','qty','priceBuy');
=======
        $input = $request->only('idItemPart','qty','priceSell');
>>>>>>> 7cfda010d8cd54b250b9a3c6fc242a9e33f9ce74
        
        try {
            $arrayData = [];
            $itemId       = explode(",", $input['idItemPart']);
            $qty           = explode(",", $input['qty']);
<<<<<<< HEAD
            $priceBuy     = explode(",", $input['priceBuy']);
=======
            $priceSell     = explode(",", $input['priceSell']);
>>>>>>> 7cfda010d8cd54b250b9a3c6fc242a9e33f9ce74
            $keyTrans = \Uuid::generate();
            for ($i=0; $i < count($itemId) ; $i++) { 
                /* Update Stok */
                    $this->updateStok($itemId[$i], $qty[$i]);

<<<<<<< HEAD
                /* Update Price */
                    $this->updatePrice($itemId[$i], $priceBuy[$i]);

                /* Update Price */
                    $this->updatePriceSell($itemId[$i], $priceBuy[$i]);

                $insert['item_id'] = $itemId[$i] ;
                $insert['qty'] = $qty[$i] ;
                $insert['price_buy'] = $priceBuy[$i] ;
=======
                $insert['item_id'] = $itemId[$i] ;
                $insert['qty'] = $qty[$i] ;
                $insert['price_sell'] = $priceSell[$i] ;
>>>>>>> 7cfda010d8cd54b250b9a3c6fc242a9e33f9ce74
                $insert['expedition'] = "-";
                $insert['created_at'] = \Carbon\Carbon::now();
                $insert['updated_at'] = \Carbon\Carbon::now();
                $insert['key_transaction'] = $keyTrans;
                array_push($arrayData, $insert);
            }

<<<<<<< HEAD
            $data = $this->transactionBuy->insert($arrayData);
=======
            $data = $this->transactionSell->insert($arrayData);
>>>>>>> 7cfda010d8cd54b250b9a3c6fc242a9e33f9ce74
            return $keyTrans;            
        } catch (Exception $e) {
            return "0";
        }

    }

<<<<<<< HEAD
=======
    private function updateStok($itemId, $stok){
        $query = $this->itemDetail->where(['item_id' => $itemId]);
        $input['stok'] = ($query->first()->stok) - $stok;
        $query->update($input);
    }

>>>>>>> 7cfda010d8cd54b250b9a3c6fc242a9e33f9ce74
    /*
    ** Nota Penjualan
    */

    public function getNota($keyTrans = ""){
        $data['dataQuery'] = $this->transactionSell->with('item')->where(['key_transaction' => $keyTrans])->get();
        $data['keyTrans'] = $keyTrans;
        $pdf = \PDF::loadView($this->folder.'.nota', $data);
        return $pdf->stream('invoiceoioiio.pdf');
    }

    public function getData(Request $request){
        return (new HistorySellDatatable($this->transactionSell))->make();
    }


}
