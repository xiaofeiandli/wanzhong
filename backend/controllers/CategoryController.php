<?php
namespace backend\controllers;

use Yii;
use backend\models\Category;

/**
 * 栏目管理
 */
class CategoryController extends BaseController
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
        $view->params['item'] = 'category';
        $view->params['open'] = $this->isOpen($this->isLogin());
        $category_model = new Category();
        $res = $category_model->getCategories($this->isOpen($this->isLogin()));
        return $this->render('index',['res'=>$res,'isOpen'=>$this->isOpen($this->isLogin())]);
    }
    /**
     * 添加新栏目（模版）
     */
    public function actionNewcate()
    {
    	$cid = Yii::$app->request->post('cid');
    	if(isset($cid)&&intval($cid)>0){
            $category_model = new Category();
        	$res = $category_model->getCate($cid);
        }else{
        	$res = false;
        }
        $data = $this->renderPartial('newcate',['data'=>$res]);
        $this->renderJson(0, [$data], 'OK');
    }

    /**
     * 添加新栏目
     */
    public function actionAddcate()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $cid = Yii::$app->request->post('cid');
        $name = Yii::$app->request->post('name','');
        $en_name = Yii::$app->request->post('en_name','');
        $flag = Yii::$app->request->post('flag','');
        $status = Yii::$app->request->post('status')!=null?1:0;
        if(empty($name)||empty($en_name)){
            $this->renderJson(999, [], '栏目中文或英文名称不能为空');
        }
        if(empty($flag)){
            $this->renderJson(999, [], '栏目标记不能为空');
        }
        $category_model = new Category();
        if(!isset($cid)){
            if($category_model->checkName($name)){
                $this->renderJson(999, [], '该中文名称已存在');
            }
            if($category_model->checkEnName($en_name)){
                $this->renderJson(999, [], '该英文名称已存在');
            }
            if($category_model->checkFlag($flag)){
                $this->renderJson(999, [], '该文章标识已存在');
            }
        }else{
            if($category_model->checkName($name,$cid)){
                $this->renderJson(999, [], '该中文名称已存在');
            }
            if($category_model->checkEnName($en_name,$cid)){
                $this->renderJson(999, [], '该英文名称已存在');
            }
            if($category_model->checkFlag($flag,$cid)){
                $this->renderJson(999, [], '该文章标识已存在');
            }
        }
        
        if(isset($cid)&&intval($cid)>0){
            $res = $category_model->editCate($cid,$name,$en_name,$flag,$status);
        }else{
            $res = $category_model->addCate($name,$en_name,$flag,$status);
        }
        if(!$res){
            $this->renderJson(999, [], '网络异常');
        }
        $this->renderJson(0, [], 'OK');
    }
    /**
     * 编辑栏目状态
     */
    public function actionEditstatus()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $cid = Yii::$app->request->post('cid');
        $status = Yii::$app->request->post('status',0);
        if(!isset($cid)){
            $this->renderJson(999, [], '网络异常');
        }
        $category_model = new Category();
        if(0==$status&&$category_model->checkEditIsNav($cid)){
            $this->renderJson(999, [], '该栏目已在导航中应用，请先到导航管理中移除');
        }
        if(!$category_model->changeEditStatus($cid,$status)){
            $this->renderJson(999, [], '网络异常');
        }
        $this->renderJson(0, [], 'OK');
        
    }
    /**
     * 删除栏目
     */
    public function actionCatedel()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $cid = Yii::$app->request->post('cid');
        if(!isset($cid)){
            $this->renderJson(999, [], '网络异常');
        }
        $category_model = new Category();
        if($category_model->hasArticle($cid)){
            $this->renderJson(999, [], '该栏目下存在文章，请先将文章移出该分类或者删除该分类下的文章');
        }
        if(!$category_model->delCate($cid)){
            $this->renderJson(999, [], '网络异常');
        }
        $this->renderJson(0, [], 'OK');
    }
}
