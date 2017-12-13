<?php
namespace wap\controllers;

use Yii;
use frontend\models\Navigator;
use frontend\models\Page;

/**
 * 关于我们
 * About controller
 */
class AboutController extends BaseController
{
	public function actionIndex()
    {
    	$view = Yii::$app->view;
        $view->params['item'] = 'about';
        $nav_model = new Navigator();
        $view->params['class_one'] = $nav_model->getNavigator(1,$this->language);
        $view->params['class_two'] = $nav_model->getNavigator(2,$this->language);
        $flags = ['conference','organization','special_report','official_partners','strategic_partners','exclusive_video','invited_potal','key_supporter','invited_partners','key_partners','new_media','acknowledgement_iamond','acknowledgement_gold','acknowledgement_silver','cooperative_supporter','official_mobility','official_shuttle','vr_exclusive','multi_media','sponsor_company','co_organizer','organizer','co_sponsor','led_by'];
        return $this->render('index',$this->getContents($flags,$this->language));
	}
}
?>