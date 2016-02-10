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

    public function __construct(
        M\Users $users,
        M\Items $items,
        M\TransactionSell $transactionSell
    )
    {
        $this->users = $users;
        $this->items = $items;
        $this->transactionSell = $transactionSell;
    }

    public function getIndex()
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = 'Dashboard';
        return view($this->viewFolder . '.index', $data);
    }

    public function getCountItems()
    {
 
        $total = $this->items->count();

        return response()->json($total);
    }

    public function getCountAsset()
    {
 
        $total = $this->items
                      ->join('items_detail','items_detail.item_id','=','items.id')
                      ->join('items_price','items_price.item_id','=','items.id')
                      ->select(\DB::RAW('sum(items_detail.stok * items_price.price_selling) AS total'))
                      ->get();

        return response()->json($total[0]['total']);
    }

    public function getCountIncome()
    {
 
        $total = $this->transactionSell
                      ->select(\DB::RAW('sum(qty * price_sell) AS total'))
                      ->get();

        return response()->json($total[0]['total']);
    }

    public function getChart($from, $to, $year)
    {
        $result = [];
        $result['data'] = [];
        $result['months'] = [];

        $result['data'] = [];

        $arrayTotal = [];

        for ($from; $from <= $to; $from++) {
            $month = \GLobalHelp::nameMonth($from);

            array_push($result['months'], $month);
            $total = $this->transactionSell
                      ->whereMonth('created_at', '=', $from)
                      ->whereYear('created_at', '=',$year)
                      ->select(\DB::RAW('sum(qty * price_sell) AS total'))
                      ->get();

            array_push($arrayTotal, (int)$total[0]['total']);
        }
        array_push($result['data'], ['name' => 'Income', 'data' => $arrayTotal]);

        return $result;
    }

}
