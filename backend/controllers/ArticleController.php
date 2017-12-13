<?php
namespace backend\controllers;

use Yii;
use backend\models\Article;
use backend\models\Category;
use backend\models\Manager;


/**
 * 文章管理
 * 作者：youweiyan<youweiyan@nengapp.com>
 */
class ArticleController extends BaseController
{
    public function actionIndex()
    {
        if(!$this->isLogin()){
            header('location:/');
            exit;
        }
        $view = Yii::$app->view;
        $view->params['item'] = 'article';
        $view->params['open'] = $this->isOpen($this->isLogin());
        $page = Yii::$app->request->get('page',1);
        $getdata['title'] = Yii::$app->request->get('title','');
        $getdata['category'] = Yii::$app->request->get('category','');
        $getdata['issearch'] = Yii::$app->request->get('issearch','');
        if(isset($getdata['issearch'])&&$getdata['issearch']=='yes'){
            $page = 1;
        }
        $article_model = new Article();
        $article_res = $article_model->getArticles($page,$getdata);
        $total = $article_model->getCounts($getdata);
        $category_model = new Category();
        $category_array = $category_model->getCategoriesByRole(1);
        $geturl = $_SERVER['QUERY_STRING']!=''?'?'.$_SERVER['QUERY_STRING']:'';
        if(isset($getdata['issearch'])&&$getdata['issearch']=='yes'){
            if(strpos($geturl,'issearch')!==false){
                $geturl = str_replace('&issearch=yes','',$geturl);
            }
        }
        if($page!=1&&($page-1)*10>=$total){
            header('location:/article/index/'.ceil($total/10));
            exit;
        }
        return $this->render('index',array('article_res'=>$article_res,'total'=>$total,'page'=>$page,'geturl'=>$geturl,'category_array'=>$category_array,'isOpen'=>$this->isOpen($this->isLogin())));
    }
    public function actionList()
    {
        if(!$this->isLogin()){
            header('location:/');
            exit;
        }
        $view = Yii::$app->view;
        $view->params['item'] = 'article_list';
        $view->params['open'] = $this->isOpen($this->isLogin());
        $page = Yii::$app->request->get('page',1);
        $getdata['title'] = Yii::$app->request->get('title','');
        $getdata['category'] = Yii::$app->request->get('category','');
        $getdata['issearch'] = Yii::$app->request->get('issearch','');
        if(isset($getdata['issearch'])&&$getdata['issearch']=='yes'){
            $page = 1;
        }
        $article_model = new Article();
        $article_res = $article_model->getArticles($page,$getdata,2);
        $total = $article_model->getCounts($getdata,2);
        $category_model = new Category();
        $category_array = $category_model->getCategoriesByRole(0);
        $geturl = $_SERVER['QUERY_STRING']!=''?'?'.$_SERVER['QUERY_STRING']:'';
        if(isset($getdata['issearch'])&&$getdata['issearch']=='yes'){
            if(strpos($geturl,'issearch')!==false){
                $geturl = str_replace('&issearch=yes','',$geturl);
            }
        }
        if($page!=1&&($page-1)*10>=$total){
            header('location:/article/list/'.ceil($total/10));
            exit;
        }
        return $this->render('list',array('article_res'=>$article_res,'total'=>$total,'page'=>$page,'geturl'=>$geturl,'category_array'=>$category_array,'isOpen'=>$this->isOpen($this->isLogin())));
    }

    //文章详情
    public function actionArticledetail()
    {
        if(!$this->isLogin()){
            header('location:/');
            exit;
        }
        $view = Yii::$app->view;
        $view->params['item'] = 'articles';
        if(isset($_POST['aid'])&&$_POST['aid']!=''){
            $article_model = new Article();
            $detail_res = $article_model->getArticle($_POST['aid']);
        }else{
            $detail_res = [];
        }
        $data = $this->renderPartial('ajaxdetail', array('detail_array'=>$detail_res,'role'=>$this->isOpen($this->isLogin())));
        $this->renderJson(0, $data, 'OK');
    }

