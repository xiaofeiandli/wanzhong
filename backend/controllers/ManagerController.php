<?php
namespace backend\controllers;

use Yii;
use yii\web\Cookie;
use common\base\Mailer;
use backend\models\Manager;

/**
 * 管理员管理
 */
class ManagerController extends BaseController
{
    /**
     * 登录
     */
    public function actionSignin()
    {
    	$username = Yii::$app->request->post('username','');
    	$password = Yii::$app->request->post('password','');
        if(empty($username)||empty($password)){
            $this->renderJson(999, [], '账号或密码不能为空');
        }
        $manager_model = new Manager();
        $manager = $manager_model->findAccountByName($username);
        if(!isset($manager['manager_password'])){
            $this->renderJson(999, [], '账号不存在');
        }
        if(isset($manager['manager_password'])&&$manager['manager_password'] != md5($password)){
            $this->renderJson(999, [], '账号或密码错误');
        }
        $token = $this->makeToken($manager['id']);
        //生成cookie
        $cookies = Yii::$app->response->cookies->add(new Cookie(['name' => 'wanzhong', 'value' => $token, 'domain' => $_SERVER['HTTP_HOST'],'expire' => 0]));
        $this->renderJson(0, ['uid' => $manager['id'], 'token' => $token]);
    }
    /**
     * 获取登录用户名
     */
    final public function actionGetmanagername()
    {
        if(!$this->isLogin()){
            $this->renderJson(0,['admin']); 
        }
        $manager_model = new Manager();
        $res = $manager_model->getManagerName($this->isLogin());
        $this->renderJson(0,['name'=>$res['name'],'role'=>$res['role']]);  
    }
    /**
     * 登出
     */
    public function actionSignout()
    {
        setcookie("wanzhong","",time()-1,'/',$_SERVER['HTTP_HOST']);
        $this->renderJson(0,[],'OK');
    }
    // 修改密码模版
    public function actionResetpwd()
    {
        if(!$this->isLogin()){
            header('location:/');
            exit;
        }
        $view = Yii::$app->view;
        $view->params['item'] = 'manager';
        return $this->render('resetpwd',['id'=>$this->isLogin()]);
    }
    // 重置密码
    public function actionNewpwd()
    {
        if(!$this->isLogin()){
            $this->renderJson(999,[],'您的账号未登录');
        }
        $mid = $this->isLogin();
        if(!isset($_POST['opwd'])||$_POST['opwd']==''){
            $this->renderJson(999,[],'旧密码不能为空');
        }
        if(!isset($_POST['npwd'])||$_POST['npwd']==''){
            $this->renderJson(999,[],'新密码不能为空');
        }else{
            if(!preg_match_all("/^(?![^a-zA-Z]+$)(?!\D+$).{6,16}$/", $_POST['npwd'])){
                $this->renderJson(999,[],'密码需由6-16位的数字和字母组成');
            }
        }
        if(!isset($_POST['rpwd'])||$_POST['rpwd']!=$_POST['npwd']){
            $this->renderJson(999,[],'两次新密码不一致');
        }
        $manager_model = new Manager();
        $change_res = $manager_model->changePwd($_POST,$mid);
        if($change_res['status']){
            setcookie("wanzhong","",time()-1,'/',$_SERVER['HTTP_HOST']);
            $this->renderJson(0,[],'修改成功');
        }else{
            $this->renderJson(999,[],$change_res['msg']);
        }
    }
}
