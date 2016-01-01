<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as Md;
use App\Additionals\Datatables\ItemsDatatable;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ItemsForm;
use App\Http\Requests\ItemsRequest;

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
        $this->form          = ItemsForm::class;
    }

    public function getIndex()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;
        return view($this->folder.'.index', $data);
    }

    public function getCreate(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create($this->form, [
            'method' => 'POST',
            'url' => $this->url.'/store'
        ]);

        return view($this->folder.'.form', ['title' => $this->title,
                                            'form' => $form,
                                            'breadcrumb' => 'new-'.$this->url]);
    }

    public function postStore(ItemsRequest $request, $id = ""){
        $input = $request->except('save_continue');
        $inputItem['name_items']    = $input['name_items'];
        $inputItem['category_id']   = $input['category_id'];
        $inputItem['supplier_id']   = $input['supplier_id'];

        if($id == "" ) :
            /*
            * Create News Item
            */
            $query = $this->model->create($inputItem);
            $resultId = $query->id;

            /*
            * Create News Item Detail 
            */
            $inputItemDetail['stok']    = $input['stok'];
            $inputItemDetail['note']    = $input['note'];
            $inputItemDetail['item_id'] = $resultId;
            $this->modelDetail->create($inputItemDetail);
 
            /*
            * Create News Item Price 
            */
            $inputItemPrice['price_buy']        = $input['price_buy'];
            $inputItemPrice['price_selling']    = $input['price_selling'];
            $inputItemPrice['item_id']          = $resultId;
            $this->modelPrice->create($inputItemPrice);

        else :
            $this->model->find($id)->update($inputItem);
            $resultId = $id;

            /*
            * Create News Item Detail 
            */
            $this->modelDetail->where('item_id',$resultId)->delete();

            $inputItemDetail['stok']    = $input['stok'];
            $inputItemDetail['note']    = $input['note'];
            $inputItemDetail['item_id'] = $resultId;
            $this->modelDetail->create($inputItemDetail);
 
            /*
            * Create News Item Price 
            */
            $this->modelPrice->where('item_id',$resultId)->delete();
            
            $inputItemPrice['price_buy']        = $input['price_buy'];
            $inputItemPrice['price_selling']    = $input['price_selling'];
            $inputItemPrice['item_id']          = $resultId;
            $this->modelPrice->create($inputItemPrice);
        endif;

        $save_continue = \Input::get('save_continue');
        $redirect = empty($save_continue)?$this->url:$this->url.'/edit/'.$resultId;

        return redirect($redirect)->with('message','Berhasil tambah data group!');
    }

    public function getEdit(FormBuilder $formBuilder=null, $id="")
    {
        if ($id=="" || is_null($formBuilder)) return redirect($this->url);

        $edit = $this->model->with(['detail','price','supplier'])->find($id);;

        $form = $formBuilder
            ->create($this->form)
            ->setFormOptions([
                'method' => 'POST',
                'files' => true,
                'url' => $this->url.'/store/'.$id
            ]);

        return view($this->folder.'.form', ['title' => $this->title, 
                                            'form' => $form, 
                                            'row' => $edit,
                                            'breadcrumb' => 'edit-'.$this->url]); 
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
