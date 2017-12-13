<?php
namespace frontend\models;

use Yii;
use frontend\models\Base;

/**
 * 新闻
 */
class Category extends Base
{
    /**
     * 获取新闻分类信息
     */
    public function getNewsCate()
    {
        $data = Yii::$app->db->createCommand("select * from category where flag='news'")->queryAll();
        if(isset($data[0]['id'])){
            $res = $data;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 获取新闻分类信息
     */
    public function checkId($id)
    {
        $data = Yii::$app->db->createCommand("select id from category where id={$id} and flag='news'")->queryAll();
        if(isset($data[0]['id'])){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 获取未来出行说id
     */
    public function getWlcxsUrl()
    {
        $data = Yii::$app->db->createCommand("select id from category where name='未来出行说'")->queryAll();
        if(isset($data[0]['id'])&&intval($data[0]['id'])>0){
            $url = '/news/grid/'.$data[0]['id'];
        }else{
            $url = '/news/grid/0';
        }
        return $url;
    }
}