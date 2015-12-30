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
                                Md\ItemDetail $tableDetail,
                                Md\ItemPrice $tablePrice,
                                Md\Suppliers $suppliers,
                                Md\ItemsCategory $tableCategory)
    {
        $this->model         = $table;
        $this->modelDetail   = $tableDetail;
        $this->modelPrice    = $tablePrice;
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

    public function postStore(Request $request, $id = ""){
        $rules = Md\Items::$rules;
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $input = $request->except('save_continue');
        $inputItem['name_items']    = $input['name_item'];
        $inputItem['category_id']   = $input['category_id'];
        $inputItem['supplier_id']   = $input['supplier_id'];

        if($id == "" ) :
            // Create News Items 
            $query = $this->model->create($inputItem);
            $resultId = $query->id;

            // Create News Detail
            $inputItemDetail['stok']    = $input['stok'];
            $inputItemDetail['note']    = $input['note'];
            $inputItemDetail['item_id'] = $resultId;
            $this->modelDetail->create($inputItemDetail);

            // Create News Price
            $inputItemPrice['price_buy']        = $input['price_buy'];
            $inputItemPrice['price_selling']    = $input['price_selling'];
            $inputItemPrice['item_id']          = $resultId;
            $this->modelPrice->create($inputItemPrice);

        else :
            $this->model->find($id)->update($inputItem);
            $resultId = $id;
        endif;

        $save_continue = \Input::get('save_continue');
        $redirect = empty($save_continue)?$this->url:$this->url.'/edit/'.$resultId;

        return redirect($redirect)->with('message','Berhasil tambah data group!');
    }

    public function getEdit($id="")
    {

    }

    public  function  getDelete($id ="")
    {
        if($id=="") return redirect($this->url);

        $query = $this->model->find($id);

        $query->delete();

        return redirect($this->url)->with('message','Data Berhasil Dihapus!');

    }

    public function getData(Request $request){
        return (new ItemsDatatable($this->model))->make();
    }

}
