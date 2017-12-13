<?php
namespace backend\models;

use Yii;
use backend\models\Base;

class Manager extends Base
{
	// 查找管理员(通过名称)
    public static function findAccountByName($manager_name)
    {
        $db = Yii::$app->db;
        $sql = "SELECT * FROM manager WHERE manager_name=:manager_name";
        $command = $db->createCommand($sql, [':manager_name' => $manager_name]);
        $manager = $command->queryOne();
        return $manager;
    }
    // 查找管理员（通过id）
    public static function findAccountById($id)
    {
        $db = Yii::$app->db;
        $sql = "SELECT * FROM manager WHERE id=:id";
        $command = $db->createCommand($sql, [':id' => $id]);
        $manager = $command->queryOne();
        return $manager;
    }
    // 所有管理员
    public static function getAccounts()
    {
        $db = Yii::$app->db;
        $sql = "SELECT * FROM manager where role!=2 order by role desc";
        $command = $db->createCommand($sql);
        $manager = $command->queryAll();
        return $manager;
    }
    // 获取管理员权限
    public static function getRole($id)
    {
        $db = Yii::$app->db;
        $sql = "SELECT role FROM manager where id = {$id}";
        $command = $db->createCommand($sql);
        $role = $command->queryAll();
        if(isset($role[0]['role'])&&in_array($role[0]['role'], [0,1,2])){
            $res = $role[0]['role'];
        }else{
            $res = false;
        }
        return $res;
    }
    // 获取管理员昵称
    public function getManagerName($id)
    {
        $sql = "select manager_name,role from manager where id={$id}";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        if(count($res)>0){
            $res['name'] = $res[0]['manager_name'];
            $res['role'] = $res[0]['role'];
        }else{
            $res = 'admin';
            $res = 0;
        }
        return $res;
	}
	// 添加用户
    public function addManager($username,$password,$email,$auth)
    {
        $insert_res = Yii::$app->db->createCommand()->insert('manager',array('manager_name'=>$username,'manager_email'=>$email,'manager_password'=>$password,'role'=>$auth,'created_at'=>time(),'updated_at'=>time()))->execute();
        if($insert_res==1){
            $status = Yii::$app->db->getLastInsertId();
        }else{
            $status = false;
        }
        return $status;
    }
    // 删除管理员
    public function delManager($id)
    {
        $delete_res = Yii::$app->db->createCommand()->delete('manager', 'id=:id', array(':id' => $id))->execute();
        if(!$delete_res){
            $res = false;
        }else{
            $res = true;
        }
        return $res;
    }
    // 修改管理员密码
    public function changePwd($postdata,$id)
    {
        $updated_at = time();
        $oldpwd = $postdata['opwd'];
        $newpwd = $postdata['npwd'];
        $sql = "select manager_password from manager where id = {$id}";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($sql);
        $manager_res = $command->queryAll();
        $oldpwd = md5($oldpwd);
        $newpwd = md5($newpwd);
        if($manager_res[0]['manager_password'] !=  $oldpwd){
            $ret['status'] = false;
            $ret['msg'] = '旧密码输入错误';
        }else{
            if($manager_res[0]['manager_password'] ==  $newpwd){
                $ret['status'] = false;
                $ret['msg'] = '新密码与旧密码不能一致';
            }else{
                $update_res = Yii::$app->db->createCommand()->update('manager',array('manager_password'=>$newpwd,'updated_at'=>$updated_at),'id=:id',array(':id'=>$id))->execute();
                if($update_res==0){
                    $ret['status'] = false;
                    $ret['msg'] = '修改密码失败！';
                }else{
                    $ret['status'] = true;
                    $ret['msg'] = '修改密码成功！';
                }
            }
        }
        return $ret;
    }
}