<?php

namespace App\Library\Breadcrumb;

use Illuminate\Support\Facades\Facade;

class BreadcrumbFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'breadcrumb';
    }

}

?>
