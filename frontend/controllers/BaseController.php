<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\base\Encrypt;
use frontend\models\Navigator;
use frontend\models\Base;
use frontend\models\Category;

/**
 * 描述：基类控制器
 */
class BaseController extends Controller
{
    /**
     * 构造函数
     */
    public function init()
    {
        parent::init();
        $view = Yii::$app->view;
        //php判断客户端是否为手机
        $agent = $_SERVER['HTTP_USER_AGENT'];  
        if(strpos($agent,"NetFront") || strpos($agent,"iPhone") || strpos($agent,"MIDP-2.0") || strpos($agent,"Opera Mini") || strpos($agent,"UCWEB") || strpos($agent,"Android") || strpos($agent,"Windows CE") || strpos($agent,"SymbianOS")){
            header("Location:".Yii::$app->params['m_domain']);
        }
    }
    /**
     * 默认中文
     */
    public $language = '';
    /**
     * 加载布局文件
     */
    public $layout = 'common';

    /**
     * 防止csrf攻击
     */
    public $enableCsrfValidation = false;

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
     * 获取页面内容
     */
    public function getContents($flags=[],$language = '')
    {
        $base_model = new Base();
        return $base_model->getContents($flags,$this->language);
    }
}
