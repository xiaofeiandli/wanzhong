<?php
namespace common\base;

use Yii;

class Verification
{
    public static function verifyLogin($encrypted_token = null,$is_qrcode = false)
    {
        if (!$encrypted_token) return false;
        $m = new Encrypt(Yii::$app->params['encrypt_key']);
        $token = json_decode($m->decode($encrypted_token), true);
        if (!isset($token['uid'])) {
            return false;
        }
        if(!$is_qrcode){
            if (time() > $token['expiretime']) {
                return false;
            }
        }
        return $token['uid'];
    }
}