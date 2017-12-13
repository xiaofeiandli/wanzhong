<?php
namespace frontend\models;

use Yii;
use frontend\models\Base;

/**
 * 新闻
 */
class News extends Base
{
    /**
     * 检测id是否存在
     */
    public function checkId($id)
    {
        $data = Yii::$app->db->createCommand("select id from article where id={$id} and is_news=1 and status = 1")->queryAll();
        //print_r($data);exit;
        if(isset($data[0]['id'])){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 新闻详情
     */
    public function getDetail($id,$language='')
    {
        $data = Yii::$app->db->createCommand("select * from article where id={$id}")->queryAll();
        if(isset($data[0]['id'])){
        	$res = $data[0];
            $res['category_name'] = '';
            foreach(explode(',', $res['category_id']) as $kk=>$vv){
                $tmp_name = $this->getCateNameByCateId($vv);
                if($tmp_name){
                    $res['category_name'] .= $tmp_name.',';
                }
            }
            if(!empty($res['category_name'])){
                $res['category_name'] = rtrim($res['category_name'],',');
            }
        	if(isset($res['content'])&&!empty($res['content'])){
        		$res['content'] = htmlspecialchars_decode($res['content'],ENT_QUOTES);
        	}
        	if(isset($res['en_content'])&&!empty($res['en_content'])){
        		$res['en_content'] = htmlspecialchars_decode($res['en_content'],ENT_QUOTES);
        	}
        	if(isset($res['thumb'])&&!empty($res['thumb'])){
        		$res['thumb'] = Yii::$app->params['img_domain'] . $res['thumb'];
        	}
        	if(isset($res['en_thumb'])&&!empty($res['en_thumb'])){
        		$res['en_thumb'] = Yii::$app->params['img_domain'] . $res['en_thumb'];
        	}
            $res['created_at'] = date('Y-m-d',$res['created_at']);
            $res['updated_at'] = date('Y-m-d H:i:s',$res['updated_at']);
            if($language == 'en'){
                if(!empty($res['en_title'])){
                    $res['title'] = $res['en_title'];
                }
                if(!empty($res['en_thumb'])){
                    $res['thumb'] = $res['en_thumb'];
                }
                if(!empty($res['en_content'])&&$res['en_content']!=''&&$res['en_content']!='<p><br></p>'){
                    $res['content'] = $res['en_content'];
                }
                if(!empty($res['en_source'])){
                    $res['source'] = $res['en_source'];
                }
                if(!empty($res['en_author'])){
                    $res['author'] = $res['en_author'];
                }
                if(!empty($res['en_keywords'])){
                    $res['keywords'] = $res['en_keywords'];
                }
                if(!empty($res['en_description'])){
                    $res['description'] = $res['en_description'];
                }
            }
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 获取文章数
     */
    public function getNewsCountByCateId($id = 0)
    {
        $count = 0;
        $data = Yii::$app->db->createCommand("select category_id from article where is_news=1")->queryAll();
        if($id!=0&&is_array($data)&&count($data)>0){
            $result = ',';
            foreach($data as $k=>$v){
                $result .= $v['category_id'].',';
            }
            $count = substr_count($result,','.$id);
        }elseif($id==0&&is_array($data)&&count($data)>0){
            $count = count($data);
        }
        return $count;
    }
    /**
     * 根据分类id获取分类名称
     */
    public function getCateNameByCateId($id)
    {
        $data = Yii::$app->db->createCommand("select name,en_name from category where id={$id}")->queryAll();
        if(isset($data[0]['name'])){
            $result = $data[0]['name'];
        }else{
            $result = false;
        }
        return $result;
    }
}