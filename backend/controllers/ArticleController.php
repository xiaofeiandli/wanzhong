<?php
namespace backend\controllers;

use Yii;
use backend\models\Article;
use backend\models\Category;
use backend\models\Manager;


/**
 * 文章管理
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
        $type = Yii::$app->request->get('type',1);
        $page = Yii::$app->request->get('page',1);
        if(!in_array($type, [1,2])){
            $type = 1;
        }
        $view->params['type'] = $type;
        $article_model = new Article();
        $article_res = $article_model->getArticles($type,$page);
        $total = $article_model->getCounts();
        $count['poem'] = $article_model->getPoemCount();
        $count['lyric'] = $article_model->getLyricCount();
        if($page!=1&&($page-1)*10>=$total){
            header('location:/article/index/'.$type.'/'.ceil($total/10));
            exit;
        }
        return $this->render('index',['type'=>$type,'count'=>$count,'article_res'=>$article_res,'total'=>$total,'page'=>$page]);
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
        $data = $this->renderPartial('ajaxdetail', ['detail_array'=>$detail_res]);
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
        $data = $this->renderPartial('newarticle',['article_detail'=>$detail_array]);
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
        $postdata['title'] = Yii::$app->request->post('title','');
        $postdata['category'] = Yii::$app->request->post('category','');
        //$postdata['thumb'] = Yii::$app->request->post('thumb','');
        $postdata['author'] = Yii::$app->request->post('author','');
        $postdata['content'] = Yii::$app->request->post('content','');
        $postdata['created_at'] = time();
        if($postdata['category']==''){
            $this->renderJson(999,[],'文章分类不能为空');
        }
        if($postdata['title']==''){
            $this->renderJson(999,[],'文章标题不能为空');
        }
        if($postdata['content']==''||$postdata['content']=='<p><br></p>'){
            $this->renderJson(999,[],'文章内容不能为空');
        }
        $article_model = new Article();
        $add_res = $article_model->addArticle($postdata);
        if($add_res){
            $this->renderJson(0,[],'OK');
        }else{
            $this->renderJson(500,[],'网络异常');
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
        $postdata['aid'] = Yii::$app->request->post('aid','');
        $postdata['title'] = Yii::$app->request->post('title','');
        $postdata['category'] = Yii::$app->request->post('category','');
        //$postdata['thumb'] = Yii::$app->request->post('thumb','');
        $postdata['author'] = Yii::$app->request->post('author','');
        $postdata['content'] = Yii::$app->request->post('content','');
        if($postdata['category']==''){
            $this->renderJson(999,[],'分类不能为空');
        }
        if($postdata['title']==''){
            $this->renderJson(999,[],'文章标题不能为空');
        }
        if($postdata['content']==''||$postdata['content']=='<p><br></p>'){
            $this->renderJson(999,[],'文章内容不能为空');
        }
        /*if($postdata['thumb']!=''){
            if(strstr($postdata['thumb'],Yii::$app->params['img_domain'])!==false){
                $postdata['thumb'] = str_replace(Yii::$app->params['img_domain'],'',$postdata['thumb']);
            }else{
                $this->renderJson(999,[],'文章图地址错误');
            }
        }*/
        $article_model = new Article();
        $edit_res = $article_model->editArticle($postdata);
        if($edit_res){
            $this->renderJson(0,[],'OK');
        }else{
            $this->renderJson(500,[],'网络异常');
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