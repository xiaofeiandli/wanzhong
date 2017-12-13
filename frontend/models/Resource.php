<?php
namespace frontend\models;

use Yii;
use frontend\models\Base;

class Resource extends Base
{
    /**
     * 获取资源详情
     */
    public function getResource($id,$language = '')
    {
        $res = Yii::$app->db->createCommand("select * from resource where id={$id}")->queryAll();
        if(!isset($res[0]['id'])){
            $result = false;
        }else{
            $res[0]['size'] = @filesize(Yii::$app->params['upload_dir'].$res[0]['path']);
            if(isset($res[0]['size'])&&intval($res[0]['size'])>0){
                $res[0]['size'] = $res[0]['size']/(1024);
                if(strpos($res[0]['size'],'.')!==false){
                    $res[0]['size'] = explode('.', $res[0]['size'])[0];
                    if($res[0]['size']>=1024){
                        $res[0]['size'] = round($res[0]['size']/1024,2) .'MB';
                    }else{
                        $res[0]['size'] = $res[0]['size'] .'KB';
                    }
                }
            }
            if($language == 'en'&&!empty($res[0]['en_name'])){
                $res[0]['name'] = $res[0]['en_name'];
            }
            $res[0]['path'] = Yii::$app->params['img_domain'] . $res[0]['path'];
            $res[0]['thumb'] = Yii::$app->params['img_domain'] . $res[0]['thumb'];
            $result = $res[0];
        }
        return $result;
    }   
	/**
     * 获取资源库中的图片
     */
    public function getPictures()
    {
        $res = Yii::$app->db->createCommand("select * from resource where type = 'image' order by created_at desc")->queryAll();
        if(!isset($res[0]['id'])){
            $res = false;
        }else{
            foreach($res as $k=>$v){
                $res[$k]['thumb'] = Yii::$app->params['img_domain'] . $v['thumb'];
            }
        }
        return $res;
    }
    /**
     * 获取资源库中的文档
     */
    public function getDocuments($language='')
    {
        $res = Yii::$app->db->createCommand("select * from resource where type = 'pdf' order by created_at desc")->queryAll();
        if(!isset($res[0]['id'])){
            $res = false;
        }else{
            foreach($res as $k=>$v){
                $res[$k]['path'] = Yii::$app->params['img_domain'] . $v['path'];
            }
            if($language == 'en'){
                $res[$k]['name'] = $res[$k]['en_name'];
            }
        }
        return $res;
    }
    
    /**
     * 通过id获取资源库中的资源
     */
    public function getResourceByIds($ids_arr,$type)
    {   
        $download = [];
        foreach($ids_arr as $k=>$v){
            $res = Yii::$app->db->createCommand("select path,name,en_name from resource where type = '{$type}' and id = ".intval($v))->queryAll();
            if(isset($res[0]['path'])&&!empty($res[0]['path'])){
                $download[] = ['url'=>Yii::$app->params['upload_dir'].$res[0]['path'],'name'=>$res[0]['name']];
            }
        }
        if(count($download)>0){
            $result = $download;
        }else{
            $result =false;
        }
        return $result;
    }
    /**
     * 检测id是否存在
     */
    public function checkId($id)
    {
        $data = Yii::$app->db->createCommand("select id from resource where id={$id}")->queryAll();
        if(isset($data[0]['id'])){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }
}