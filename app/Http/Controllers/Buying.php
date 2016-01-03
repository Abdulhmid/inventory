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

    public function __construct(Md\Items $table
                               )
    {
        $this->model         = $table;
    }

    public function getIndex()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.index', $data);
    }

}
