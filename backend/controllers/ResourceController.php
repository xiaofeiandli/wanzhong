<?php
namespace backend\controllers;

use Yii;
use yii\imagine\Image;
use yii\imagine\Image\ManipulatorInterface;
use backend\models\Resource;
use backend\models\Upload;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;


/**
 * 资源管理
 */
class ResourceController extends BaseController
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        if(!$this->isLogin()){
            header('location:/site/login');
            exit;
        }
        $view = Yii::$app->view;
        $view->params['item'] = 'resource';
        $resource_model = new Resource();
        $pic_res = $resource_model->getPictures();
        $video_res = $resource_model->getVideo();
        $audio_res = $resource_model->getAudio();
        $type = Yii::$app->request->get('type','image');
        if(!in_array($type, ['image','video','audio'])){
            $type = 'image';
        }
        $view->params['type'] = $type;
        if(is_array($pic_res)&&count($pic_res)>0){
            foreach($pic_res as $k=>$v){
                $pic_res[$k]['path'] = $this->_qiniuDnToken($v['path']);
                $pic_res[$k]['thumb'] = $this->_qiniuDnToken($v['thumb']);
                $pic_res[$k]['description'] = substr($v['name'],0,strrpos($v['name'],'.'));
            }
        }
        if(is_array($video_res)&&count($video_res)>0){
            foreach($video_res as $k=>$v){
                $video_res[$k]['path'] = $this->_qiniuDnToken($v['path']);
                $video_res[$k]['thumb'] = $this->_qiniuDnToken($v['thumb']);
                $video_res[$k]['description'] = substr($v['name'],0,strrpos($v['name'],'.'));
            }
        }
        if(is_array($audio_res)&&count($audio_res)>0){
            foreach($audio_res as $k=>$v){
                $audio_res[$k]['path'] = $this->_qiniuDnToken($v['path']);
                $audio_res[$k]['thumb'] = $this->_qiniuDnToken($v['thumb']);
                $audio_res[$k]['description'] = substr($v['name'],0,strrpos($v['name'],'.'));
            }
        }
        $count['video'] = $resource_model->getVideoCount();
        $count['audio'] = $resource_model->getAudioCount();
        $count['pic'] = $resource_model->getPicCount();
        return $this->render('index',array('type'=>$type,'pictures'=>$pic_res,'video'=>$video_res,'audio'=>$audio_res,'count'=>$count));
    }
    /**
     * 资源上传
     */
    public function actionUpload()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $type = Yii::$app->request->post('type_name','image');
        if(!isset($_FILES['file'])){
            $this->renderJson(999, [], '网络异常');
        }
        if(!in_array($type, explode('/', $_FILES['file']['type']))){
            $this->renderJson(999, [], '分类选择或资源格式有误');
        }
        $name = Yii::$app->request->post('name','');
        $desc = Yii::$app->request->post('desc','');
        if(isset($_FILES['file']['name'])&&!empty($_FILES['file']['name'])){
            $key = substr($_FILES['file']['name'],0,strpos($_FILES['file']['name'],'.')).'_'.date("YmdHis",time());
        }
        $ext = substr($_FILES['file']['name'],strrpos($_FILES['file']['name'],'.'),strlen($_FILES['file']['name']));
        // 资源上传
        $path = $this->_qiniuUpload($_FILES['file']['tmp_name'],$key.$ext);
        // 存库
        $resource_model = new Resource();
        $save_res = $resource_model->savePic($path,$type,$name,$desc);
        if(!$save_res){
            $this->renderJson(999, [], '网络异常');
        }
        $this->renderJson(0, ['path'=>Yii::$app->params['img_domain'] . $path]);
    }

    //七牛上传
    public function _qiniuUpload($filePath,$key)
    {
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = Yii::$app->params['access_key'];
        $secretKey = Yii::$app->params['secret_key'];
        $bucket = Yii::$app->params['bucket'];
        
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);

        // 要上传文件的本地路径
        //$filePath = './php-logo.png';

        // 上传到七牛后保存的文件名
        //$key = 'my-php-logo.png';
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {print_r($err);exit;
            $this->renderJson(999, $err, '网络异常');
        } else {
            if(isset($ret['key'])){
                return $ret['key'];
            }else{
                $this->renderJson(999, $ret, '网络异常');
            }
        }
    }

    //七牛获取下载凭证
    public function _qiniuDnToken($baseUrl)
    {
        $accessKey = Yii::$app->params['access_key'];
        $secretKey = Yii::$app->params['secret_key'];

        // 构建Auth对象
        $auth = new Auth($accessKey, $secretKey);

        // 私有空间中的外链 http://<domain>/<file_key>
        //$baseUrl = 'http://if-pri.qiniudn.com/qiniu.png?imageView2/1/h/500';
        // 对链接进行签名
        $signedUrl = $auth->privateDownloadUrl($baseUrl);

        return $signedUrl;
    }

    /**
     * 删除资源
     */
    public function actionDelete()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $id = Yii::$app->request->post('id');
        if(!isset($id)){
            $this->renderJson(999, [], '参数有误');
        }
        $resource_model = new Resource();
        $del_res = $resource_model->delResource($id);
        if(!$del_res){
            $this->renderJson(999, [], '网络异常');
        }
        $this->renderJson(0, [], 'OK');
    }
}
