<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Navigator;

/**
 * 展会信息
 * Meeting controller
 */
class MeetingController extends BaseController
{
	public function actionIndex()
    {
    	$view = Yii::$app->view;
        $view->params['item'] = 'meeting';
        $nav_model = new Navigator();
        $view->params['class_one'] = $nav_model->getNavigator(1,$this->language);
        $view->params['class_two'] = $nav_model->getNavigator(2,$this->language);
        $flags = ['perimeter_hotel','surrounding_attractions'];
        return $this->render('index',$this->getContents($flags,$this->language));
	}
}