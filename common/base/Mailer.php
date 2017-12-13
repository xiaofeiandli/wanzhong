<?php
namespace common\base;

use Yii;

class Mailer
{
    public static function sendEmail($account, $msg, $path='')
    {

        $mail= Yii::$app->mailer->compose();
        $mail->setTo($account);
        $mail->setSubject("本邮件为自动发送，请勿回复");
        $mailbody = $msg;
        $mail->setHtmlBody($mailbody);
        if(!empty($path)){
            $mail->attach($path);
        }
        if ($mail->send()){
            return true;
        }else{
            return false;
        }
    }
}