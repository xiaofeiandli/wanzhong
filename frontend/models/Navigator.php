<?php
namespace frontend\models;

use Yii;
use frontend\models\Base;

/**
 * 导航
 */
class Navigator extends Base
{
    /**
     * 获取导航信息
     */
    public function getNavigator($class=1,$language = '')
    {
        $data = Yii::$app->db->createCommand("select * from navigator where class={$class} order by weight desc,created_at desc")->queryAll();
        if(is_array($data)&&count($data)>0){
            $active_one_flag = $active_two_flag = 0;
            foreach($data as $k=>$v){
                if($class==1&&strpos($v['url'],'/'.Yii::$app->controller->id)!==false){
                    $data[$k]['active'] = 1;
                    $active_one_flag = 1;
                    break;
                }
                if($k!=0&&$class==2&&strpos('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].substr($v['url'],strpos($v['url'],'#'),strlen($v['url'])),$v['url'])!==false){
                    //$data[$k]['active'] = 1;
                    $active_two_flag = 1;
                    break;
                }
            }
            if($class==1&&$active_one_flag==0&&isset($data[0]['id'])){
                $data[0]['active'] = 1;
            }
            if($class==2&&$active_two_flag==0&&isset($data[0]['id'])){
                //$data[0]['active'] = 1;
            }
            if($language == 'en'){
                foreach($data as $k=>$v){
                    if(!empty($data[$k]['en_name'])){
                        $data[$k]['name'] = $data[$k]['en_name'];
                    }
                    if(isset($_SERVER['REQUEST_URI'])&&strpos($_SERVER['REQUEST_URI'], '/en')!==false&&!empty($data[$k]['url'])&&strpos($data[$k]['url'],'/en')===false){
                        if(strpos($data[$k]['url'],Yii::$app->params['top_domain'])!==false){
                            $data[$k]['url'] = str_replace(Yii::$app->params['top_domain'], Yii::$app->params['top_domain'].'/en', $data[$k]['url']);
                        }
                        if(strpos($data[$k]['url'],Yii::$app->params['top_domain'])===false&&substr($data[$k]['url'], 0, 1 )=='/'&&$data[$k]['url']!='/'){
                            $data[$k]['url'] = '/en'.$data[$k]['url'];
                        }
                        if($data[$k]['url']=='/'){
                            $data[$k]['url'] = '/en';
                        }
                    }
                }
            }
            $res = $data;
        }else{
            $res = false;
        }
        return $res;
    }
    /**
     * 获取导航信息
     */
    public function getNavigatorWhenError($class=1,$language = '')
    {
        $data = Yii::$app->db->createCommand("select * from navigator where class={$class} order by weight desc,created_at desc")->queryAll();
        if(is_array($data)&&count($data)>0){
            $data[0]['active'] = 1;
            if($language == 'en'){
                foreach($data as $k=>$v){
                    if(!empty($data[$k]['en_name'])){
                        $data[$k]['name'] = $data[$k]['en_name'];
                    }
                }
            }
            $res = $data;
        }else{
            $res = false;
        }
        return $res;
    }
}