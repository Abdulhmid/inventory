<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models as M;

class Dashboard extends Controller
{

    protected $title = "Dashboard";
    protected $url = "/";
    protected $viewFolder = "module.dashboard";

    public function __construct(M\Users $users )
    {
        $this->users = $users;
    }

    public function getIndex()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = 'Dashboard';
        return view($this->viewFolder . '.index', $data);
    }

}
