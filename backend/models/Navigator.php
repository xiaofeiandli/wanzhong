<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * 导航
 */
class Navigator extends Model
{
    /**
     * 获取导航信息
     */
    public function getNavigators()
    {
        $data = Yii::$app->db->createCommand("select * from navigator where class=1 order by weight desc,created_at desc")->queryAll();
        if(is_array($data)&&count($data)>0){
            foreach($data as $k=>$v){
                $id = $v['id'];
                $data[$k]['class_two'] = 0;
                $class_two = Yii::$app->db->createCommand("select count(*) as count from navigator where class=2 and parent_id={$id}")->queryAll();
                if(isset($class_two[0]['count'])&&$class_two[0]['count']>0){
                    $data[$k]['class_two'] = $class_two[0]['count'];
                }else{
                    $data[$k]['class_two'] = 0;
                }
            }
            $res = $data;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 获取导航个数
     */
    public function getNavCounts()
    {
        $data = Yii::$app->db->createCommand("select count(*) as count from navigator")->queryAll();
        if(isset($data[0]['count'])&&count($data[0]['count'])>0){
            $res = $data[0]['count'];
        }else{
            $res = 0;
        }
        return $res;
    }
    /**
     * 获取二级导航信息
     */
    public function getNavigatorsOfClassTwo()
    {
        $data = Yii::$app->db->createCommand("select * from navigator where class=2 order by parent_id asc,weight desc,created_at desc")->queryAll();
        if(is_array($data)&&count($data)>0){
            foreach($data as $k=>$v){
                $data[$k]['class_one'] = $this->getNavNameById($v['parent_id']);
            }
            $res = $data;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 判断一级导航下是否存在二级导航信息
     */
    public function hasClassTwo($nid)
    {
        $data = Yii::$app->db->createCommand("select count(*) as count from navigator where class=2 and parent_id = {$nid}")->queryAll();
        if(isset($data[0]['count'])&&$data[0]['count']>0){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 根据id获取导航名
     */
    public function getNavNameById($nid)
    {
        $data = Yii::$app->db->createCommand("select name from navigator where id={$nid}")->queryAll();
        if(isset($data[0]['name'])&&!empty($data[0]['name'])){
            $res = $data[0]['name'];
        }else{
            $res = '';
        }
        return $res;
    }


    /**
     * 获取一级导航信息
     */
    public function getClassOne()
    {
        $data = Yii::$app->db->createCommand("select * from navigator where class = 1 order by weight desc")->queryAll();
        if(!is_array($data)||count($data)==0){
            $res = false;
        }else{
            $res = $data;
        }
        return $res;
    }
    /**
     * 获取导航信息
     */
    public function getNav($id)
    {
        $data = Yii::$app->db->createCommand("select * from navigator where id={$id}")->queryAll();
        if(!is_array($data)||count($data)==0){
            $res = false;
        }else{
            $res = $data[0];
        }
        return $res;
    }


    /**
     * 添加导航
     */
    public function addNav($name,$en_name,$url,$weight,$class,$pid)
    {
        $insert_res = Yii::$app->db->createCommand()->insert('navigator',['name'=>$name,'en_name'=>$en_name,'url'=>$url,'weight'=>$weight,'class'=>$class,'parent_id'=>$pid,'created_at'=>time(),'updated_at'=>time()])->execute();
        if(!$insert_res){
            $status = false;
        }else{
            $status = true;
        }
        return $status;
    }

    /**
     * 修改导航
     */
    public function editNav($nid,$name,$en_name,$url,$weight,$class,$pid)
    {
        $res = Yii::$app->db->createCommand()->update('navigator',['name'=>$name,'en_name'=>$en_name,'url'=>$url,'weight'=>$weight,'class'=>$class,'parent_id'=>$pid,'updated_at'=>time()],['id'=>$nid])->execute();
        if(!$res){
            $status = false;
        }else{
            $status = true;
        }
        return $status;
    }

    /**
     * 检查导航中文名是否已存在
     */
    public function checkName($name,$nid=0)
    {
        if($nid>0){
            $data = Yii::$app->db->createCommand("select count(*) as count from navigator where name = '{$name}' and id!={$nid}")->queryAll();
        }else{
            $data = Yii::$app->db->createCommand("select count(*) as count from navigator where name = '{$name}'")->queryAll();
        }
        if(isset($data[0]['count'])&&$data[0]['count']>0){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }

    /**
     * 检查导航英文名是否已存在
     */
    public function checkEnName($en_name,$nid=0)
    {
        if($nid>0){
            $data = Yii::$app->db->createCommand("select count(*) as count from navigator where en_name = '{$en_name}' and id!={$nid}")->queryAll();
        }else{
            $data = Yii::$app->db->createCommand("select count(*) as count from navigator where en_name = '{$en_name}'")->queryAll();
        }
        if(isset($data[0]['count'])&&$data[0]['count']>0){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 删除导航
     */
    public function delNav($nid)
    {
        $delete_res = Yii::$app->db->createCommand()->delete('navigator', 'id=:id', array(':id' => $nid))->execute();
        if(!$delete_res){
            $res = false;
        }else{
            $res = true;
        }
        return $res;
    }

}
