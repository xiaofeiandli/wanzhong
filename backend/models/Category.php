<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * 分类处理
 */
class Category extends Model
{
    /**
     * 获取分类信息
     * @return array
     */
    public function getCategories($role)
    {
        if($role == 2){
            $data = Yii::$app->db->createCommand("select * from category order by created_at desc,flag asc")->queryAll();
        }else{
            $data = Yii::$app->db->createCommand("select * from category where flag='news' order by created_at desc,flag asc")->queryAll();
        }
        if(!is_array($data)||count($data)==0){
            $res = false;
        }else{
            $res = $data;
        }
        return $res;
    }

    /**
     * 获取分类
     * @return array
     */
    public function getCategoriesByRole($isnews)
    {
        if($isnews == 1){
            $data = Yii::$app->db->createCommand("select * from category  where status = 1 and flag='news' order by created_at desc,flag asc")->queryAll();
        }else{
            $data = Yii::$app->db->createCommand("select * from category where status = 1 and flag!='news' order by created_at desc,flag asc")->queryAll();
        }
        if(!is_array($data)||count($data)==0){
            $res = false;
        }else{
            $res = $data;
        }
        return $res;
    }


    /**
     * 删除栏目
     */
    public function delCate($cid)
    {
        $delete_res = Yii::$app->db->createCommand()->delete('category', 'id=:id', array(':id' => $cid))->execute();
        if(!$delete_res){
            $res = false;
        }else{
            $res = true;
        }
        return $res;
    }

    /**
     * 添加栏目
     */
    public function addCate($name,$en_name,$flag,$status)
    {
        $insert_res = Yii::$app->db->createCommand()->insert('category',['name'=>$name,'en_name'=>$en_name,'flag'=>$flag,'status'=>$status,'created_at'=>time(),'updated_at'=>time()])->execute();
        if(!$insert_res){
            $status = false;
        }else{
            $status = true;
        }
        return $status;
    }

    /**
     * 修改栏目
     */
    public function editCate($cid,$name,$en_name,$flag,$status)
    {
        $res = Yii::$app->db->createCommand()->update('category',['name'=>$name,'en_name'=>$en_name,'flag'=>$flag,'status'=>$status,'updated_at'=>time()],['id'=>$cid])->execute();
        if(!$res){
            $status = false;
        }else{
            $status = true;
        }
        return $status;
    }

    /**
     * 检查栏目中文名是否已存在
     */
    public function checkName($name,$cid=0)
    {
        if($cid>0){
            $data = Yii::$app->db->createCommand("select count(*) as count from category where name = '{$name}' and id != {$cid}")->queryAll();
        }else{
            $data = Yii::$app->db->createCommand("select count(*) as count from category where name = '{$name}'")->queryAll();
        }
        if(isset($data[0]['count'])&&$data[0]['count']>0){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 检查栏目标识
     */
    public function checkFlag($flag,$cid=0)
    {
        if($cid>0){
            $data = Yii::$app->db->createCommand("select count(*) as count from category where flag = '{$flag}' and flag != 'news' and id!={$cid}")->queryAll();
        }else{
            $data = Yii::$app->db->createCommand("select count(*) as count from category where flag = '{$flag}' and flag != 'news'")->queryAll();
        }
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
    public function checkEnName($en_name,$cid=0)
    {
        if($cid>0){
            $data = Yii::$app->db->createCommand("select count(*) as count from category where en_name = '{$en_name}' and id!={$cid}")->queryAll();
        }else{
            $data = Yii::$app->db->createCommand("select count(*) as count from category where en_name = '{$en_name}'")->queryAll();
        }
        if(isset($data[0]['count'])&&$data[0]['count']>0){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }

    /**
     * 获取栏目信息
     */
    public function getCate($cid)
    {
        $data = Yii::$app->db->createCommand("select * from category where id = {$cid}")->queryAll();
        if(is_array($data)&&count($data)>0){
            $res = $data[0];
        }else{
            $res = false;
        }
        return $res;
    }


    /**
     * 检查栏目是否已在导航中应用
     */
    public function checkEditIsNav($cid)
    {
        $data = Yii::$app->db->createCommand("select is_nav from category where id = {$cid}")->queryAll();
        if(isset($data[0]['is_nav'])&&$data[0]['is_nav']==1){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 修改栏目状态
     * @return int/boolean
     */
    public function changeEditStatus($cid,$status)
    {
        $res = Yii::$app->db->createCommand()->update('category',array('status'=>$status),array('id'=>$cid))->execute();
        if(!$res){
            $status = false;
        }else{
            $status = true;
        }
        return $status;
    }

    /**
     * 检查是否有新闻
     */
    public function hasArticle($cid)
    {
        $data = Yii::$app->db->createCommand("select category_id from article")->queryAll();
        if(is_array($data)&&count($data)>0){
            $tmp_arr = [];
            foreach($data as $k=>$v){
                $tmp_arr[] = $v['category_id'];
            }
            $tmp_str = ','.join(',',$tmp_arr).',';
            if(strpos($tmp_str,','.$cid.',')!==false){
                $res = true;
            }else{
                $res = false;
            }
        }else{
            $res = false;
        }
        return $res;
    }

}
