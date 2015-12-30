<?php

use App\Models as Md;

class EncryptHelp {

    function encrypt($decrypted, $password) {
        $mode = \MCRYPT_MODE_ECB;
        $cipher = \MCRYPT_RIJNDAEL_128;
        $IV = mcrypt_create_iv(mcrypt_get_iv_size($cipher, $mode), \MCRYPT_RAND);
        return \trim(\base64_encode(\mcrypt_encrypt(\MCRYPT_RIJNDAEL_128, $password, $decrypted, $mode, $IV)));
    }

    function decrypt($encrypted, $password) {
        $mode = \MCRYPT_MODE_ECB;
        $cipher = \MCRYPT_RIJNDAEL_128;
        $IV = mcrypt_create_iv(mcrypt_get_iv_size($cipher, $mode), \MCRYPT_RAND);
        return \trim(\mcrypt_decrypt(\MCRYPT_RIJNDAEL_128, $password, \base64_decode($encrypted), $mode, $IV));
    }

}