<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as Md;

class Items extends Controller
{

    protected $model;
    protected $title = "Data Barang";
    protected $url = "items";
    protected $folder = "module.items";
    protected $form;

    public function __construct(Md\Items $table)
    {
        $this->model    = $table;
    }

    public function getIndex()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.index', $data);
    }

    public function getCreate()
    {
      return view($this->folder.'.form', ['title' => $this->title,
                                          'breadcrumb' => 'new-'.$this->url]);
    }

}
