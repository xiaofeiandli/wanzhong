<?php
namespace frontend\models;

use Yii;
use yii\web\UploadedFile;
use frontend\models\Base;

/**
 * 资源上传
 */
class Upload extends Base
{
    public $errorCode=0;//错误代码
    public $allowMaxSize = 100;//单位用M
    public $ext;//文件的后缀
    public $newPath;//新的路径

    /**
     * 执行文件上传
     * @param  string $imgName 图片标签名称
     * @param  string $type 文件类型 image/pdf
     * @param  intval $allowMaxSize 文件最大值
     * @return array/boolean
     */
    public function imgUploads($imgName,$type = 'image',$use = 'download',$allowMaxSize = 100)
    {
        global $imageName;
        $imageName = $_FILES[$imgName];
		if($type == 'image'){
			$allowType = array('image/jpg','image/png','image/jpeg','image/gif');
		}elseif($type == 'pdf'){
			$allowType = array('application/pdf');
		}
        if(!$this->checkFile()){//没有文件上传
            $this->errorCode = 1;
            return false;
        }
        if(!$this->checkError()){//检测上传错误代码
            $this->errorCode = 2;
            return false;
        }
        if(!$this->checkType($allowType)){//检测文件类型
            $this->errorCode = 3;
            return false;
        }
        if(!$this->checkSize($allowMaxSize)){//检测文件大小
            $this->errorCode = 4;
            return false;
        }
        if(!$this->checkDir($type,$use)){//检测目录
            $this->errorCode = 5;
            return false;
        }
        if(!$this->saveFile($type,$use)){//保存文件
            $this->errorCode = 6;
            return false;
        }
        return true;
    }

    //检查文件是否上传
    private function checkFile()
    {
        if(empty($_FILES)){//检测文件
            return false;
        }
        return true;
    }

	//检测上传错误代码
    private function checkError()
    {
        global $imageName;
        if($imageName['error'] != 0){//如果出现错误返回false
            return false;
        }
        return true;
    }

    //检测文件类型
    private function checkType($allowType)
    {
        global $imageName;
        $this->ext = ltrim(strrchr($imageName['name'],'.'),'.');//获取文件的后缀名
        if(!in_array($imageName['type'],$allowType)){//非法的类型
            return false;
        }
        return true;
    }

    //检测文件大小
    private function checkSize($allowMaxSize)
    {
        global $imageName;
        $allowKb = $allowMaxSize*1024*1024;//允许的最大字节数
        if($imageName['size'] > $allowKb){//大小超限
            return false;
        }
        return true;
    }

    //检测上传目录
    private function checkDir($type,$use)
    {
    	$uploadDir = Yii::$app->params['upload_dir'] . $use . '/' . $type . '/' . date('ymd',time()) . '/';
        if(!is_dir($uploadDir)){//检测是否为目录
            if(!mkdir($uploadDir,0755,true)){//没有创建成功
                return false;
            }
            return true;
        }else{
            if(!is_writeable($uploadDir)){
                return false;
            }
            return true;
        }
    }

    //保存文件
    private function saveFile($type,$use)
    {
        global $imageName;
        $file = $imageName['tmp_name'];//临时上传文件
    	$uploadDir = Yii::$app->params['upload_dir'] . $use . '/' . $type . '/' . date('ymd',time()) . '/';
        $newName = $uploadDir . md5(time()+rand(1,1000)).'.'.$this->ext;//文件储存路径+名称
        if(!move_uploaded_file($file,$newName)){//上传失败
            return false;
        }else{//上传成功
            $this->newPath = $newName;
            return true;
        }
    }

    //获取错误信息
    public function getErrorMessage()
    {//获取错误信息
        $msg = "";//
        switch($this->errorCode){
            case 1:
                $msg = '没有文件上传';
                break;
            case 2:
                $msg = '发生系统错误';
                break;
            case 3:
                $msg = '非法类型';
                break;
            case 4:
                $msg = '大小超出限制';
                break;
            case 5:
                $msg = "上传目录不存在或者不可写";
                break;
            case 6:
                $msg = "文件保存失败";
                break;
        }
        return $msg;
    }
}
