<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Resource;
use frontend\models\Navigator;

/**
 * 下载
 * Download controller
 */
class DownloadController extends BaseController
{
    /**
     * 资源下载
     */
    public function actionIndex()
    {
        $view = Yii::$app->view;
        $view->params['item'] = 'download';
        $resource_model = new Resource();
        $pic_res = $resource_model->getPictures();
        $pdf_res = $resource_model->getDocuments($this->language);
        $nav_model = new Navigator();
        $view->params['class_one'] = $nav_model->getNavigator(1,$this->language);
        $view->params['class_two'] = $nav_model->getNavigator(2,$this->language);
        return $this->render('index',array('pictures'=>$pic_res,'pdf'=>$pdf_res));
    }
}