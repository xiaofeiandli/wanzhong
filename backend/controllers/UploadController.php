<?php
namespace backend\controllers;

use Yii;
use backend\models\Upload;


/**
 * 图片上传控制器
 * 作者：youweiyan<youweiyan@nengapp.com>
 */
class UploadController extends BaseController
{
    /**
     * 图片上传
     */
    public function actionPutfile()
    {
        if(!$this->isLogin()){
            $this->renderJson(999,[],'您的账号未登录');
        }else{
            //图片验证
            $upload_model = new Upload();
            if(is_array($_FILES)){
                foreach($_FILES as $key=>$value){
                    if(!$upload_model->imgUploads($key,'image','other')){
                        $this->renderJson(999,[],$upload_model->getErrorMessage());
                    }else{
                        //缩略
                        if(isset($_POST['cut'])&&$_POST['cut']==1){//固定长款缩略
                            $thumb = $this->getThumb($upload_model->newPath);
                            if($thumb){
                                unlink($upload_model->newPath);
                                $upload_model->newPath = $thumb;
                            }
                        }elseif(isset($_POST['cut'])&&$_POST['cut']==2){//等比例缩略
                            $thumb = $this->getEqualThumb($upload_model->newPath);
                            if($thumb){
                                unlink($upload_model->newPath);
                                $upload_model->newPath = $thumb;
                            }
                        }
                        $tmp_pic = str_replace(Yii::$app->params['upload_dir'],Yii::$app->params['img_domain'],$upload_model->newPath);
                        $this->renderJson(0,$tmp_pic,'OK');
                    }
                }
            }else{
                $this->renderJson(999,[],'网络异常');
            }
        }
    }
    public function actionPutdocument()
    {
        if(!$this->isLogin()){
            $this->renderJson(999,[],'您的账号未登录');
        }else{
            //图片验证
            if(!isset($_POST['fileurl'])){
                $_POST['fileurl'] = '';
            }
            if(!isset($_POST['fileext'])){
                $_POST['fileext'] = '';
            }
            if(!isset($_POST['version'])||$_POST['version']==''){
                $this->renderJson(999,[],'版本号不能为空');
            }
            $upload_model = new UploadPic();
            if(is_array($_FILES)){
                foreach($_FILES as $key=>$value){
                    if(!$upload_model->fileUploads($key,$_POST['fileext'],50,$_POST['fileurl'])){
                        $this->renderJson(999,[],$upload_model->getErrorMessage());
                    }else{
                        $tmp_pic = $upload_model->newPath;

                        $postdata['url'] = $tmp_pic;
                        $postdata['version'] = Yii::$app->request->post('version','');
                        $postdata['manager_id'] = $this->isLogin();
                        if(!isset($postdata['url'])||$postdata['url']==''){
                            $this->renderJson(999,[],'上传图片路径不能为空');
                        }else{
                            if(strstr($postdata['url'],Yii::$app->params['img_domain'])){
                                $postdata['url'] = str_replace(Yii::$app->params['img_domain'],'',$postdata['url']);
                            }
                        }
                        if($postdata['version']==''){
                            $this->renderJson(999,[],'版本号不能为空');
                        }
                        if($postdata['manager_id']==''){
                            $this->renderJson(999,[],'上传者不能为空');
                        }
                        if($_POST['fileext']=='bin'){
                            $firmware_model = new Firmware();
                            $add_res = $firmware_model->addFirmware($postdata);
                        }else{
                            $android_model = new Android();
                            $add_res = $android_model->addAndroid($postdata);
                        }
                        if($add_res){
                            $this->renderJson(0,['tmp_pic'=>$tmp_pic],'OK');
                        }else{
                            $this->renderJson(500,[],'Server Error');
                        }
                    }
                }
            }else{
                $this->renderJson(999,[],'网络异常');
            }
        }
    }

    public function actionIndex()
    {
        $data = $this->renderPartial('index');
        $this->renderJson(0, $data, 'OK');
    }
}