<?php
class Cipher {
    private $securekey;
    function __construct($textkey) {
        $this->securekey = hash('sha256',$textkey,TRUE);
    }
    function encrypt($input) {
        return base64_encode(mcrypt_encrypt(MCRYPT_DES, $this->securekey, $input, MCRYPT_MODE_ECB));
    }
    function decrypt($input) {
        return trim(mcrypt_decrypt(MCRYPT_DES, $this->securekey, base64_decode($input), MCRYPT_MODE_ECB));
    }
}
?>