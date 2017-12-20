<?php
namespace backend\controllers;

use Yii;
use yii\imagine\Image;
use yii\imagine\Image\ManipulatorInterface;
use backend\models\Resource;
use backend\models\Upload;


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
        $view->params['open'] = $this->isOpen($this->isLogin());
        $resource_model = new Resource();
        $pic_res = $resource_model->getPictures();
        $pdf_res = $resource_model->getDocuments();
        return $this->render('index',array('pictures'=>$pic_res,'pdf'=>$pdf_res,'isOpen'=>$this->isOpen($this->isLogin())));
    }
    /**
     * 资源上传
     */
    public function actionUpload()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        print_r($_POST);exit;
        $type = Yii::$app->request->post('type_name','image');
        if(!isset($_FILES['file'])){
            $this->renderJson(999, [], '网络异常');
        }elseif($type=='pdf'&&isset($_FILES['file']['type'])&&strpos($_FILES['file']['type'],'image')!==false){
            $this->renderJson(999, [], '上传资源与所选类型不匹配');
        }else{
            $file_name = 'file';
        }
        $name = Yii::$app->request->post('name','');
        $desc = Yii::$app->request->post('desc','');
        if(empty($name)){
            if($type=='pdf'){
                $this->renderJson(999, [], '中文名称为空');
            }elseif($type=='image'){
                if(isset($_FILES['file']['name'])&&!empty($_FILES['file']['name'])){
                    $name = substr($_FILES['file']['name'],0,strpos($_FILES['file']['name'],'.')).'_'.date("YmdHis",time());
                }else{
                    $this->renderJson(999, [], '网络异常');
                }
            }else{
                $this->renderJson(999, [], '网络异常');
            }
        }
        $resource_model = new Resource();
        if($type=='pdf'&&$resource_model->checkName($name)){
            $this->renderJson(999, [], '该中文名称已存在');
        }
        // 资源上传
        $upload_model = new Upload();
        if(!$upload_model->imgUploads($file_name,$type)){
            $this->renderJson(999, [], $upload_model->getErrorMessage());
        }elseif($type == 'image' && !getimagesize($upload_model->newPath)){
            $this->renderJson(999, [], '该图不是真实图片');
        }
        $path = str_replace(Yii::$app->params['upload_dir'],'',$upload_model->newPath);
        if($type == 'image'){
            $thumb = $this->getThumb($upload_model->newPath);
            if(!$thumb){
                $this->renderJson(999, [], '生成缩略图失败，请重试');
            }
            $thumb_path = str_replace(Yii::$app->params['upload_dir'],'',$thumb);
        }else{
            $thumb_path = '';
        }
        // 存库
        $save_res = $resource_model->savePic($path,$type,$name,$en_name,$thumb_path,$desc,$this->isLogin());
        if(!$save_res){
            $this->renderJson(999, [], '网络异常');
        }
        $this->renderJson(0, ['path'=>Yii::$app->params['img_domain'] . $path]);
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
