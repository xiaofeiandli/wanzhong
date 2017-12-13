<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\base\Encrypt;
use common\base\Verification;
use backend\models\Manager;
use yii\imagine\Image;
use yii\imagine\Image\ManipulatorInterface;

/**
 * 描述：基类控制器
 */
class BaseController extends Controller
{
    /**
     * 加载布局文件
     */
    public $layout = 'common';

    /**
     * 防止csrf攻击
     */
    public $enableCsrfValidation = false;

    /**
     * 检测用户是否登录
     */
    public function isLogin()
    {
        $cookies = Yii::$app->request->cookies;
        if($cookies && $cookies->has('gfm')){
            $encrypted_token = $cookies->get('gfm');
        }else{
            $encrypted_token = Yii::$app->request->get('token');
        }
        $ret = Verification::verifyLogin($encrypted_token);
        return $ret;
    }

    /**
     * 格式化return json
     */
    final public function renderJson($code, $data = [], $message = 'OK', $status = 200)
    {
        Yii::$app->response->format = 'json';
        if (is_array($code)){
            $response = $code;
        }else{
            if(!is_numeric($code)){
                if(isset(Yii::$app->params['responseCode'][$code])){
                    if(empty($message)) $message = Yii::$app->params['responseCode'][$code][1];
                    $code = Yii::$app->params['responseCode'][$code][0];
                }else{
                    $code = 0;
                }
            }
            $response = array('code'=>$code);
            if(0 === $code){
                if(!empty($data)) $response['data'] = $data;
                $response['msg'] = $message;
            }else{
                if(null !== $data) $response['data'] = $data;
                if($message) $response['msg'] = $message;
            }
        }
        $status = intval($status);
        $response['status'] = $status;
        Yii::$app->response->setStatusCode($status);
        Yii::$app->response->data = $response;
        Yii::$app->response->send();
        Yii::$app->end();
    }
    

    /**
     * 生成token
     */
    public function makeToken($uid)
    {
        $m = new Encrypt(Yii::$app->params['encrypt_key']);
        $now = time();
        $token = array('uid' => $uid, 'timestamp' => $now, 'expiretime' => $now + 60*60*8);
        $data = $m->encode(json_encode($token));
        return $data;
    }
    /**
     * 查看用户权限
     */
    public function isOpen($mid)
    {
        $manager_model = new Manager();
        $res = $manager_model->getRole($mid);
        return $res;
    }
    /**
     * 压缩图片
     */
    public function getThumb($path,$width=334,$height=189)
    {
        $image_size = getimagesize($path);
        if(isset($image_size['mime'])&&in_array($image_size['mime'], ['image/jpg','image/png','image/jpeg','image/gif'])){
            $y = $image_size[1];
            $x = $image_size[0];
            $tmp_pic = Yii::$app->params['upload_dir'].'tmp_pic_'.md5(rand(0,1).time()).strrchr($path, '.');
            $tmp_pic_src = substr($path,0,strrpos($path,'/')).'/thumb_'.substr($path,strrpos($path,'/')-strlen($path)+1);
            if($x<($width/$height)*$y){
                if(Image::thumbnail($path, $width, ceil(($y/$x)*$width), \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET)->save($tmp_pic, ['quality' => 100])){
                //THUMBNAIL_INSET填充模式，THUMBNAIL_OUTBOUND裁剪模式
                    $res = $tmp_pic;
                }else{
                    $res = false;
                }
            }else{
                if(Image::thumbnail($path, ceil(($x/$y)*$height), $height, \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET)->save($tmp_pic, ['quality' => 100])){
                    $res = $tmp_pic;
                }else{
                    $res = false;
                }
            }
            if($res){
                if(Image::thumbnail($res, $width, $height, \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND)->save($tmp_pic_src, ['quality' => 100])){
                    $res = $tmp_pic_src;
                    unlink($tmp_pic);
                }else{
                    $res = false;
                }
            }
        }else{
            $res = false;
        }
        
        return $res;
    }
    /**
     * 等比例压缩图片
     */
    public function getEqualThumb($path,$width=334,$height=189)
    {
        $image_size = getimagesize($path);
        if(isset($image_size['mime'])&&in_array($image_size['mime'], ['image/jpg','image/png','image/jpeg','image/gif'])){
            $y = $image_size[1];
            $x = $image_size[0];
            $tmp_pic = Yii::$app->params['upload_dir'].'tmp_pic_'.md5(rand(0,1).time()).strrchr($path, '.');
            $tmp_pic_src = substr($path,0,strrpos($path,'/')).'/thumb_'.substr($path,strrpos($path,'/')-strlen($path)+1);
            if($x<($width/$height)*$y){
                if(Image::thumbnail($path, $width, ceil(($y/$x)*$width), \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET)->save($tmp_pic, ['quality' => 100])){
                //THUMBNAIL_INSET填充模式，THUMBNAIL_OUTBOUND裁剪模式
                    $res = $tmp_pic;
                }else{
                    $res = false;
                }
            }else{
                if(Image::thumbnail($path, ceil(($x/$y)*$height), $height, \Imagine\Image\ManipulatorInterface::THUMBNAIL_INSET)->save($tmp_pic, ['quality' => 100])){
                    $res = $tmp_pic;
                }else{
                    $res = false;
                }
            }
        }else{
            $res = false;
        }
        
        return $res;
    }
}
