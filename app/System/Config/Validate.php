<?php
namespace App\System\Config;

use App\System\Helpers\Encrypt;

trait Validate {


    public function systemValidate(){ 
        if (flashCode(Encrypt::encrypt(config('principal._iden'), config('principal._iden'))) == config('principal.hash')) {
            return true;
        }
    }


}