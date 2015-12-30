<?php

namespace App\Library\Breadcrumb;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class Breadcrumb {

    static private $array = [];

    public function __construct() {
        self::build();
    }

    static public function set($last_segment = 0) {
        
    }

    static public function render($params = []) {

        $html = '';

        /** Rendering breadcrumb show */
        if (!empty($params)) {
            foreach ($params as $j => $i) {

                /** Prepping data */
                $r = explode(':', $i);

                /** Rendering breadcrumb list */
                if (!empty(self::$array)) {
                    foreach (self::$array as $k => $v) {
                        if ($k == $r[0]) {
                            if ($j == count($params) - 1) {
                                $html .= '<li><a class="acitve-pages" >' . $v['title'] . '</a></li>';
                            } else {
                                if (key_exists(1, $r)) {
                                    $html .= '<li><a href="' . $v['url'] . '/' . $r[1] . '" >' . $v['title'] . '</a></li>';
                                } else {
                                    $html .= '<li><a href="' . $v['url'] . '" >' . $v['title'] . '</a></li>';
                                }
                            }
                        }
                    }
                }
            }
        }


        $html .= '';

        return $html;
    }

    static private function build() {

        self::$array = [
            'dashboard' => [
                'url' => URL::to('partner'),
                'title' => 'Dashboard',
            ],
            /** users  */
            'users' => [
                'url' => URL::to('users'),
                'title' => "User",
            ],
            'new-users' => [
                'url' => URL::to('users/create'),
                'title' => "Buat Data Users Baru",
            ],
            'edit-users' => [
                'url' => URL::to('users/create'),
                'title' => "Perbarui Data Users",
            ],
            
             /** My Profile  */
            'myprofile' => [
                'url' => URL::to('myprofile'),
                'title' => "Data Diri",
            ],

            /** Module  */
            'module' => [
                'url' => URL::to('module'),
                'title' => "Modul",
            ],
            'new-module' => [
                'url' => URL::to('module/create'),
                'title' => "Create New Module",
            ],
            'edit-module' => [
                'url' => URL::to('module/create'),
                'title' => "Edit Module",
            ],

            /** Module Access  */
            'module_access' => [
                'url' => URL::to('module_access'),
                'title' => "Setting Modul Access",
            ],

            /** Module  */
            'groups' => [
                'url' => URL::to('groups'),
                'title' => "Group",
            ],
            'new-groups' => [
                'url' => URL::to('groups/create'),
                'title' => "Buat Data Group Baru",
            ],
            'edit-groups' => [
                'url' => URL::to('groups/create'),
                'title' => "Perbarui Data Group",
            ],


            /** Module  */
            'admin' => [
                'url' => URL::to('admin'),
                'title' => "Groups",
            ],
            'new-admin' => [
                'url' => URL::to('admin/create'),
                'title' => "Create New Admin",
            ],
            'edit-admin' => [
                'url' => URL::to('admin/create'),
                'title' => "Edit Admin",
            ],
            'profil-admin' => [
                'url' => URL::to('myprofile'),
                'title' => "Data Diri",
            ],

            /** Province  */
            'province' => [
                'url' => URL::to('province'),
                'title' => "Province",
            ],
            'new-province' => [
                'url' => URL::to('province/create'),
                'title' => "Create New Province",
            ],
            'edit-province' => [
                'url' => URL::to('province/create'),
                'title' => "Edit Province",
            ],

            /** Province  */
            'city' => [
                'url' => URL::to('city'),
                'title' => "City",
            ],
            'new-city' => [
                'url' => URL::to('city/create'),
                'title' => "Create New City",
            ],
            'edit-city' => [
                'url' => URL::to('city/create'),
                'title' => "Edit City",
            ],

            /** Module  */
            'module_access' => [
                'url' => URL::to('module_access'),
                'title' => "Setting ACL",
            ],

            /** area  */
            'areas' => [
                'url' => URL::to('areas'),
                'title' => "Area",
            ],
            'new-areas' => [
                'url' => URL::to('areas/create'),
                'title' => "Buat Data Area Baru",
            ],
            'edit-areas' => [
                'url' => URL::to('areas/create'),
                'title' => "Perbarui Data Area",
            ],

            /** locations  */
            'locations' => [
                'url' => URL::to('locations'),
                'title' => "Buat Data Lokasi Baru",
            ],
            'new-locations' => [
                'url' => URL::to('areas/create'),
                'title' => "Tambah Lokasi",
            ],
            'edit-locations' => [
                'url' => URL::to('areas/create'),
                'title' => "Perbarui Data Lokasi",
            ],

            /** machines  */
            'machine' => [
                'url' => URL::to('machine'),
                'title' => "Buat Data Mesin Baru",
            ],
            'new-machine' => [
                'url' => URL::to('machines/create'),
                'title' => "Tambah Mesin",
            ],
            'edit-machine' => [
                'url' => URL::to('machine/create'),
                'title' => "Perbarui Data Mesin",
            ],


            
        ];
    }

}

?>