    /**
     * 新增文章(模版)
     */
    public function actionNewarticle()
    {
        if(!$this->isLogin()){
            header('location:/');
            exit;
        }
        $isnews = Yii::$app->request->post('isnews',0);
        $view = Yii::$app->view;
        $view->params['item'] = 'article';
        $aid = isset($_POST['aid'])&&$_POST['aid']!=''?$_POST['aid']:0;
        $article_model = new Article();
        $detail_array = $article_model->getArticle($aid);
        $category_model = new Category();
        $category_array = $category_model->getCategoriesByRole($isnews);
        $data = $this->renderPartial('newarticle',array('article_detail'=>$detail_array,'category_array'=>$category_array,'isnews'=>$isnews));
        $this->renderJson(0, $data, 'OK');
    }
    /**
     * 保存新增文章
     */
    public function actionAddarticle()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $flag = Yii::$app->request->post('flag','other');
        $postdata['title'] = Yii::$app->request->post('title','');
        $postdata['en_title'] = Yii::$app->request->post('en_title','');
        $postdata['thumb'] = Yii::$app->request->post('thumb','');
        $postdata['en_thumb'] = Yii::$app->request->post('en_thumb','');
        $postdata['source'] = Yii::$app->request->post('source','');
        $postdata['en_source'] = Yii::$app->request->post('en_source','');
        $postdata['author'] = Yii::$app->request->post('author','');
        $postdata['en_author'] = Yii::$app->request->post('en_author','');
        $postdata['keywords'] = Yii::$app->request->post('keywords','');
        $postdata['en_keywords'] = Yii::$app->request->post('en_keywords','');
        $postdata['description'] = Yii::$app->request->post('description','');
        $postdata['en_description'] = Yii::$app->request->post('en_description','');
        $postdata['content'] = Yii::$app->request->post('content','');
        $postdata['en_content'] = Yii::$app->request->post('en_content','');
        $postdata['weight'] = Yii::$app->request->post('weight',0)==''?0:Yii::$app->request->post('weight',0);
        $managers_model = new Manager();
        $created_by = $managers_model->getManagerName($this->isLogin());
        $postdata['created_by'] = $created_by['name'];
        $postdata['updated_by'] = $postdata['created_by'];
        $postdata['is_news'] = Yii::$app->request->post('isnews',0);
        $category_id=array();
        $category_model = new Category();
        foreach($_POST as $pk=>$pv){
            if(strpos($pk,'category_')!==false){
                $category_id[] = $pv;
                $catedetail = $category_model->getCate($pv);
                if($catedetail&&$catedetail['flag']=='news'){
                    $flag='news';
                }
            }
        }
        if(count($category_id)>0){
            if($postdata['is_news']==0&&count($category_id)>1){
                $this->renderJson(999,[],'模版文章分类需单选');
            }
            $postdata['category_id'] = implode(',',$category_id);
        }else{
            $postdata['category_id'] = '';
        }
        if($postdata['category_id']==''){
            $this->renderJson(999,[],'文章分类不能为空');
        }
        if($postdata['thumb']!=''){
            if(strstr($postdata['thumb'],Yii::$app->params['img_domain'])!==false){
                $postdata['thumb'] = str_replace(Yii::$app->params['img_domain'],'',$postdata['thumb']);
            }else{
                $this->renderJson(999,[],'文章图地址错误');
            }
        }
        if($postdata['en_thumb']!=''){
            if(strstr($postdata['en_thumb'],Yii::$app->params['img_domain'])!==false){
                $postdata['en_thumb'] = str_replace(Yii::$app->params['img_domain'],'',$postdata['en_thumb']);
            }else{
                $this->renderJson(999,[],'文章图地址错误');
            }
        }
        if($flag=='news'){
            if($postdata['title']==''){
                $this->renderJson(999,[],'文章标题不能为空');
            }
            if($postdata['en_title']==''){
                $this->renderJson(999,[],'文章标题不能为空');
            }
            if($postdata['description']==''){
                $this->renderJson(999,[],'文章描述不能为空');
            }
            if($postdata['en_description']==''){
                $this->renderJson(999,[],'文章英文描述不能为空');
            }
            if($postdata['content']==''||$postdata['content']=='<p><br></p>'){
                $this->renderJson(999,[],'文章内容不能为空');
            }else{
                //$postdata['content'] = htmlspecialchars($postdata['content'],ENT_QUOTES); //转义
            }
            if($postdata['en_content']==''||$postdata['en_content']=='<p><br></p>'){
                $this->renderJson(999,[],'英文版文章内容不能为空');
            }else{
                //$postdata['en_content'] = htmlspecialchars($postdata['en_content'],ENT_QUOTES); //转义
            }
        }
        $article_model = new Article();
        $add_res = $article_model->addArticle($postdata);
        if($add_res){
            $this->renderJson(0,[],'OK');
        }else{
            $this->renderJson(500,[],'Server Error');
        }
    }

    /**
     * 编辑文章
     */
    public function actionEditarticle()
    {
        if(!$this->isLogin()){
            $this->renderJson(999, [], '您的账号未登录');
        }
        $flag = Yii::$app->request->post('flag','other');
        $postdata['aid'] = Yii::$app->request->post('aid','');
        $postdata['title'] = Yii::$app->request->post('title','');
        $postdata['en_title'] = Yii::$app->request->post('en_title','');
        $postdata['thumb'] = Yii::$app->request->post('thumb','');
        $postdata['en_thumb'] = Yii::$app->request->post('en_thumb','');
        $postdata['source'] = Yii::$app->request->post('source','');
        $postdata['en_source'] = Yii::$app->request->post('en_source','');
        $postdata['author'] = Yii::$app->request->post('author','');
        $postdata['en_author'] = Yii::$app->request->post('en_author','');
        $postdata['keywords'] = Yii::$app->request->post('keywords','');
        $postdata['en_keywords'] = Yii::$app->request->post('en_keywords','');
        $postdata['description'] = Yii::$app->request->post('description','');
        $postdata['en_description'] = Yii::$app->request->post('en_description','');
        $postdata['content'] = Yii::$app->request->post('content','');
        $postdata['en_content'] = Yii::$app->request->post('en_content','');
        $postdata['is_news'] = Yii::$app->request->post('isnews',0);
        $postdata['weight'] = Yii::$app->request->post('weight',0);
        $managers_model = new Manager();
        $updated_by = $managers_model->getManagerName($this->isLogin());
        $postdata['updated_by'] = $updated_by['name'];
        $category_id=array();
        $category_model = new Category();
        foreach($_POST as $pk=>$pv){
            if(strpos($pk,'category_')!==false){
                $category_id[] = $pv;
                $catedetail = $category_model->getCate($pv);
                if($catedetail&&$catedetail['flag']=='news'){
                    $flag='news';
                }
            }
        }
        if(count($category_id)>0){
            if($postdata['is_news']==0&&count($category_id)>1){
                $this->renderJson(999,[],'模版文章分类需单选');
            }
            $postdata['category_id'] = implode(',',$category_id);
        }
        if($postdata['category_id']==''){
            $this->renderJson(999,[],'分类不能为空');
        }
        if($flag=='news'){
            if($postdata['title']==''){
                $this->renderJson(999,[],'文章标题不能为空');
            }
            if($postdata['en_title']==''){
                $this->renderJson(999,[],'文章标题不能为空');
            }
            if($postdata['description']==''){
                $this->renderJson(999,[],'文章描述不能为空');
            }
            if($postdata['en_description']==''){
                $this->renderJson(999,[],'文章英文描述不能为空');
            }
            if($postdata['content']==''||$postdata['content']=='<p><br></p>'){
                $this->renderJson(999,[],'文章内容不能为空');
            }else{
                //$postdata['content'] = htmlspecialchars($postdata['content'],ENT_QUOTES); //转义
            }
            if($postdata['en_content']==''||$postdata['en_content']=='<p><br></p>'){
                $this->renderJson(999,[],'英文版文章内容不能为空');
            }else{
                //$postdata['en_content'] = htmlspecialchars($postdata['en_content'],ENT_QUOTES); //转义
            }
        }
        if($postdata['thumb']!=''){
            if(strstr($postdata['thumb'],Yii::$app->params['img_domain'])!==false){
                $postdata['thumb'] = str_replace(Yii::$app->params['img_domain'],'',$postdata['thumb']);
            }else{
                $this->renderJson(999,[],'文章图地址错误');
            }
        }
        if($postdata['en_thumb']!=''){
            if(strstr($postdata['en_thumb'],Yii::$app->params['img_domain'])!==false){
                $postdata['en_thumb'] = str_replace(Yii::$app->params['img_domain'],'',$postdata['en_thumb']);
            }else{
                $this->renderJson(999,[],'文章图地址错误');
            }
        }
        if($postdata['content']!=''){
            //$postdata['content'] = htmlspecialchars($postdata['content'],ENT_QUOTES); //转义
        }
        /*if($postdata['en_content']!=''){
            $postdata['en_content'] = htmlspecialchars($postdata['en_content'],ENT_QUOTES); //转义
        }*/
        $article_model = new Article();
        $edit_res = $article_model->editArticle($postdata);
        if($edit_res){
            $this->renderJson(0,[],'OK');
        }else{
            $this->renderJson(500,[],'Server Error');
        }
    }
    
    /**
     * 文章启用停用停用
     */
    public function actionChangeartst()
    {
        if(!$this->isLogin()){
            $this->renderJson(999,[],'您的账号未登录');
        }
        $view = Yii::$app->view;
        $view->params['item'] = 'article';
        $article_model = new Article();
        if(isset($_POST['aid'])&&$_POST['aid']!=''){
            if(isset($_POST['status'])&&$_POST['status']!=''){
                $change_res = $article_model->changeArtst($_POST);
                if($change_res){
                    $this->renderJson(0, [], 'OK');
                }
            }else{
                $this->renderJson(999, [], '状态不能为空');
            }
        }else{
            $this->renderJson(999, [], 'id不能为空');
        }
        $this->renderJson(999, [], '修改状态失败');
    }
    //删除文章
    public function actionDelarticle()
    {
        if(!$this->isLogin()){
            $this->renderJson(999,[],'您的账号未登录');
        }
        $article_model = new Article();
        if(!isset($_POST['aid'])||$_POST['aid']==''){
            $this->renderJson(999,[],'文章id不能为空');
        }else{
            $delete_res = $article_model->delArticle($_POST['aid']);
            if($delete_res){
                $this->renderJson(0,[],'OK');
            }
        }
        $this->renderJson(999,[],'删除失败');
    }
}