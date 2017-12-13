<?php
namespace backend\models;

use Yii;
use backend\models\Base;

class Application extends Base
{
     /**
     * 获取报名列表
     */
    public function getApplication($type,$page,$getdata)
    {
        $start = ($page-1)*10;
        if($getdata['name']==''&&$getdata['cellphone']==''&&$getdata['signin_at']==''){
            $where_str = '';
        }else{
            $where = array();
            if($getdata['name']!=''){
                $where[] = " name like '%{$getdata['name']}%'";
            }
            if($getdata['cellphone']!=''){
                $where[] = " cellphone like '%{$getdata['cellphone']}%'";
            }
            if($getdata['signin_at']!=''){

                if($getdata['signin_at']==0){
                    $where[] = " signin_at = 0";
                }else{
                    $where[] = " signin_at > 0";
                }
            }
            if(count($where)>=2){
                $where_str = ' and'.implode(' and ',$where);
            }elseif(count($where)==1){
                $where_str = ' and'.$where[0];
            }else{
                $where_str = '';
            }
        }
        $application_sql = "select * from application where type={$type} {$where_str} limit {$start},10";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($application_sql);
        $application_res = $command->queryAll();
        if(count($application_res)>0){
            foreach($application_res as $ak=>$av){
                switch($application_res[$ak]['certificate_type']){
                    case 0:
                        $application_res[$ak]['certificate_type']='身份证';
                        break;
                    default:
                        $application_res[$ak]['certificate_type']='其他';
                        break;
                }
                $application_res[$ak]['created_at']=date('Y-m-d H:i:s',$application_res[$ak]['created_at']);
                $application_res[$ak]['updated_at']=date('Y-m-d H:i:s',$application_res[$ak]['updated_at']);
            }
        }else{
            $application_res = false;
        }

        return $application_res;
    }

    /**
     * 获取现场观众报名列表
     */
    public function getScene($page)
    {
        $start = ($page-1)*10;
        $application_sql = "select * from scene limit {$start},10";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($application_sql);
        $application_res = $command->queryAll();
        if(count($application_res)>0){
            foreach($application_res as $ak=>$av){
                $application_res[$ak]['created_at']=date('Y-m-d H:i:s',$application_res[$ak]['created_at']);
                if($application_res[$ak]['signin_at']>0){
                    $application_res[$ak]['signin_at']=date('Y-m-d H:i:s',$application_res[$ak]['signin_at']);
                }
                if(file_exists(Yii::$app->params['upload_dir'].'scene_qrcode/'.$application_res[$ak]['id'].'.png')){
                    $application_res[$ak]['qrcode'] = Yii::$app->params['img_domain'].'scene_qrcode/'.$application_res[$ak]['id'].'.png';
                }else{
                    $application_res[$ak]['qrcode'] = '';
                }
            }
        }else{
            $application_res = false;
        }
        return $application_res;
    }

    /**
     * 查询现场观众库中最后一个id
     */
    public function getLastSceneId()
    {
        $res = Yii::$app->db->createCommand("select id from scene order by id desc limit 1")->queryAll();
        if(isset($res[0]['id'])){
            $result = $res[0]['id'];
        }else{
            $result = 0;
        }
        return $result;
    }

    /**
     * 储存现场生成的用户信息
     */
    public function saveSceneUser($id)
    {
        $insert_res = Yii::$app->db->createCommand()->insert('scene',['name'=>'现场观众'.$id,'created_at'=>time()])->execute();
        if($insert_res>0){
            $return_res = Yii::$app->db->getLastInsertId();
        }else{
            $return_res = false;
        }
        return $return_res;
    }

    /**
     * 报名列表(所有)
     */
    public function getApplicationForRedis()
    {
        $application_sql = "select * from application";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($application_sql);
        $application_res = $command->queryAll();
        if(count($application_res)>0){
            foreach($application_res as $ak=>$av){
                switch($application_res[$ak]['certificate_type']){
                    case 0:
                        $application_res[$ak]['certificate_type']='身份证';
                        break;
                    default:
                        $application_res[$ak]['certificate_type']='其他';
                        break;
                }
                $application_res[$ak]['created_at']=date('Y-m-d H:i:s',$application_res[$ak]['created_at']);
                $application_res[$ak]['updated_at']=date('Y-m-d H:i:s',$application_res[$ak]['updated_at']);
            }
        }else{
            $application_res = false;
        }

        return $application_res;
    }
    /**
     * 获取报名所有数据
     */
    public function getApplications($type)
    {
        $application_sql = "select * from application where type={$type}";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($application_sql);
        $application_res = $command->queryAll();
        if(isset($application_res)&&count($application_res)>0){
            foreach($application_res as $ak=>$av){
                switch($application_res[$ak]['certificate_type']){
                    case 0:
                        $application_res[$ak]['certificate_type']='身份证';
                        break;
                    default:
                        $application_res[$ak]['certificate_type']='其他';
                        break;
                }
                $application_res[$ak]['created_at']=date('Y-m-d H:i:s',$application_res[$ak]['created_at']);
                $application_res[$ak]['updated_at']=date('Y-m-d H:i:s',$application_res[$ak]['updated_at']);
                switch($application_res[$ak]['type']){
                    case 1:
                        $application_res[$ak]['type']='媒体报名';
                        break;
                    case 2:
                        $application_res[$ak]['type']='展商报名';
                        break;
                    default:
                        $application_res[$ak]['type']='个人报名';
                        break;
                }
            }
            $res = $application_res;
        }else{
            $res = false;
        }

        return $res;
    }

