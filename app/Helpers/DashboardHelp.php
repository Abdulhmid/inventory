<?php

use App\Models as Md;

class DashboardHelp {

    public static function partner($parameter="") {
    	$from	= \Carbon\Carbon::now()->modify('-3 month');
    	$to		= \Carbon\Carbon::now();   

    	if($parameter == "")
    		return Md\Partners::where('status','active')->count();

    	if($parameter == "trial")
    		return Md\Partners::where(function($query) use ($from, $to) {
                $query->where('status','active')
                      ->whereBetween('created_at', array($from, $to));
            })->count();

    	if($parameter == "active")
    		return Md\Partners::where(function($query) use ($from, $to){
                $query->where('status','active')
                      ->whereBetween('created_at', array($from, $to))
                      ->Where('created_at', '<=' ,$from);
            })->count();

    }

    public static function location($parameter = ""){
    	if($parameter == "")
    		return Md\Site::count();

    	if($parameter != "")
			return Md\Site::where('category', $parameter)->count();    		
    }

    public static function device($parameter = ""){
    	$from	= \Carbon\Carbon::now()->modify('-3 month');
    	$to		= \Carbon\Carbon::now();   

    	if($parameter == "")
    		return Md\Device::count();

    	if($parameter == "trial")
    		return Md\Device::where(function($query) use ($from, $to) {
                $query->whereBetween('created_at', array($from, $to));
            })->count();

    	if($parameter == "active")
    		return Md\Device::where(function($query) use ($from, $to){
                $query->whereBetween('created_at', array($from, $to))
                      ->Where('created_at', '<=' ,$from);
            })->count();	
    }

    public static function users($parameter = ""){
    	if($parameter == "")
    		return Md\Users::count();

    	if($parameter == "cashier")
			return Md\Users::whereNull('finger_print')->count(); 

    	if($parameter == "attendance")
			return Md\Users::whereNotNull('finger_print')->count();    		
    }

}