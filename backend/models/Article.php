<?php
namespace backend\models;

use Yii;
use backend\models\Base;

class Article extends Base
{
    public function getArticles($page,$getdata,$role = 0)
    {
        $start = ($page-1)*10;
        if($getdata['title']==''&&$getdata['category']==''){
            $where_str = '';
        }else{
            $where = array();
            if($getdata['title']!=''){
                $where[] = " title like '%{$getdata['title']}%'";
            }
            if($getdata['category']!=''){
                $where[] = " category_id={$getdata['category']}";
            }
            if(count($where)>=2){
                $where_str = ' and'.implode(' and ',$where);
            }elseif(count($where)==1){
                $where_str = ' and'.$where[0];
            }else{
                $where_str = '';
            }

        }
        if($role == 2){
            $article_sql = "select * from article  where is_news = 0 {$where_str} order by created_at desc limit {$start},10";
        }else{
            $article_sql = "select * from article where is_news = 1 {$where_str} order by created_at desc limit {$start},10";
        }
        $connection = Yii::$app->db;
        $command = $connection->createCommand($article_sql);
        $article_res = $command->queryAll();
        if(is_array($article_res)&&count($article_res)>0){
            foreach($article_res as $ak=>$av){
                $article_res[$ak]['created_at'] = date('Y-m-d H:i:s',$article_res[$ak]['created_at']);
                $article_res[$ak]['updated_at'] = date('Y-m-d H:i:s',$article_res[$ak]['updated_at']);
                if(strpos($av['category_id'],',')!==false){
                    $cate_arr = explode(',', $av['category_id']);
                }else{
                    $cate_arr[] = $av['category_id'];
                }
                $cate_str = '';
                if(count($cate_arr)>0){
                    foreach($cate_arr as $k=>$v){
                        $cate_str .= $this->getCateNameById(intval($v)).',';
                    }
                    $article_res[$ak]['category_name'] = rtrim($cate_str,',');
                }
                unset($cate_str);
                unset($cate_arr);
            }
        }else{
            $article_res = array();
        }
        return $article_res;
    }

    public function getCounts($getdata,$role = 0)
    {
        if($getdata['title']==''&&$getdata['category']==''){
            $where_str = '';
        }else{
            $where = array();
            if($getdata['title']!=''){
                $where[] = " title like '%{$getdata['title']}%'";
            }
            if($getdata['category']!=''){
                $where[] = " category_id={$getdata['category']}";
            }
            if(count($where)>=2){
                $where_str = ' and'.implode(' and ',$where);
            }elseif(count($where)==1){
                $where_str = ' and'.$where[0];
            }else{
                $where_str = '';
            }

        }
        if($role == 2){
            $counts_sql = "select count(*) as total from article where is_news = 0 {$where_str}";
        }else{
            $counts_sql = "select count(*) as total from article where is_news = 1 {$where_str}";
        }
        $connection = Yii::$app->db;
        $counts_command = $connection->createCommand($counts_sql);
        $counts_res = $counts_command->queryAll();
        if(count($counts_res)>0){
            $total = $counts_res[0]['total'];
        }else{
            $total = 0;
        }
        return $total;
    }

    /**
     * 根据分类id获取分类名称
     */
    public function getCateNameById($id)
    {
        $data = Yii::$app->db->createCommand("select name from category where id={$id}")->queryAll();
        if(isset($data[0]['name'])&&!empty($data[0]['name'])){
            $res = $data[0]['name'];
        }else{
            $res = '';
        }
        return $res;
    }

    public function getArticle($aid)
    {
        $detail_sql = "select * from article where id= {$aid}";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($detail_sql);
        $detail_res = $command->queryAll();
        if($detail_res&&count($detail_res)>0){
            if(strpos($detail_res[0]['category_id'],',')!==false){
                $cate_arr = explode(',', $detail_res[0]['category_id']);
            }else{
                $cate_arr[] = $detail_res[0]['category_id'];
            }
            $cate_str = '';
            if(count($cate_arr)>0){
                foreach($cate_arr as $k=>$v){
                    $cate_str .= $this->getCateNameById(intval($v)).',';
                }
                $detail_res[0]['category_name'] = rtrim($cate_str,',');
            }
            unset($cate_str);
            unset($cate_arr);
            $detail_res[0]['category_id'] = explode(',',$detail_res[0]['category_id']);
            $detail_res[0]['created_at'] = date('Y-m-d H:i:s',$detail_res[0]['created_at']);
            $detail_res[0]['updated_at'] = date('Y-m-d H:i:s',$detail_res[0]['updated_at']);
            $detail_res[0]['content'] = htmlspecialchars_decode($detail_res[0]['content'],ENT_QUOTES);
            $detail_res[0]['en_content'] = htmlspecialchars_decode($detail_res[0]['en_content'],ENT_QUOTES);
            if(!empty($detail_res[0]['thumb'])&&($detail_res[0]['thumb']!='')){
                $detail_res[0]['thumb'] = Yii::$app->params['img_domain'] . $detail_res[0]['thumb'];
            }
            if(!empty($detail_res[0]['en_thumb'])&&($detail_res[0]['en_thumb']!='')){
                $detail_res[0]['en_thumb'] = Yii::$app->params['img_domain'] . $detail_res[0]['en_thumb'];
            }

            
        }else{
            $detail_res[0]=array();
        }
        return $detail_res[0];

    }

    public function updateArticle($aid,$push_counts)
    {
        $push_counts = $push_counts + 1;
        $update_res = Yii::$app->db->createCommand()->update('articles',array('push_counts'=>$push_counts,'updated_at'=>time(),'push_at'=>time()),'id=:aid',array(':aid'=>$aid))->execute();
        if($update_res>0){
            $ret = true;
        }else{
            $ret = false;
        }
        return $ret;
    }

    public function addArticle($postdata)
    {
        $nowtime = time();
        $postdata['created_at'] = $nowtime;
        $postdata['updated_at'] = $nowtime;
        $insert_res = Yii::$app->db->createCommand()->insert('article',$postdata)->execute();
        if($insert_res>0){
            $return_res = true;
        }else{
            $return_res = false;
        }
        return $return_res;
    }
    //编辑文章
    public function editArticle($postdata)
    {
        $aid = $postdata['aid'];
        unset($postdata['aid']);
        $postdata['updated_at'] = time();
        /*foreach($postdata as $k=>$v){
            if(empty($v)){
                unset($postdata[$k]);
            }
        }*/
        $update_res = Yii::$app->db->createCommand()->update('article',$postdata,'id=:aid',array(':aid'=>$aid))->execute();
        if($update_res>0){
            $ret = true;
        }else{
            $ret = false;
        }
        return $ret;
    }

    //文章禁用启用
    public function changeArtst($postdata){
        $updated_at = time();
        $update_res = Yii::$app->db->createCommand()->update('article',array('status'=>$postdata['status'],'updated_at'=>$updated_at),'id=:aid',array(':aid'=>$postdata['aid']))->execute();
        if($update_res>0){
            $ret = true;
        }else{
            $ret = false;
        }
        return $ret;
    }
    
    //删除文章
    public function delArticle($aid){
        $delete_res = Yii::$app->db->createCommand()->delete('article', 'id=:id', array(':id' => $aid))->execute();
        if(!$delete_res){
            $res = false;
        }else{
            $res = true;
        }
        return $res;
    }
}