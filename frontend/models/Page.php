<?php
namespace frontend\models;

use Yii;
use frontend\models\Base;

/**
 * 拼装页面
 */
class Page extends Base
{
    /**
     * 新闻页
     */
    public function newsIndex($id=0,$page=1,$last_id=0,$width = 227)
    {	
        $limit = 12;
        $start = ($page-1)*$limit;
    	if($id == 0){
    		$data = Yii::$app->db->createCommand("select * from article where status=1 and is_news=1 order by created_at desc limit {$start},{$limit}")->queryAll();
    		if(is_array($data)&&count($data)>0){
	        	$result = $data;
	        }else{
	            $result = false;
	        }
    	}else{
    		$data = Yii::$app->db->createCommand("select id,category_id from article where status=1 and is_news=1 and id>{$last_id} order by created_at desc")->queryAll();
	        if(is_array($data)&&count($data)>0){
	        	$result = false;
	        	foreach($data as $k=>$v){
	        		if(strpos(','.$v['category_id'].',',','.$id.',')!==false){
	        			$tmp_result = Yii::$app->db->createCommand("select * from article where id=".$v['id'])->queryAll();
                        if(isset($tmp_result[0]['id'])){
                            $result[]=$tmp_result[0];
                        }
	        		}
	        		if(count($result)==12){
	        			break;
	        		}
	        	}
	        }else{
	            $result = false;
	        }
    	}
        if(isset($result[0]['id'])){
            foreach($result as $k=>$v){
                $result[$k]['category_name'] = '';
                foreach(explode(',', $v['category_id']) as $kk=>$vv){
                    $tmp_name = $this->getCateNameByCateId($vv);
                    if($tmp_name){
                        $result[$k]['category_name'] .= $tmp_name.',';
                    }
                }
                if(!empty($result[$k]['category_name'])){
                    $result[$k]['category_name'] = rtrim($result[$k]['category_name'],',');
                }
                if($result[$k]['thumb']!=''){
                    //（$width/width)*height
                    $tmp_width = intval(getimagesize(Yii::$app->params['upload_dir'].$result[$k]['thumb'])[0]);
                    $tmp_height = intval(getimagesize(Yii::$app->params['upload_dir'].$result[$k]['thumb'])[1]);
                    $result[$k]['thumb_height'] = ceil(($width/$tmp_width)*$tmp_height);
                    unset($tmp_height);
                    unset($tmp_height);
                    $result[$k]['thumb'] = Yii::$app->params['img_domain'] . $result[$k]['thumb'];
                }
                if($result[$k]['en_thumb']!=''){
                    $tmp_width = intval(getimagesize(Yii::$app->params['upload_dir'].$result[$k]['en_thumb'])[0]);
                    $tmp_height = intval(getimagesize(Yii::$app->params['upload_dir'].$result[$k]['en_thumb'])[1]);
                    $result[$k]['en_thumb_height'] = ceil(($width/$tmp_width)*$tmp_height);
                    unset($tmp_height);
                    unset($tmp_height);
                    $result[$k]['en_thumb'] = Yii::$app->params['img_domain'] . $result[$k]['en_thumb'];
                }
                if($result[$k]['content']!=''){
                    $result[$k]['content'] = htmlspecialchars_decode($result[$k]['content'],ENT_QUOTES);
                }
                if($result[$k]['en_content']!=''){
                    $result[$k]['en_content'] = htmlspecialchars_decode($result[$k]['en_content'],ENT_QUOTES);
                }
                $result[$k]['created_at'] = date('Y-m-d H:i:s',$result[$k]['created_at']);
                $result[$k]['updated_at'] = date('Y-m-d H:i:s',$result[$k]['updated_at']);
            }
        }
        return $result;
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