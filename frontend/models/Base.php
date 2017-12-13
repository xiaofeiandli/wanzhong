<?php
namespace frontend\models;

use Yii;
use yii\base\Model;


class Base extends Model
{
	public function getContents($flags=[],$language = '')
	{
        if(isset($flags)&&is_array($flags)&&count($flags)>0){
            foreach($flags as $k=>$v){
                $data = Yii::$app->db->createCommand("select id from category where flag='{$v}'")->queryAll();
                if(isset($data[0]['id'])){
                    $cate_id = $data[0]['id'];
                    $art_data = Yii::$app->db->createCommand("select * from article where category_id='{$cate_id}' and status=1 order by weight desc")->queryAll();
                    if(isset($art_data[0]['id'])){
                        foreach($art_data as $ak=>$av){
                            if(isset($art_data[$ak]['thumb'])&&$art_data[$ak]['thumb']!=''){
                                $art_data[$ak]['thumb'] = Yii::$app->params['img_domain'] . $art_data[$ak]['thumb'];
                            }
                            if(isset($art_data[$ak]['en_thumb'])&&$art_data[$ak]['en_thumb']!=''){
                                $art_data[$ak]['en_thumb'] = Yii::$app->params['img_domain'] . $art_data[$ak]['en_thumb'];
                            }
                            if(isset($art_data[$ak]['content'])&&$art_data[$ak]['content']!=''){
                                $art_data[$ak]['content'] = htmlspecialchars_decode($art_data[$ak]['content'],ENT_QUOTES);
                            }
                            if(isset($art_data[$ak]['en_content'])&&$art_data[$ak]['en_content']!=''){
                                $art_data[$ak]['en_content'] = htmlspecialchars_decode($art_data[$ak]['en_content'],ENT_QUOTES);
                            }
                            $art_data[$ak]['created_at'] = date('Y-m-d H:i:s',$art_data[$ak]['created_at']);
                            $art_data[$ak]['updated_at'] = date('Y-m-d H:i:s',$art_data[$ak]['updated_at']);
                        }
                        $res[$v] = $art_data;
                    }
                }
            }
            if(isset($res)&&count($res)>0){
                if($language == 'en'){
                    foreach($res as $k=>$v){
                        if(is_array($v)&&count($v)>0){
                            foreach($res[$k] as $kk=>$vv){
                                if(!empty($vv['en_title'])){
                                    $res[$k][$kk]['title'] = $vv['en_title'];
                                }
                                if(!empty($vv['en_thumb'])){
                                    $res[$k][$kk]['thumb'] = $vv['en_thumb'];
                                }
                                if(!empty($vv['en_content'])&&$vv['en_content']!=''&&$vv['en_content']!='<p><br></p>'){
                                    $res[$k][$kk]['content'] = $vv['en_content'];
                                }
                                if(!empty($vv['en_source'])){
                                    $res[$k][$kk]['source'] = $vv['en_source'];
                                }
                                if(!empty($vv['en_author'])){
                                    $res[$k][$kk]['author'] = $vv['en_author'];
                                }
                                if(!empty($vv['en_keywords'])){
                                    $res[$k][$kk]['keywords'] = $vv['en_keywords'];
                                }
                                if(!empty($vv['en_description'])){
                                    $res[$k][$kk]['description'] = $vv['en_description'];
                                }
                            }
                        }
                    }
                }
                $result = $res;
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }
        return $result;
	}
}