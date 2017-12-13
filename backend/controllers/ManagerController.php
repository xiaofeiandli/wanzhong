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
        $cookies = Yii::$app->response->cookies->add(new Cookie(['name' => 'gfm', 'value' => $token, 'domain' => $_SERVER['HTTP_HOST'],'expire' => 0]));
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
        setcookie("gfm","",time()-1,'/',$_SERVER['HTTP_HOST']);
        $this->renderJson(0,[],'OK');
    }
    /**
     * 管理员首页
     */
    public function actionIndex()
    {
        if(!$this->isLogin()){
            header('location:/site/login');
            exit;
        }
        $view = Yii::$app->view;
        $view->params['item'] = 'manager';
        $view->params['open'] = $this->isOpen($this->isLogin());
        $manager_model = new Manager();
        $res = $manager_model->getAccounts();
        return $this->render('index',['list'=>$res,'isOpen'=>$this->isOpen($this->isLogin())]);
    }

    /**
     * 添加管理员
     */
    public function actionAdd()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $username = Yii::$app->request->post('username','');
        $email = Yii::$app->request->post('email','');
        $auth = Yii::$app->request->post('auth',0);
        $manager_model = new Manager();
        if(empty($username)){
            $this->renderJson(999,[],'账号不能为空');
        }else{
            $manager = $manager_model->findAccountByName($username);
            if(isset($manager['id'])){
                $this->renderJson(999,[],'该账号已存在');
            }
        }
        if(in_array($username,['admin','root','administrator','supervisor'])){
            $this->renderJson(999,[],'账号名称不能为'.$username);
        }
        if(empty($email)){
            $this->renderJson(999,[],'邮箱不能为空');
        }
        $auth = $auth == 0 ? 0 :1;
        $randdata = rand(1,100);
        $send_pwd = substr(md5($randdata) , 0 , 8);
        $password = md5($send_pwd);
        $res = $manager_model->addManager($username,$password,$email,$auth);
        if($res){
            $mailer_model = new Mailer();
            $mailer_msg = '您在GFM(未来出行)后台的管理员账号‘'.$username.'’已生效，密码为‘'.$send_pwd.'’，首次登录请修改密码。';
            $mailer_res = $mailer_model->sendEmail($email,$mailer_msg);
            if($mailer_res){
                $msg = '新建管理员‘'.$username.'’在GFM(未来出行)后台管理系统的密码为‘'.$send_pwd.'’，密码已通过邮件发送到该管理员邮箱。';
            }else{
                $msg = '新建管理员‘'.$username.'’在GFM(未来出行)后台管理系统的密码为‘'.$send_pwd.'’,请告知其密码。';
            }
            $this->renderJson(0,[],$msg);
        }else{
            $this->renderJson(999,[],'网络错误');
        }
    }
    /**
     * 删除管理员
     */
    public function actionDel()
    {
        if(!$this->isLogin()){
            $this->renderJson(999,[],'您的账号未登录');
        }
        $id = Yii::$app->request->post('id');
        if(!isset($id)){
            $this->renderJson(999,[],'网络异常');
        }
        $manager_model = new Manager();
        if($id==$this->isLogin()){
            $this->renderJson(999,[],'您不能删除自己的账号');
        }
        $delete_res = $manager_model->delManager($id);
        if(!$delete_res){
            $this->renderJson(999,[],'删除失败');
        }
        $this->renderJson(0,[],'删除成功');
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
        $view->params['open'] = $this->isOpen($this->isLogin());
        return $this->render('resetpwd',['id'=>$this->isLogin(),'isOpen'=>$this->isOpen($this->isLogin())]);
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
            setcookie("gfm","",time()-1,'/',$_SERVER['HTTP_HOST']);
            $this->renderJson(0,[],'修改成功');
        }else{
            $this->renderJson(999,[],$change_res['msg']);
        }
    }
}
