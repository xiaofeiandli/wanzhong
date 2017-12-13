<?php
namespace frontend\models;

use Yii;
use frontend\models\Base;

class Application extends Base
{
    public function addApplication($postdata)
    {
        $nowtime = time();
        $postdata['created_at'] = $nowtime;
        $postdata['updated_at'] = $nowtime;
        $insert_res = Yii::$app->db->createCommand()->insert('application',$postdata)->execute();
        if($insert_res>0){
            $return_res = Yii::$app->db->getLastInsertId();
        }else{
            $return_res = false;
        }
        return $return_res;
    }
    public function testAdd($postdata)
    {
        $nowtime = time();
        $postdata['created_at'] = $nowtime;
        $postdata['updated_at'] = $nowtime;
        $insert_res = Yii::$app->db->createCommand()->insert('applicator',$postdata)->execute();
        if($insert_res>0){
            $return_res = Yii::$app->db->getLastInsertId();
        }else{
            $return_res = false;
        }
        return $return_res;
    }
    public function getApplyInfo($id)
    {
        $detail_sql = "select * from application where id = {$id}";
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
                $detail_res[0]['created_at']=date('Y-m-d H:i:s',$detail_res[0]['created_at']);
                $detail_res[0]['updated_at']=date('Y-m-d H:i:s',$detail_res[0]['updated_at']);
            }
            $res = $detail_res[0];
        }else{
            $res = false;
        }
        return $res;
    }
    public function getPersonInfo($id,$language = '')
    {
        $detail_sql = "select name,cellphone,certificate_number,email,company,position from application where id = {$id}";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($detail_sql);
        $detail_res = $command->queryAll();
        if(isset($detail_res[0]['name'])){
            $table_str = '<table style="margin-left:130px;border-collapse: collapse;width:300px">';
            if(isset($detail_res[0]['name'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>name:</td><td>'.$detail_res[0]['name'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>姓名:</td><td>'.$detail_res[0]['name'].'</td></tr>';
                }
                
            }
            if(isset($detail_res[0]['cellphone'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>phone:</td><td>'.$detail_res[0]['cellphone'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>手机:</td><td>'.$detail_res[0]['cellphone'].'</td></tr>';
                }
                
            }
            if(isset($detail_res[0]['certificate_number'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>ID NO.:</td><td>'.$detail_res[0]['certificate_number'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>证件号码:</td><td>'.$detail_res[0]['certificate_number'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['email'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>email:</td><td>'.$detail_res[0]['email'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>邮箱:</td><td>'.$detail_res[0]['email'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['company'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>company:</td><td>'.$detail_res[0]['company'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>公司:</td><td>'.$detail_res[0]['company'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['position'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>job title:</td><td>'.$detail_res[0]['position'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>职位:</td><td>'.$detail_res[0]['position'].'</td></tr>';
                }
            }
            if($language == 'en'){
                $table_str = 'Your registration information:'.$table_str.'</table>';
            }else{
                $table_str = '您的参会报名信息如下:'.$table_str.'</table>';
            }
            
            $res = $table_str;
        }else{
            $res = false;
        }
        return $res;
    }
    public function getMediaInfo($id,$language = '')
    {
        $detail_sql = "select name,cellphone,certificate_number,email,company,position,address from application where id = {$id}";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($detail_sql);
        $detail_res = $command->queryAll();
        if(isset($detail_res[0]['name'])){
            $table_str = '<table style="margin-left:130px;border-collapse: collapse;width:300px">';
            if(isset($detail_res[0]['name'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>name:</td><td>'.$detail_res[0]['name'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>姓名:</td><td>'.$detail_res[0]['name'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['cellphone'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>phone:</td><td>'.$detail_res[0]['cellphone'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>手机:</td><td>'.$detail_res[0]['cellphone'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['certificate_number'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>ID NO.:</td><td>'.$detail_res[0]['certificate_number'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>证件号码:</td><td>'.$detail_res[0]['certificate_number'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['email'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>email:</td><td>'.$detail_res[0]['email'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>邮箱:</td><td>'.$detail_res[0]['email'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['company'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>company:</td><td>'.$detail_res[0]['company'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>公司:</td><td>'.$detail_res[0]['company'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['position'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>job title:</td><td>'.$detail_res[0]['position'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>职位:</td><td>'.$detail_res[0]['position'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['address'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>address:</td><td>'.$detail_res[0]['address'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>地址:</td><td>'.$detail_res[0]['address'].'</td></tr>';
                }
            }
            if($language == 'en'){
                $table_str = 'Your registration information:'.$table_str.'</table>';
            }else{
                $table_str = '您的参会报名信息如下:'.$table_str.'</table>';
            }
            $res = $table_str;
        }else{
            $res = false;
        }
        return $res;
    }
    public function getCompanyInfo($id,$language = '')
    {
        $detail_sql = "select company,name,position,cellphone,email,address,website,purpose,area,classes from application where id = {$id}";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($detail_sql);
        $detail_res = $command->queryAll();
        if(isset($detail_res[0]['name'])){
            $table_str = '<table style="margin-left:130px;border-collapse: collapse;width:300px">';
            if(isset($detail_res[0]['company'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>company:</td><td>'.$detail_res[0]['company'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>公司:</td><td>'.$detail_res[0]['company'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['name'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>name:</td><td>'.$detail_res[0]['name'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>姓名:</td><td>'.$detail_res[0]['name'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['position'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>job title:</td><td>'.$detail_res[0]['position'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>职位:</td><td>'.$detail_res[0]['position'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['cellphone'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>phone:</td><td>'.$detail_res[0]['cellphone'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>手机:</td><td>'.$detail_res[0]['cellphone'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['email'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>email:</td><td>'.$detail_res[0]['email'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>邮箱:</td><td>'.$detail_res[0]['email'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['address'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>address:</td><td>'.$detail_res[0]['address'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>地址:</td><td>'.$detail_res[0]['address'].'</td></tr>';
                }
            }
            
            if(isset($detail_res[0]['website'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>website:</td><td>'.$detail_res[0]['website'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td>公司网站:</td><td>'.$detail_res[0]['website'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['purpose'])){
                if($language == 'en'){
                    $table_str .= '<tr><td style="min-width:70px">purpose:</td><td>'.$detail_res[0]['purpose'].'</td></tr>';
                }else{
                    $table_str .= '<tr><td style="min-width:70px">参展目的:</td><td>'.$detail_res[0]['purpose'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['area'])){
                if($language == 'en'){
                    $table_str .= '<tr><td>exhibition area:</td><td>'.str_replace('平米', ' square metre', $detail_res[0]['area']).'</td></tr>';
                }else{
                    $table_str .= '<tr><td>参展面积:</td><td>'.$detail_res[0]['area'].'</td></tr>';
                }
            }
            if(isset($detail_res[0]['classes'])){
                if($language == 'en'){
                    $classes_arr = ['整车'=>'Vehicle','零部件'=>'Spare parts','充电设施'=>'Charging facilities','智能'=>'Intelligence','车联网'=>'Vehicle networking'];
                    $tmp_classes = isset($classes_arr[$detail_res[0]['classes']])&&!empty($classes_arr[$detail_res[0]['classes']])?$classes_arr[$detail_res[0]['classes']]:$detail_res[0]['classes'];
                    $table_str .= '<tr><td>business field:</td><td>'.$tmp_classes.'</td></tr>';
                }else{
                    $table_str .= '<tr><td>参展类别:</td><td>'.$detail_res[0]['classes'].'</td></tr>';
                }
            }
            if($language == 'en'){
                $table_str = 'Your registration information:'.$table_str.'</table>';
            }else{
                $table_str = '您的参会报名信息如下:'.$table_str.'</table>';
            }
            $res = $table_str;
        }else{
            $res = false;
        }
        return $res;
    }
}