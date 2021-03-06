<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Article extends Model
{
    public function getList($type,$page,$limit,$orderby)
    {
        $start = ($page-1)*$limit;
        $sql = "select * from article where category = {$type} and status = 1 order by `{$orderby}` desc limit {$start},{$limit}";//print_r($sql);exit;
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        if(isset($res[0]['id'])){
            foreach($res as $k=>$v){
                $res[$k]['created_at'] = date('Y/m/d H:i:s',$v['created_at']);
                //$res[$k]['path'] = $this->_qiniuDnToken(Yii::$app->params['img_domain'].$v['path']);
            }
        }else{
            $res = false;
        }
        return $res;
    }
    public function getCount($type)
    {
        $sql = "select count(*) as count from article where category = {$type} and status = 1";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        if(isset($res[0]['count'])){
            $res = $res[0]['count'];
        }else{
            $res = 0;
        }
        return $res;
    }

    //七牛获取下载凭证
    public function _qiniuDnToken($baseUrl)
    {
        $accessKey = Yii::$app->params['access_key'];
        $secretKey = Yii::$app->params['secret_key'];

        // 构建Auth对象
        $auth = new Auth($accessKey, $secretKey);

        // 私有空间中的外链 http://<domain>/<file_key>
        //$baseUrl = 'http://if-pri.qiniudn.com/qiniu.png?imageView2/1/h/500';
        // 对链接进行签名
        $signedUrl = $auth->privateDownloadUrl($baseUrl);

        return $signedUrl;
    }
    public function getDetail($id)
    {
        $sql = "select * from article where id = {$id} and status = 1";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        if(isset($res[0]['id'])){
            foreach($res as $k=>$v){
                $res[$k]['created_at'] = date('Y/m/d H:i:s',$v['created_at']);
                //$res[$k]['path'] = $this->_qiniuDnToken(Yii::$app->params['img_domain'].$v['path']);
            }
        }else{
            $res = false;
        }
        return $res;
    }
    public function addReadCount($id)
    {
        $id=intval($id);
        $res = Yii::$app->db->createCommand()->update('article',['read'=>new Expression('`read`+1')],['id'=>$id])->execute();
        if($res&&$res>0){
            $status = true;
        }else{
            $status = false;
        }
        return $status;
    }
}