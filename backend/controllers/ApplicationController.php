<?php
namespace backend\controllers;

use Yii;
use yii\web\Cookie;
use common\base\Mailer;
use backend\models\Application;
use dosamigos\qrcode\QrCode;
use common\base\Verification;
use moonland\phpexcel\Excel;

/**
 * 报名管理
 */
class ApplicationController extends BaseController
{
    /**
     * 报名管理首页
     */
    public function actionIndex()
    {
        if(!$this->isLogin()){
            header('location:/site/login');
            exit;
        }
        $view = Yii::$app->view;
        $view->params['item'] = 'application';
        $view->params['open'] = $this->isOpen($this->isLogin());
        $type = Yii::$app->request->get('type',0);
        $page = Yii::$app->request->get('page',1);
        $getdata['name'] = Yii::$app->request->get('name','');
        $getdata['cellphone'] = Yii::$app->request->get('cellphone','');
        $getdata['signin_at'] = Yii::$app->request->get('signin_at','');
        $getdata['issearch'] = Yii::$app->request->get('issearch','');
        if(isset($getdata['issearch'])&&$getdata['issearch']=='yes'){
            $page = 1;
        }
        $application_model = new Application();
        
        $counts = $application_model->getEveryCounts();
        if($type!=3){
            $total = $application_model->getCounts($type,$getdata);
            $application = $application_model->getApplication($type,$page,$getdata);
        }else{
            if(isset($counts[3])){
                $total = intval($counts[3]);
            }else{
                $total = 0;
            }
            $application = $application_model->getScene($page);
        }
        $view->params['application_total'] = $total;
        $geturl = $_SERVER['QUERY_STRING']!=''?'?'.$_SERVER['QUERY_STRING']:'';
        if(isset($getdata['issearch'])&&$getdata['issearch']=='yes'){
            if(strpos($geturl,'issearch')!==false){
                $geturl = str_replace('&issearch=yes','',$geturl);
            }
        }
        if($page!=1&&($page-1)*10>=$total){
            header('location:/application/index/'.ceil($total/10));
            exit;
        }
        return $this->render('index',array('application'=>$application,'type'=>$type,'page'=>$page,'geturl'=>$geturl, 'total'=>$total,'counts'=>$counts,'isOpen'=>$this->isOpen($this->isLogin())));
    }
    /**
     * 报名详情
     */
    public function actionDetail()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $type = Yii::$app->request->get('type',0);
        $id = Yii::$app->request->get('id');
        if(!isset($id)){
            $this->renderJson(999, [], '网络异常');
        }
        $application_model = new Application();
        $detail_array = $application_model->getDetails($id);
        $moreList = $this->renderPartial('ajaxdetail', array('detail_array'=>$detail_array,'type'=>$type));
        $this->renderJson(0, $moreList, 'OK');
    }

    /**
     * 批量生成现场观众二维码
     */
    public function actionCreateqrcode()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $number = Yii::$app->request->post('number');
        if(!isset($number)||intval($number)<=0||intval($number)>50){
            $this->renderJson(999, [], '二维码个数输入有误，请输入1-50之间的数字');
        }
        //查询现场观众库中最后一个id，自增生成后面的20个
        $application_model = new Application();
        $last_id = $application_model->getLastSceneId();
        for($id=$w+1;$id<=$number+$w;$id++){
            QrCode::png($this->makeToken('scene_'.$id),Yii::$app->params['upload_dir'].'scene_qrcode/'.$id.'.png','L',4,2);
            //存库
            $save_scene_user = $application_model->saveSceneUser($id);
        }
        $this->renderJson(0, ['begin'=>$last_id+1], 'OK');
        
    }

    /**
     * 批量下载最新观众二维码
     */
    public function actionSceneqrcode()
    {
        $begin = Yii::$app->request->get('begin');
        $number = Yii::$app->request->get('number');
        if(!isset($number)||!isset($begin)){
            $this->renderJson(999, [], '网络异常');
        }
        $download = [];
        for($id=$begin;$id<=$number+$begin-1;$id++){
            $download[] = ['url'=>Yii::$app->params['img_domain'].'scene_qrcode/'.$id.'.png','name'=>'现场观众'.$id];
        }
        if(count($download)>0){
            //二维码打包下载
            ini_set('memory_limit','80M');
            $filename = Yii::$app->params['upload_dir'].md5(rand(0,1).time()).'_qrcode_tmp.zip';
            $zip = new \ZipArchive();
            $zip->open($filename, $zip::CREATE | $zip::OVERWRITE);
            foreach ($download as $dk=>$dv){
                $fileData = file_get_contents($dv['url']);
                $url_array = explode('.',$dv['url']);
                $ext = end($url_array);
                if ($fileData) {
                    $zip->addFromString($dv['name'].'.'.$ext, $fileData);
                }
            }
            $zip->close();
            $file = fopen($filename, "r");
            $end = $begin+$number-1;
            $zip_name = '现场观众'.$begin.'-'.$end.'报名二维码.zip';
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length: " . filesize($filename));
            Header("Content-Disposition: attachment; filename=".$zip_name);
            //$buffer = 1024; //一次只传输1024个字节的数据给客户端
            while (!feof($file)) {
                $file_data = fread($file, filesize($filename));//将文件读入内存
                echo $file_data;
            }
            fclose($file);
            unlink($filename); //删除临时文件
        }
    }

    /**
     * 生成二维码
     */
    public function actionQrcode() 
    { 
        $id = Yii::$app->request->get('id');
        if(!isset($id)){
            return false;
        }else{
            return QrCode::png($this->makeToken($id));
        }
    }
    /**
     * 扫描二维码接口
     */
    public function actionScan() 
    { 
        $token = Yii::$app->request->post('token');
        if(!isset($token)){
            $this->renderJson(999, [], '参数有误');
        }
        $application_model = new Application();
        $id = Verification::verifyLogin($token,true);
        if(isset($id)&&strstr($id,'scene_')!==false){
            $scene_id = str_replace('scene_', '', $id);
            $scene_data = $application_model->getSceneDetails($scene_id);
            if(isset($scene_data['id'])){
                if(isset($scene_data['signin_at'])&&$scene_data['signin_at']>0){
                    $scene_data['signin_at'] = date('Y-m-d H:i:s',intval($scene_data['signin_at']));
                    $this->renderJson(0, [$scene_data], '已签到');
                }else{
                    $update_res = $application_model->changeSceneSignin($scene_data['id']);
                    if($update_res){
                        $newdata = $application_model->getSceneDetails($scene_id);
                        $newdata['signin_at'] = date('Y-m-d H:i:s',intval($newdata['signin_at']));
                    }
                    $this->renderJson(0, [$newdata], 'OK');
                }
            }else{
                $this->renderJson(999, [], '二维码无效');
            }
        }
        if(isset($id)&&intval($id)>0&&strstr($id,'scene_')===false){
            if(Yii::$app->redis->get($id)){
                $data = Yii::$app->redis->get($id);
            }else{
                $data = $application_model->getDetails($id);
            }
            if(isset($data['id'])){
                if(isset($data['signin_at'])&&$data['signin_at']>0){
                    $data['signin_at'] = date('Y-m-d H:i:s',intval($data['signin_at']));
                    $this->renderJson(0, [$data], '已签到');
                }else{
                    $update_res = $application_model->changeSignin($data['id']);
                    if($update_res){
                        $newdata = $application_model->getDetails($id);
                        $newdata['signin_at'] = date('Y-m-d H:i:s',intval($newdata['signin_at']));
                        Yii::$app->redis->set($id,$newdata);
                    }
                    $this->renderJson(0, [$newdata], 'OK');
                }
            }else{
                $this->renderJson(999, [], '二维码无效');
            }
        }else{
            $this->renderJson(999, [], '二维码无效');
        }
    }
    /**
     * 重置redis
     */
    public function actionReredis() 
    { 
        $application_model = new Application();
        $data = $application_model->getApplicationForRedis();
        if($data&&isset($data[0]['id'])){
            foreach($data as $k=>$v){
                if(Yii::$app->redis->get($v['id'])){
                    Yii::$app->redis->delete($v['id']);
                }
                Yii::$app->redis->set($v['id'],$v);
            }
            foreach($data as $kk=>$vv){
                if(Yii::$app->redis->get($vv['id'])){
                    echo '<span style="color:green">编号'.$vv['id'].'导入成功！</span><br>';
                }else{
                    echo '<span style="color:red">编号'.$vv['id'].'导入失败！</span><br>';
                }
            }
        }
    }
    /**
     * 报名信息批量导出
     */
    public function actionExport() 
    {   
        $type = Yii::$app->request->get('type',0);
        if(!$this->isLogin()){
            if(isset($_SERVER["HTTP_REFERER"])&&strpos($_SERVER["HTTP_REFERER"],Yii::$app->params['domain'])!==false){
                $location = $_SERVER["HTTP_REFERER"];
            }else{
                $location = '/application/index/'.$type.'/1';
            }
            header('location:'.$location);
            exit;
        }
        if($type==1){
            $excel_name = '媒体';
        }elseif($type==2){
            $excel_name = '展商';
        }else{
            $excel_name = '个人';
        }
        $application_model = new Application();
        $res = $application_model->getApplications($type);
        if(!$res){
            if(isset($_SERVER["HTTP_REFERER"])&&strpos($_SERVER["HTTP_REFERER"],Yii::$app->params['domain'])!==false){
                $location = $_SERVER["HTTP_REFERER"];
            }else{
                $location = '/application/index/'.$type.'/1';
            }
            header('location:'.$location);
            exit;
        }
        //excel导出
        Excel::export([                                       
            'models' => $res,
            'fileName' => $excel_name.'报名信息',
            'columns' => ['id', 'type','name', 'cellphone', 'certificate_type', 'certificate_number', 'email', 'company', 'position', 'address', 'website', 'purpose', 'area', 'classes',  'created_at'],
            'headers' => ['id'=>'ID','type'=>'报名类型','name'=>'名称','cellphone'=>'电话','certificate_type'=>'证件类型','certificate_number'=>'证件编号','email'=>'邮箱','company'=>'公司','position'=>'职位','address'=>'详细地址','website'=>'公司网站','purpose'=>'参展目的','area'=>'参展面积','classes'=>'参展类别','created_at'=>'报名时间']
        ]);
    }
    /**
     * 二维码批量导出
     */
    public function actionDownqrcode()
    {
        $type = Yii::$app->request->get('type',0);
        if(!$this->isLogin()){
            if(isset($_SERVER["HTTP_REFERER"])&&strpos($_SERVER["HTTP_REFERER"],Yii::$app->params['domain'])!==false){
                $location = $_SERVER["HTTP_REFERER"];
            }else{
                $location = '/application/index/'.$type.'/1';
            }
            header('location:'.$location);
            exit;
        }
        if($type==1){
            $zip_name = '媒体报名二维码.zip';
        }elseif($type==2){
            $zip_name = '展商报名二维码.zip';
        }else{
            $zip_name = '个人报名二维码.zip';
        }
        $application_model = new Application();
        $res = $application_model->getApplicationsByType($type);
        if(!$res){
            if(isset($_SERVER["HTTP_REFERER"])&&strpos($_SERVER["HTTP_REFERER"],Yii::$app->params['domain'])!==false){
                $location = $_SERVER["HTTP_REFERER"];
            }else{
                $location = '/application/index/'.$type.'/1';
            }
            header('location:'.$location);
            exit;
        }
        $download = [];
        foreach($res as $ak=>$av){
            $download[] = ['url'=>Yii::$app->params['img_domain'].'qrcode/'.$av['id'].'.png','name'=>$av['id'].'_'.$av['name'].'_'.$av['cellphone']];
        }
        if(count($download)>0){
            //二维码打包下载
            $filename = Yii::$app->params['upload_dir'].md5(rand(0,1).time()).'_qrcode_tmp.zip';
            $zip = new \ZipArchive();
            $zip->open($filename, $zip::CREATE | $zip::OVERWRITE);
            foreach ($download as $dk=>$dv){
                $fileData = file_get_contents($dv['url']);
                $url_array = explode('.',$dv['url']);
                $ext = end($url_array);
                if ($fileData) {
                    $zip->addFromString($dv['name'].'.'.$ext, $fileData);
                }
            }
            $zip->close();
            $file = fopen($filename, "r");
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length: " . filesize($filename));
            Header("Content-Disposition: attachment; filename=".$zip_name);
            //$buffer = 1024; //一次只传输1024个字节的数据给客户端
            while (!feof($file)) {
                $file_data = fread($file, filesize($filename));//将文件读入内存
                echo $file_data;
            }
            fclose($file);
            unlink($filename); //删除临时文件
        }
    }
}

