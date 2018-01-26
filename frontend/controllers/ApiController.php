<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Article;
use frontend\models\Resource;

/**
 * 接口类
 * Api controller
 */
class ApiController extends BaseController
{
	public function actionList()
    {
        $type = Yii::$app->request->post('type','lyric');
        $page = Yii::$app->request->post('page',1);
        $limit = Yii::$app->request->post('limit',10);
        $orderby = Yii::$app->request->post('orderby','');
        if(intval($page)<=1){
            $page = 1;
        }else{
            $page = intval($page);
        }
        if(intval($limit)<=1){
            $limit = 10;
        }else{
            $limit = intval($limit);
        }
        if(!in_array($orderby, ['created_at','read'])){
            $orderby = 'created_at';
        }
        if(!in_array($type, ['lyric','poem','video','audio','image','calligraphy'])){
            $this->renderJson(999, [], '参数有误');
        }
        if($type=='lyric'){
            $article_model = new Article();
            $res = $article_model->getList(1,$page,$limit,$orderby);
        }elseif($type=='poem'){
            $article_model = new Article();
            $res = $article_model->getList(2,$page,$limit,$orderby);
        }elseif($type=='video'){
            $resource_model = new Resource();
            $res = $resource_model->getList($type,$page,$limit,$orderby);
        }elseif($type=='audio'){
            $resource_model = new Resource();
            $res = $resource_model->getList($type,$page,$limit,$orderby);
        }elseif($type=='image'){
            $resource_model = new Resource();
            $res = $resource_model->getList($type,$page,$limit,$orderby);
        }elseif($type=='calligraphy'){
            $resource_model = new Resource();
            $res = $resource_model->getList($type,$page,$limit,$orderby);
        }else{
            $res = false;
        }
        if(!$res){
            $this->renderJson(999, [], '暂无数据');
        }
        $this->renderJson(0, $res, 'OK');
	}
    public function actionDetail()
    {
        $id = Yii::$app->request->post('id');
        $type = Yii::$app->request->post('type','lyric');
        if(!in_array($type, ['lyric','poem','video','audio','image','calligraphy'])){
            $this->renderJson(999, [], '参数有误');
        }
        if(in_array($type, ['lyric','poem'])){
            $article_model = new Article();
            $res = $article_model->getDetail($id);
        }elseif(in_array($type, ['video','audio','image','calligraphy'])){
            $resource_model = new Resource();
            $res = $resource_model->getDetail($id);
        }else{
            $res = false;
        }
        if(!$res){
            $this->renderJson(999, [], '暂无数据');
        }
        $this->renderJson(0, $res, 'OK');
    }
    public function actionRead()
    {
        $id = Yii::$app->request->post('id');
        $type = Yii::$app->request->post('type','lyric');
        if(!in_array($type, ['lyric','poem','video','audio','image','calligraphy'])){
            $this->renderJson(999, [], '参数有误');
        }
        if(in_array($type, ['lyric','poem'])){
            $article_model = new Article();
            $res = $article_model->addReadCount($id);
        }elseif(in_array($type, ['video','audio','image','calligraphy'])){
            $resource_model = new Resource();
            $res = $resource_model->addReadCount($id);
        }else{
            $res = false;
        }
        if(!$res){
            $this->renderJson(999, [], '暂无数据');
        }
        $this->renderJson(0, $res, 'OK');
    }
}
?>