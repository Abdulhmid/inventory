<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as Md;
use App\Additionals\Datatables\UsersDatatable;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\UsersForm;
use App\Http\Requests\UsersRequest;

class Users extends Controller
{
    protected $model;
    protected $title = "Data Pengguna";
    protected $url = "users";
    protected $folder = "module.users";
    protected $form;

    public function __construct(Md\Users $users)
    {
        $this->model    = $users;
        $this->form     = UsersForm::class;
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

    public function postStore(UsersRequest $request=null, $id="")
    {
        $input = $request->except('save_continue','password_confirmation');
        $result = '';

        if( \Input::hasFile('photo'))
            $photo  = (new \ImageUpload($input))->upload();

        if($id == "" ) :
            $input['id'] = \Uuid::generate();
            $input['photo'] = isset($photo) ? $photo : "" ;
            $input['password']      = bcrypt($input['password']);
            $query = $this->model->create($input);
            $result = $query->id;
        else :
            if(\Input::hasFile('photo'))
                $input['photo'] = isset($photo) ? $photo : "";
            if(isset($input['password']) && $input['password'] != "")
                $input['password'] = bcrypt($input['password']);

            $this->model->find($id)->update($input);
            $result = $id;
        endif;

        $save_continue = \Input::get('save_continue');
        $redirect = empty($save_continue)?$this->url:$this->url.'/edit/'.$result;

        return redirect($redirect)->with('message','Berhasil tambah data Pengguna!');
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
                                            'row' => $edit,
                                            'form' => $form,
                                            'breadcrumb' => 'edit-'.$this->url]);
    }

    public  function  getDelete($id ="")
    {
        if($id=="") return redirect($this->url);

        $this->model->find($id)->delete();

        return redirect($this->url)->with('message','Berhasil hapus data Pengguna!');

    }

    public function getMyProfil(){
        $dataProfil = $this->model->find(\Auth::user()->id);
        return view($this->folder.'.profil', [
            'title' => "Edit My Profil",
            'row' => $dataProfil,
            'breadcrumb' => 'profil-'.$this->url
        ]);
    }

    public function postStoreProfil($id, Request $request){

        $input = $request->all();
        $rules = array(
            'name'=>'required',
            'photo'=>'',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6'
        );

        if( \Input::hasFile('photo'))
            $photo  = (new \ImageUpload($input))->upload();


        $validator = \Validator::make(\Request::all(), $rules);
        if ($validator->passes()) {
            $data = [
                'name' => $input['name']
            ];

            if(!empty($input['password'])) {
                $data = [
                    'password' => bcrypt($input['password'])
                ];
            }

            if(\Input::hasFile('photo'))
                $data = [
                    'photo' => isset($photo) ? $photo : ""
                ];  $this->model->find($id)->update($data);

            return \Redirect::back()->with('message','Sukses Ubah Data Profil!')
                                    ->withInput(\Input::all());
        }else{
            return redirect($this->url."/my-profil")->withErrors($validator);
        }

    }

    public function getData(Request $request){
        return (new UsersDatatable($this->model))->make();
    }

}
