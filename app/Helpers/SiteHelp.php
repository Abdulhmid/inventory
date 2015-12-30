<?php

use App\Models as Md;

class SiteHelp {

    public static function site_list() {
    	return Md\Site::orderBy('name', 'asc')->groupBy('site.name', 'site.site_id')->get();
    }

}