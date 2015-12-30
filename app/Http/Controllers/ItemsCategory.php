<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as Md;
use App\Additionals\Datatables\ItemsCategoryDatatable;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ItemsCategoryForm;
use App\Http\Requests\ItemsCategoryRequest;

class ItemsCategory extends Controller
{
  protected $model;
  protected $title = "Data Kategori Barang";
  protected $url = "items-category";
  protected $folder = "module.items-category";
  protected $form;

  public function __construct(Md\ItemsCategory $table)
  {
      $this->model    = $table;
      $this->form     = ItemsCategoryForm::class;
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

  public function postStore(ItemsCategoryRequest $request=null, $id="")
  {
      $input = $request->except('save_continue');
      $result = '';

      if($id == "" ) :
          $query = $this->model->create($input);
          $result = $query->id;
      else :
          $this->model->find($id)->update($input);
          $result = $id;
      endif;

      $save_continue = \Input::get('save_continue');
      $redirect = empty($save_continue)?$this->url:$this->url.'/edit/'.$result;

      return redirect($redirect)->with('message','Berhasil tambah data group!');
  }

  public function getEdit(FormBuilder $formBuilder=null, $id="")
  {
      if ($id=="" || is_null($formBuilder)) return redirect($this->url);

      $edit = $this->model->find($id);

      $form = $formBuilder->create($this->form,[
          'method' => 'POST',
          'url' => $this->url.'/store/'.$id,
          'model' => $edit
      ]);

      return view($this->folder.'.form', ['title' => $this->title,
                                          'form' => $form,
                                          'breadcrumb' => 'edit-'.$this->url]);
  }

  public  function  getDelete($id ="")
  {
      if($id=="") return redirect($this->url);

      $groups = $this->model->find($id);

      $groups->delete();

      return redirect($this->url)->with('message','Berhasil hapus data group!');

  }

  public function getData(Request $request){
      return (new ItemsCategoryDatatable($this->model))->make();
  }
}
