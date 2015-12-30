<?php

use App\Model;

class GLobalHelp {

    public static function url() {
        return explode('/', \Request::url());
    }

    public static function indexUrl() {
        return Request::segment(1);
    }

    public static function lastUrl() {
        return last(self::url());
    }

    public static function idUrlEdit() {
        return Request::segment(3);
    }

    public static function actionUrl()
    {
        return Request::segment(2);
    }

    public static function checkImage($pathImage, $user = true)
    {
        if (file_exists(public_path()."/".$pathImage) && !empty($pathImage))
        {
            return asset($pathImage);
        }
        else
        {
            if($user == true)
              return asset("/photo/not_found.gif");
            else
                return asset("/photo/noimage.png");
        }
    }

    public static function messages($msg = "", $error = false, $warning = false, $dissmiss = true) {
        $type = ((($error == true) ? 'danger' : (($warning == true) ? 'warning' : 'success')));
        $autoHide = ($dissmiss == true ? 'autohide' : '');
        $icon = ($warning == true ? "fa-warning" : "fa-info");

        return '<div class="no-print alert alert-dismissable ' . $autoHide . ' full-alert">
					<div class="callout callout-' . $type . '">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				    	<h4><i class="fa ' . $icon . '"></i> ' . $msg . '</h4>
					</div>
				  </div>';
    }

    public static function formatDate($date, $format = 'd F Y \a\t H:i') {
        return (!is_null($date)) ? (new DateTime($date))->format($format) : "-";
    }

    public static function encrypt($sData) {
        $id = (double) $sData * 432.234;
        return strtr(rtrim(base64_encode($id), '='), '+/', '-_');
    }

    public static function decrypt($sData) {
        $url = base64_decode(strtr($sData, '-_', '+/'));
        $id = (double) $url / 432.234;
        return intval($id);
    }

    public static function encrypt_decrypt_string($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    public static function convertDate($dataConvert, $format = "Y-m-d") {
        $date = date_create($dataConvert);

        return date_format($date, $format);
    }

    public static function idrFormat($number, $prefix = 0) {
        return !is_null($number) ? number_format($number, $prefix, ",", ".") : "-";
    }

    public static function twodigitNumberFormat($n){
       return sprintf("%02d", $n);
    }

    public static function urlPartner(){
        return "http://localhost:8000";
    }

    public static function currency($number) {
        return 'Rp '.number_format($number, 2, ',', '.');
    }

    public static function showCodeName($array) {
        $newarray = [];
        if (!is_array($array) && empty($array)) {
            return $newarray;
        }
        foreach($array as $key => $val) {
            $newarray[$key] = $key.' - '.$val;
        }
        return $newarray;
    }

}
