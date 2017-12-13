<?php
namespace wap\controllers;

use Yii;
use yii\imagine\Image;
use yii\imagine\Image\ManipulatorInterface;
use frontend\models\Resource;
use frontend\models\Navigator;


/**
 * 资源管理
 */
class ResourceController extends BaseController
{

    public function actionDownload()
    {
        $type = Yii::$app->request->get('type','image');
        $ids = Yii::$app->request->get('ids');//id拼接的字符串，用英文逗号隔开
        if(!isset($ids)||!is_array(explode(',',$ids))||!in_array($type, ['image','pdf'])){
            if($this->language=='en'){
                $this->renderJson(999, [], 'Wrong parameters');
            }else{
                $this->renderJson(999, [], '参数有误');
            }
        }
        if($this->language=='en'){
            $zip_name = $type == 'image' ? 'GFM2017_high_resolution_image.zip' : 'GFM2017_files.zip';
        }else{
            $zip_name = $type == 'image' ? '未来出行高清图片.zip' : '未来出行文档.zip';
        }
        $resource_model = new Resource();
        $download = $resource_model->getResourceByIds(explode(',',$ids),$type);
        if(!$download){
            if($this->language=='en'){
                $this->renderJson(999, [], 'Fail to access');
            }else{
                $this->renderJson(999, [], '资源获取失败');
            }
        }
        $tmp_path = Yii::$app->params['upload_dir'].'zip/'.$type.'_'.str_replace(',', '_', $ids).'/';
        $filename = $tmp_path . $zip_name;
        if(!is_dir($tmp_path)){//检测是否为目录
            if(!mkdir($tmp_path,0777,true)){//没有创建成功
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Fail to pack');
                }else{
                    $this->renderJson(999, [], '打包失败');
                }
            }else{
                if(!file_exists($filename)){
                    $zip = new \ZipArchive();
                    $zip->open($filename, $zip::CREATE | $zip::OVERWRITE);
                    foreach ($download as $dk=>$dv){
                        $url_array = explode('.',$dv['url']);
                        $ext = end($url_array);
                        $zip->addFile($dv['url'],$dv['name'].'.'.$ext);
                    }
                }
            }
        }else{
            if(!is_writeable($tmp_path)){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Fail to pack');
                }else{
                    $this->renderJson(999, [], '打包失败');
                }
            }else{
                if(!file_exists($filename)){
                    $zip = new \ZipArchive();
                    $zip->open($filename, $zip::CREATE | $zip::OVERWRITE);
                    foreach ($download as $dk=>$dv){
                        $url_array = explode('.',$dv['url']);
                        $ext = end($url_array);
                        $zip->addFile($dv['url'],$dv['name'].'.'.$ext);
                    }
                }
            }
        }
        $this->renderJson(0, ['zip_path'=>str_replace(Yii::$app->params['upload_dir'], Yii::$app->params['img_domain'], $filename)], 'OK');
    }
}
