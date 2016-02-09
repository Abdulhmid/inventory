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
        Md\TransactionSell $transactionSell
    )
    {
        $this->model         = $table;
        $this->transactionSell   = $transactionSell;
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
        return $this->transactionSell->with('item')->where('key_transaction', $term)->get()->toArray();
    } 


}
