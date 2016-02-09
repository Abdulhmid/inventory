<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as Md;

class ReturnItems extends Controller
{

    protected $model;
    protected $title = "Return Pembelian Barang";
    protected $url = "return";
    protected $folder = "module.return";
    protected $form;

    public function __construct(
        Md\Items $table,
        Md\ItemDetail $itemDetail,
        Md\TransactionSell $transactionSell,
        Md\TransactionReturn $transactionReturn
    )
    {
        $this->model         = $table;
        $this->itemDetail         = $itemDetail;
        $this->transactionSell   = $transactionSell;
        $this->transactionReturn   = $transactionReturn;
    }

    public function getIndex()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.index', $data);
    }

    public function getSell()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.sell', $data);
    }

    public function getBuy()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.buy', $data);
    }

    public function getReturnFind(Request $request, $term = ""){
        return $this->transactionSell->with('item')
                    ->join('items_detail','items_detail.item_id','=','transaction_sell.item_id')
                    ->where('key_transaction', $term)->get()->toArray();
    } 

    public function getFindStock(Request $request, $term = ""){
        return $this->model->with(['detail','price'])->find($term);
    } 

    public function postStoreTransaction(Request $request){
        $input = $request->only('itemID','reason','qty');
        
        try {
            $arrayData = [];
            $itemId       = explode(",", $input['itemID']);
            $qty       = explode(",", $input['qty']);
            $keyTrans = \Uuid::generate();
            for ($i=0; $i < count($itemId) ; $i++) { 

                /* Update Stok */
                    $this->updateStok($itemId[$i], $qty[$i]);

                $insert['item_id'] = $itemId[$i] ;
                $insert['qty'] = $qty[$i] ;
                $insert['reason'] = $input['reason'];
                $insert['created_at'] = \Carbon\Carbon::now();
                $insert['updated_at'] = \Carbon\Carbon::now();
                $insert['key_transaction'] = $keyTrans;
                array_push($arrayData, $insert);
            }
            $data = $this->transactionReturn->insert($arrayData);
            return $keyTrans;            
        } catch (Exception $e) {
            return "0";
        }
    }

    public function getNota($keyTrans = ""){
        $data['dataQuery'] = $this->transactionReturn->with('item')->where(['key_transaction' => $keyTrans])->get();
        $data['keyTrans'] = $keyTrans;
        $pdf = \PDF::loadView($this->folder.'.nota', $data);
        return $pdf->stream('invoiceoioiio.pdf');
    }

    private function updateStok($itemId, $stok){
        $query = $this->itemDetail->where(['item_id' => $itemId]);
        $input['stok'] = ($query->first()->stok) - $stok;
        $query->update($input);
    }


}
