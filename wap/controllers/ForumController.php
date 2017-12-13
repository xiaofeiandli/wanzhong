<?php
namespace wap\controllers;

use Yii;
use frontend\models\Navigator;
use frontend\models\News;

/**
 * 论坛
 * Forum controller
 */
class ForumController extends BaseController
{
	public function actionIndex()
    {
    	$view = Yii::$app->view;
        $view->params['item'] = 'forum';
        $nav_model = new Navigator();
        $view->params['class_one'] = $nav_model->getNavigator(1,$this->language);
        $view->params['class_two'] = $nav_model->getNavigator(2,$this->language);
        $flags = ['theme_fornum','parallel_forum','participant'];
        return $this->render('index',$this->getContents($flags,$this->language));
	}

    public function actionDetail(){
        $view = Yii::$app->view;
        $view->params['item'] = 'forum';
        if(isset($_GET['fid'])&&$_GET['fid']!=''){
            $news_model = new News();
            $detail = $news_model->getDetail($_GET['fid'],$this->language);
        }else{
            $detail=[];
        }
        return $this->render('detail', array('detail'=>$detail));
    }
}