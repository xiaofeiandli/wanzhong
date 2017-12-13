<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],//没有登录的
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],//登录了的
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],//只允许post方式访问
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
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
        $view->params['item'] = 'index';
        $view->params['open'] = $this->isOpen($this->isLogin());
        return $this->render('index',['isOpen'=>$this->isOpen($this->isLogin())]);
    }

    /**
     * 登录模版
     */
    public function actionLogin()
    {
        if($this->isLogin()){
            header('location:/');
            exit;
        }
        return $this->renderPartial('login');
    }
}
