<?php
namespace backend\models;

use Yii;
use backend\models\Base;

class Resource extends Base
{
	/**
     * 获取资源库中的图片
     */
    public function getPictures()
    {
        $res = Yii::$app->db->createCommand("select * from resource where type = 'image' order by created_at desc")->queryAll();
        if(count($res)==0){
            $res = false;
        }else{
            foreach($res as $k=>$v){
                $res[$k]['path'] = Yii::$app->params['img_domain'] . $v['path'];
                $res[$k]['thumb'] = Yii::$app->params['img_domain'] . $v['path'];
            }
        }
        return $res;
    }
    /**
     * 获取资源库中的图片数量
     */
    public function getPicCount()
    {
        $res = Yii::$app->db->createCommand("select count(*) as count from resource where type = 'image'")->queryAll();
        if(isset($res[0]['count'])){
            $result = $res[0]['count'];
        }else{
            $result = 0;
        }
        return $result;
    }
    /**
     * 获取资源库中的视频数量
     */
    public function getVideoCount()
    {
        $res = Yii::$app->db->createCommand("select count(*) as count from resource where type = 'video'")->queryAll();
        if(isset($res[0]['count'])){
            $result = $res[0]['count'];
        }else{
            $result = 0;
        }
        return $result;
    }
    /**
     * 获取资源库中的音频数量
     */
    public function getAudioCount()
    {
        $res = Yii::$app->db->createCommand("select count(*) as count from resource where type = 'audio'")->queryAll();
        if(isset($res[0]['count'])){
            $result = $res[0]['count'];
        }else{
            $result = 0;
        }
        return $result;
    }
    /**
     * 获取资源库中的视频
     */
    public function getVideo()
    {
        $res = Yii::$app->db->createCommand("select * from resource where type = 'video' order by created_at desc")->queryAll();
        if(count($res)==0){
            $res = false;
        }else{
            foreach($res as $k=>$v){
                $res[$k]['path'] = Yii::$app->params['img_domain'] . $v['path'];
                $res[$k]['thumb'] = Yii::$app->params['img_domain'] . $v['path'];
            }
        }
        return $res;
    }
    /**
     * 获取资源库中的音频
     */
    public function getAudio()
    {
        $res = Yii::$app->db->createCommand("select * from resource where type = 'audio' order by created_at desc")->queryAll();
        if(count($res)==0){
            $res = false;
        }else{
            foreach($res as $k=>$v){
                $res[$k]['path'] = Yii::$app->params['img_domain'] . $v['path'];
                $res[$k]['thumb'] = Yii::$app->params['img_domain'] . $v['path'];
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
                $download[] = ['url'=>Yii::$app->params['img_domain'].$res[0]['path'],'name'=>$res[0]['name']];
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
     * 判断资源库中是否存在图片
     */
    public function issetPictures()
    {
        $res = Yii::$app->db->createCommand("select count(*) as count from resource where type = 'image'")->queryAll();
        if(isset($res[0]['count'])&&$res[0]['count']>0){
            $count = $res[0]['count'];
        }else{
            $count = 0;
        }
        return $count;
    }
    /**
     * 判断资源库中是否存在文档
     */
    public function issetDocuments()
    {
        $res = Yii::$app->db->createCommand("select count(*) as count from resource where type = 'pdf'")->queryAll();
        if(isset($res[0]['count'])&&$res[0]['count']>0){
            $count = $res[0]['count'];
        }else{
            $count = 0;
        }
        return $count;
    }
    /**
     * 获取资源库中的文档
     */
    public function getDocuments()
    {
        $res = Yii::$app->db->createCommand("select * from resource where type = 'pdf' order by created_at desc")->queryAll();
        if(count($res)==0){
            $res = false;
        }else{
            foreach($res as $k=>$v){
                $res[$k]['path'] = Yii::$app->params['img_domain'] . $v['path'];
            }
        }
        return $res;
    }
    /**
     * 资源储存
     */
    public function savePic($path,$type,$name,$desc)
    {
        $insert_res = Yii::$app->db->createCommand()->insert('resource',array('path'=>$path,'type'=>$type,'name'=>$name,'created_at'=>time()))->execute();
        if($insert_res==1){
            $status = true;
        }else{
            $status = false;
        }
        return $status;
    }

    /**
     * 检查栏目中文名是否已存在
     */
    public function checkName($name)
    {
        $data = Yii::$app->db->createCommand("select count(*) as count from resource where name = '{$name}'")->queryAll();
        if(isset($data[0]['count'])&&$data[0]['count']>0){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }

    /**
     * 检查栏目英文名是否已存在
     */
    public function checkEnName($en_name)
    {
        $data = Yii::$app->db->createCommand("select count(*) as count from resource where en_name = '{$en_name}'")->queryAll();
        if(isset($data[0]['count'])&&$data[0]['count']>0){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }
    // 删除资源
    public function delResource($id)
    {
        $delete_res = Yii::$app->db->createCommand()->delete('resource', 'id=:id', array(':id' => $id))->execute();
        if(!$delete_res){
            $res = false;
        }else{
            $res = true;
        }
        return $res;
    }

}