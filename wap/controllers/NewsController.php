<?php
namespace wap\controllers;

use Yii;
use frontend\models\Page;
use frontend\models\Category;
use frontend\models\Navigator;
use frontend\models\News;

/**
 * 展会新闻
 * News controller
 */
class NewsController extends BaseController
{
	public function actionIndex()
    {
        $id = Yii::$app->request->get('id',0);
        $id = intval($id);
        $page = 1;
    	$type = Yii::$app->request->get('type','grid');
    	$cate_model = new Category();
    	if(!in_array($type, ['list','grid','detail','ajaxlist'])){
    		header('location:/news/grid/'.$id);
    		exit;
    	}
    	if($id!=0&&!$cate_model->checkId($id)){
			header('location:/news/'.$type.'/0');
    		exit;
    	}
    	$view = Yii::$app->view;
        $view->params['item'] = 'news';
        $nav_model = new Navigator();
        $view->params['class_one'] = $nav_model->getNavigator(1,$this->language);
        $view->params['class_two'] = $nav_model->getNavigator(2,$this->language);
        $page_model = new Page();
        $news_res = $page_model->newsIndex($id);
        $cate_res = $cate_model->getNewsCate();
        if($this->language=='en'){
            foreach($cate_res as $ck=>$cv){
                if(isset($cate_res[$ck]['en_name'])&&$cate_res[$ck]['en_name']!=''){
                    $cate_res[$ck]['name'] = $cate_res[$ck]['en_name'];
                }
            }
        }
        $cate_id_arr = [];
        if(isset($cate_res[0]['id'])){
            foreach($cate_res as $k=>$v){
                $cate_id_arr[] = $v['id'];
            }
        }
        if($news_res){
            $news_model = new News();
            $news_count  = $news_model->getNewsCountByCateId($id);
            $last_id = isset($news_res[count($news_res)-1]['id'])?$news_res[count($news_res)-1]['id']:0;
        }else{
            $news_count = 0;
            $last_id = 0;
        }
        //if($type == 'list'){
        	return $this->render('index',['cate_res'=>$cate_res,'news_count'=>$news_count,'cate_id_arr'=>$cate_id_arr,'news_res'=>$news_res,'id'=>$id,'type'=>$type,'page'=>$page,'last_id'=>$last_id]);
        /*}else{
        	return $this->render('grid',['cate_res'=>$cate_res,'news_count'=>$news_count,'cate_id_arr'=>$cate_id_arr,'news_res'=>$news_res,'id'=>$id,'type'=>$type,'page'=>$page,'last_id'=>$last_id]);
        }*/
	}
    public function actionAjaxlist()
    {
        $type = Yii::$app->request->get('type','grid');
        $type = isset($type)&&$type=='list'?'list':'grid';
        $id = Yii::$app->request->get('id',0);
        $page = Yii::$app->request->get('page',1);
        $last_id = Yii::$app->request->get('last',0);
        $width = Yii::$app->request->get('width',227);
        //var_dump($_GET);exit;
        $page_model = new Page();
        $news_res = $page_model->newsIndex($id,$page,$last_id,$width);
        //var_dump($news_res);exit;
        if($news_res){
            $last_id = isset($news_res[count($news_res)-1]['id'])?$news_res[count($news_res)-1]['id']:0;
            $data = $this->renderPartial('ajaxlist',['data'=>$news_res,'type'=>$type,'language'=>$this->language]);
        }else{
            $last_id = 0;
            $data = '';
        }
        $this->renderJson(0, ['data'=>$data,'last'=>$last_id], 'OK');

    }
    public function actionDetail()
    {
        $id = Yii::$app->request->get('id',0);
        $news_model = new News();
        if(intval($id)==0||!$news_model->checkId(intval($id))){
            header('location:/news/grid/0');
            exit;
        }
        $view = Yii::$app->view;
        $view->params['item'] = 'news';
        $nav_model = new Navigator();
        $view->params['class_one'] = $nav_model->getNavigator(1,$this->language);
        $view->params['class_two'] = $nav_model->getNavigator(2,$this->language);
        $detail_res = $news_model->getDetail($id,$this->language);
        return $this->render('detail',['detail'=>$detail_res]);
    }
}