    /**
     * 获取报名所有数据
     */
    public function getApplicationsByType($type)
    {
        $application_sql = "select * from application where type = '{$type}'";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($application_sql);
        $application_res = $command->queryAll();
        if(isset($application_res)&&count($application_res)>0){
            foreach($application_res as $ak=>$av){
                switch($application_res[$ak]['certificate_type']){
                    case 0:
                        $application_res[$ak]['certificate_type']='身份证';
                        break;
                    default:
                        $application_res[$ak]['certificate_type']='其他';
                        break;
                }
                $application_res[$ak]['created_at']=date('Y-m-d H:i:s',$application_res[$ak]['created_at']);
                $application_res[$ak]['updated_at']=date('Y-m-d H:i:s',$application_res[$ak]['updated_at']);
            }
            $res = $application_res;
        }else{
            $res = false;
        }

        return $res;
    }
    /**
     * 获取报名列表总数信息
     */
    public function getCounts($type,$getdata)
    {
        if($getdata['name']==''&&$getdata['cellphone']==''&&$getdata['signin_at']==''){
            $where_str = '';
        }else{
            $where = array();
            if($getdata['name']!=''){
                $where[] = " name like '%{$getdata['name']}%'";
            }
            if($getdata['cellphone']!=''){
                $where[] = " cellphone like '%{$getdata['cellphone']}%'";
            }
            if($getdata['signin_at']!=''){

                if($getdata['signin_at']==0){
                    $where[] = " signin_at = 0";
                }else{
                    $where[] = " signin_at > 0";
                }
            }
            if(count($where)>=2){
                $where_str = ' and'.implode(' and ',$where);
            }elseif(count($where)==1){
                $where_str = ' and'.$where[0];
            }else{
                $where_str = '';
            }
        }
        $counts_sql = "select count(*) as total from application where type = {$type} {$where_str}";
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
     * 获取各类报名数目
     */
    public function getEveryCounts()
    {
        $one = Yii::$app->db->createCommand("select count(*) as count from application where type = 0")->queryAll();
        $two = Yii::$app->db->createCommand("select count(*) as count from application where type = 1")->queryAll();
        $three = Yii::$app->db->createCommand("select count(*) as count from application where type = 2")->queryAll();
        $four = Yii::$app->db->createCommand("select count(*) as count from scene")->queryAll();
        $res[0] = $res[1] = $res[2] = $res[3] = 0;
        if(isset($one[0]['count'])&&count($one[0]['count'])>0){
            $res[0]=$one[0]['count'];
        }
        if(isset($two[0]['count'])&&count($two[0]['count'])>0){
            $res[1]=$two[0]['count'];
        }
        if(isset($three[0]['count'])&&count($three[0]['count'])>0){
            $res[2]=$three[0]['count'];
        }
        if(isset($four[0]['count'])&&count($four[0]['count'])>0){
            $res[3]=$four[0]['count'];
        }
        return $res;
    }
    
    /**
     * 获取报名详情
     * @return array
     */
    public function getDetails($aid)
    {
        $detail_sql = "select * from application where id = {$aid}";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($detail_sql);
        $detail_res = $command->queryAll();
        if(isset($detail_res[0]['id'])){
            switch($detail_res[0]['certificate_type']){
                case 0:
                    $detail_res[0]['certificate_type']='身份证';
                    break;
                default:
                    $detail_res[0]['certificate_type']='其他';
                    break;
            }
            $detail_res[0]['created_at']=date('Y-m-d H:i:s',$detail_res[0]['created_at']);
            $detail_res[0]['updated_at']=date('Y-m-d H:i:s',$detail_res[0]['updated_at']);
            if($detail_res[0]['card']!=''&&strpos($detail_res[0]['card'],Yii::$app->params['img_domain'])===false){
                $detail_res[0]['card'] = Yii::$app->params['img_domain'].$detail_res[0]['card'];
            }
            if(file_exists(Yii::$app->params['upload_dir'].'qrcode/'.$detail_res[0]['id'].'.png')){
                $detail_res[0]['qrcode'] = Yii::$app->params['img_domain'].'qrcode/'.$detail_res[0]['id'].'.png';
            }
            $res = $detail_res[0];
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 获取现场观众报名详情
     * @return array
     */
    public function getSceneDetails($aid)
    {
        $detail_sql = "select * from scene where id = {$aid}";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($detail_sql);
        $detail_res = $command->queryAll();
        if(isset($detail_res[0]['id'])){
            $detail_res[0]['created_at']=date('Y-m-d H:i:s',$detail_res[0]['created_at']);
            if(file_exists(Yii::$app->params['upload_dir'].'scene_qrcode/'.$detail_res[0]['id'].'.png')){
                $detail_res[0]['qrcode'] = Yii::$app->params['img_domain'].'scene_qrcode/'.$detail_res[0]['id'].'.png';
            }
            $res = $detail_res[0];
        }else{
            $res = false;
        }
        return $res;
    }
    //修改签到时间
    public function changeSignin($aid){
        $signin_at = time();
        $update_res = Yii::$app->db->createCommand()->update('application',array('signin_at'=>$signin_at),'id=:aid',array(':aid'=>$aid))->execute();
        if($update_res>0){
            $ret = true;
        }else{
            $ret = false;
        }
        return $ret;
    }
    //修改现场观众签到时间
    public function changeSceneSignin($aid){
        $signin_at = time();
        $update_res = Yii::$app->db->createCommand()->update('scene',array('signin_at'=>$signin_at),'id=:aid',array(':aid'=>$aid))->execute();
        if($update_res>0){
            $ret = true;
        }else{
            $ret = false;
        }
        return $ret;
    }

}