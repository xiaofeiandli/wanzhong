<?php
namespace wap\controllers;

use Yii;
use yii\web\Cookie;
use common\models\LoginForm;
use dosamigos\qrcode\QrCode;
use common\base\Mailer;
use frontend\models\Application;
use frontend\models\Navigator;
use frontend\models\Upload;
use yii\captcha\CaptchaValidator;

/**
 * 报名接口
 */
class ApplicationController extends BaseController
{
    public function actionMedia()
    {
        $view = Yii::$app->view;
        $view->params['item'] = 'application';
        $nav_model = new Navigator();
        $view->params['class_one'] = $nav_model->getNavigator(1,$this->language);
        $view->params['class_two'] = $nav_model->getNavigator(2,$this->language);
        return $this->render('media');
    }
    public function actionPerson()
    {
        $view = Yii::$app->view;
        $view->params['item'] = 'application';
        $nav_model = new Navigator();
        $view->params['class_one'] = $nav_model->getNavigator(1,$this->language);
        $view->params['class_two'] = $nav_model->getNavigator(2,$this->language);
        $loginForm = new LoginForm();//这里要把刚才写的类new下，注意你们要引入文件路径额
        return $this->render('person',array('loginForm'=>$loginForm));
    }
    public function actionCompany()
    {
        $view = Yii::$app->view;
        $view->params['item'] = 'application';
        $nav_model = new Navigator();
        $view->params['class_one'] = $nav_model->getNavigator(1,$this->language);
        $view->params['class_two'] = $nav_model->getNavigator(2,$this->language);
        return $this->render('company');
    }
    public function actionValidatecode(){
        //验证图文验证码
        $captcha = Yii::$app->request->post('captcha','');
        if ($captcha=='')
        {
            if($this->language=='en'){
                $this->renderJson(999, [], 'please enter verification code');
            }else{
                $this->renderJson(999, [], '请输入验证码');
            }
        }
        $caprcha = new CaptchaValidator();

        if (!$caprcha->validate($captcha))
        {
            if($this->language=='en'){
                $this->renderJson(999, [], 'verification code error');
            }else{
                $this->renderJson(999, [], '图文验证码错误');
            }
        }else{
            $this->renderJson(0, [], 'OK');
        }
    }
    public function actionDoapply()
    {
        $postdata['type'] = Yii::$app->request->post('type','');
        $type_array = array(0,1,2);
        if($postdata['type']==''||!in_array($postdata['type'],$type_array)){
            $this->renderJson(500,[],'Server Error');
        }
        if($postdata['type']==0){
            $postdata['name'] = Yii::$app->request->post('name','');
            $postdata['cellphone'] = Yii::$app->request->post('cellphone','');
            $postdata['certificate_type'] = Yii::$app->request->post('certificate_type',0);
            $postdata['certificate_number'] = Yii::$app->request->post('certificate_number','');
            $postdata['email'] = Yii::$app->request->post('email','');
            $postdata['company'] = Yii::$app->request->post('company','');
            $postdata['position'] = Yii::$app->request->post('position','');
            if($postdata['name']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter full name');
                }else{
                    $this->renderJson(999,[],'姓名不能为空');
                }
            }
            if($postdata['cellphone']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter mobile phone');
                }else{
                    $this->renderJson(999,[],'手机号不能为空');
                }
            }
            if($postdata['certificate_number']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter correct ID NO.');
                }else{
                    $this->renderJson(999,[],'证件号不能为空');
                }
            }
            if($postdata['email']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter correct E-mail address');
                }else{
                    $this->renderJson(999,[],'邮箱地址不能为空');
                }
            }
        }
        if($postdata['type']==1){
            $postdata['name'] = Yii::$app->request->post('name','');
            $postdata['cellphone'] = Yii::$app->request->post('cellphone','');
            $postdata['certificate_type'] = Yii::$app->request->post('certificate_type',0);
            $postdata['certificate_number'] = Yii::$app->request->post('certificate_number','');
            $postdata['email'] = Yii::$app->request->post('email','');
            $postdata['company'] = Yii::$app->request->post('company','');
            //$postdata['company'] = Yii::$app->request->post('company','');
            $postdata['position'] = Yii::$app->request->post('position','');
            //$postdata['province'] = Yii::$app->request->post('province','');
            //$postdata['city'] = Yii::$app->request->post('city','');
            $postdata['address'] = Yii::$app->request->post('address','');
            $postdata['card'] = Yii::$app->request->post('card','');
            if($postdata['card']!=''&&strpos($postdata['card'],Yii::$app->params['img_domain'])!==false){
                $postdata['card'] = str_replace(Yii::$app->params['img_domain'],'',$postdata['card']);
            }
            if($postdata['name']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter full name');
                }else{
                    $this->renderJson(999,[],'姓名不能为空');
                }
            }
            if($postdata['cellphone']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter mobile phone');
                }else{
                    $this->renderJson(999,[],'手机号不能为空');
                }
            }
            if($postdata['certificate_number']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter correct ID NO.');
                }else{
                    $this->renderJson(999,[],'证件号不能为空');
                }
            }
            if($postdata['email']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter correct E-mail address');
                }else{
                    $this->renderJson(999,[],'邮箱地址不能为空');
                }
            }
            if($postdata['company']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter company name');
                }else{
                    $this->renderJson(999,[],'公司名称不能为空');
                }
            }
            if($postdata['position']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter job title');
                }else{
                    $this->renderJson(999,[],'职位不能为空');
                }
            }
        }
        if($postdata['type']==2){
            $postdata['company'] = Yii::$app->request->post('company','');
            $postdata['name'] = Yii::$app->request->post('name','');
            $postdata['position'] = Yii::$app->request->post('position','');
            $postdata['cellphone'] = Yii::$app->request->post('telephone','');
            $postdata['email'] = Yii::$app->request->post('email','');
            $postdata['province'] = Yii::$app->request->post('province','');
            $postdata['city'] = Yii::$app->request->post('city','');
            $postdata['address'] = Yii::$app->request->post('address','');
            $postdata['website'] = Yii::$app->request->post('website','');
            $postdata['purpose'] = Yii::$app->request->post('purpose','');
            $postdata['area'] = Yii::$app->request->post('area','');
            $postdata['classes'] = Yii::$app->request->post('classes','');

            if($postdata['name']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter contact person');
                }else{
                    $this->renderJson(999,[],'联系人不能为空');
                }
                
            }
            if($postdata['position']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter job title');
                }else{
                    $this->renderJson(999,[],'职位不能为空');
                }
                
            }
            if($postdata['cellphone']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter mobile phone');
                }else{
                    $this->renderJson(999,[],'联系电话不能为空');
                }
                
            }
            if($postdata['email']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter correct E-mail address');
                }else{
                    $this->renderJson(999,[],'邮箱地址不能为空');
                }
                
            }
            /*if($postdata['province']==''){
                $this->renderJson(999,[],'省份不能为空');
            }
            if($postdata['city']==''){
                $this->renderJson(999,[],'市不能为空');
            }*/
            if($postdata['address']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please enter address');
                }else{
                    $this->renderJson(999,[],'详细地址不能为空');
                }
                
            }
            if($postdata['area']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please choose exhibition area');
                }else{
                    $this->renderJson(999,[],'参展面积不能为空');
                }
                
            }
            if($postdata['classes']==''){
                if($this->language=='en'){
                    $this->renderJson(999, [], 'Please choose business field');
                }else{
                    $this->renderJson(999,[],'参展类别不能为空');
                }
                
            }
        }
        $application_model = new Application();
        $add_res = $application_model->addApplication($postdata);
        if($add_res){
            $apply_info = $application_model->getApplyInfo($add_res);
            if($apply_info){
                Yii::$app->redis->set($add_res,$apply_info);
            }
            QrCode::png($this->makeToken($add_res),Yii::$app->params['upload_dir'].'qrcode/'.$add_res.'.png','L',4,2);
            $mailer_model = new Mailer();
            $pic_path = '';
            if($postdata['type'] == 0){
                $person_info = $application_model->getPersonInfo($add_res,$this->language);
                $pic_path = Yii::$app->params['img_domain'].'qrcode/'.$add_res.'.png';
                if($this->language=='en'){
                    $mailer_msg = 'Hi:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Congratulations! You have successfully registered the GFM 2017.Please keep this email properly, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bring your ID card and the QR code to enter the venue. <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$person_info;
                }else{
                    $mailer_msg = '您好:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;恭喜您在全球未来出行高层论坛暨国际展览报名成功，请妥善保管该邮件。<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;届时请携带二维码和个人有效证件至活动现场，由工作人员核对无误后方可进场参会。<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$person_info;
                }
            }else{
                if($postdata['type'] == 1){
                    if($this->language=='en'){
                        $tmp_apply_name = 'media';
                    }else{
                        $tmp_apply_name = '媒体';
                    }
                    $tmp_apply_info = $application_model->getMediaInfo($add_res,$this->language);
                }else{
                    if($this->language=='en'){
                        $tmp_apply_name = 'Exhibitor';
                    }else{
                        $tmp_apply_name = '展商';
                    }
                    $tmp_apply_info = $application_model->getCompanyInfo($add_res,$this->language);
                }
                if($this->language=='en'){
                    $mailer_msg = 'Hi:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We have received your <b>'.$tmp_apply_name.'</b style="color:red;"> information, please keep your phone available for us to contact.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tmp_apply_info;
                }else{
                    $mailer_msg = '您好:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您在全球未来出行高层论坛暨国际展览官网提交的<b>'.$tmp_apply_name.'</b style="color:red;">报名信息我们已经收到。<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请等待组委会工作人员与您联系！请保持手机畅通！<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$tmp_apply_info;
                }
            }
            $mailer_model->sendEmail($postdata['email'],$mailer_msg,$pic_path);
            if($postdata['type']==0){
                $person_qrcode = Yii::$app->params['img_domain'].'qrcode/'.$add_res.'.png';
                $this->renderJson(0,['qrcode'=>$person_qrcode],'OK');
            }else{
                $this->renderJson(0,[],'OK');
            }
            
        }else{
            $this->renderJson(500,[],'Server Error');
        }
    }
    /**
     * 图片上传
     */
    public function actionPutfile()
    {
        //图片验证
        $upload_model = new Upload();
        if(is_array($_FILES)){
            foreach($_FILES as $key=>$value){
                if(!$upload_model->imgUploads($key,'image','card')){
                    $this->renderJson(999,[],$upload_model->getErrorMessage());
                }else{
                    //缩略
                    if(isset($_POST['cat'])&&$_POST['cat']){
                        $thumb = $this->getThumb($upload_model->newPath);
                        if($thumb){
                            unlink($upload_model->newPath);
                            $upload_model->newPath = $thumb;
                        }
                    }
                    $tmp_pic = str_replace(Yii::$app->params['upload_dir'],Yii::$app->params['img_domain'],$upload_model->newPath);
                    $this->renderJson(0,$tmp_pic,'OK');
                }
            }
        }else{
            $this->renderJson(999,[],'网络异常');
        }
    }
}

