<?php
namespace backend\controllers;

use Yii;
use backend\models\Navigator;

/**
 * 导航管理
 */
class NavigatorController extends BaseController
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
        $view->params['item'] = 'navigator';
        $view->params['open'] = $this->isOpen($this->isLogin());
        $navigator_model = new Navigator();
        $res = $navigator_model->getNavigators();
        $res_two = $navigator_model->getNavigatorsOfClassTwo();
        return $this->render('index',['res'=>$res,'res_two'=>$res_two,'isOpen'=>$this->isOpen($this->isLogin())]);
    }
    /**
     * 添加新导航(模版)
     */
    public function actionNewnav()
    {
    	$nid = Yii::$app->request->post('nid');
        $navigator_model = new Navigator();
    	if(isset($nid)&&intval($nid)>0){
        	$res = $navigator_model->getNav($nid);
        }else{
        	$res = false;
        }
        $class_one_res = $navigator_model->getClassOne();
        $data = $this->renderPartial('newnav',['data'=>$res,'class_one'=>$class_one_res]);
        $this->renderJson(0, [$data], 'OK');
    }
    /**
     * 添加新导航
     */
    public function actionAddnav()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $nid = Yii::$app->request->post('nid');
        $name = Yii::$app->request->post('name','');
        $en_name = Yii::$app->request->post('en_name','');
        $url = Yii::$app->request->post('url','');
        $weight = Yii::$app->request->post('weight','1');
        $class = Yii::$app->request->post('class',1);
        $pid = Yii::$app->request->post('pid','');
        if(empty($name)||empty($en_name)){
            $this->renderJson(999, [], '导航中文或英文名称不能为空');
        }
        if(empty($url)){
            $this->renderJson(999, [], '导航地址不能为空');
        }
        if($class==2&&empty($pid)){
            $this->renderJson(999, [], '请选择所属一级分类');
        }
        $navigator_model = new Navigator();
        if(!isset($nid)&&empty($pid)&&$navigator_model->getNavCounts()>=6){
            $this->renderJson(999, [], '一级导航个数已达上限');
        }
        if(!isset($nid)){
            if($navigator_model->checkName($name)){
                $this->renderJson(999, [], '该中文名称已存在');
            }
            if($navigator_model->checkEnName($en_name)){
                $this->renderJson(999, [], '该英文名称已存在');
            }
        }else{
            if($navigator_model->checkName($name,$nid)){
                $this->renderJson(999, [], '该中文名称已存在');
            }
            if($navigator_model->checkEnName($en_name,$nid)){
                $this->renderJson(999, [], '该英文名称已存在');
            }
        }
        
        if(isset($nid)&&intval($nid)>0){
            $res = $navigator_model->editNav($nid,$name,$en_name,$url,$weight,$class,$pid);
        }else{
            $res = $navigator_model->addNav($name,$en_name,$url,$weight,$class,$pid);
        }
        if(!$res){
            $this->renderJson(999, [], '网络异常');
        }
        $this->renderJson(0, [], 'OK');
    }

    /**
     * 删除导航
     */
    public function actionNavdel()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $nid = Yii::$app->request->post('nid');
        if(!isset($nid)){
            $this->renderJson(999, [], '网络异常');
        }
        $navigator_model = new Navigator();
        if($navigator_model->hasClassTwo($nid)){
            $this->renderJson(999, [], '该一级导航下存在二级导航，请先将二级导航移出该一级导航或者删除该一级导航下二级导航');
        }
        if(!$navigator_model->delNav($nid)){
            $this->renderJson(999, [], '网络异常');
        }
        $this->renderJson(0, [], 'OK');
    }
}
