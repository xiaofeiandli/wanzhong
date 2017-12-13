<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8"/>
    <title><?= Html::encode($this->title) ?>_GFM后台管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
    <link href="/css/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet">
    <link href="/css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/plugins/components.css" rel="stylesheet">
    <link href="/css/plugins/plugins.css" rel="stylesheet">
    <link href="/css/layout/css/layout.css" rel="stylesheet">
    <link href="/css/layout/css/themes/darkblue.css" rel="stylesheet">
    <?php $this->head() ?>
    <link href="/css/layout/css/custom.css" rel="stylesheet">
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner">
        <div class="page-logo">
            <a href="/">
                <img src="/images/logo.png" alt="logo" style="width: 100px;margin-top: 7px;" class="logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler hide"></div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="glyphicon glyphicon-user"></i>
					<span class="username username-hide-on-mobile" id="nickname">
                    </span>
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default" style="min-width:125px;width: 125px;">
                        <li>
                            <a href="/manager/resetpwd">
                            <i class="glyphicon glyphicon-wrench"></i>修改密码</a>
                        </li>
                        <li>
                            <a href="javascript:;" id="logout">
                            <i class="glyphicon glyphicon-log-out"></i>退出登录</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <ul id='manager' class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="sidebar-toggler-wrapper" style="margin-bottom: 15px;">
                    <div class="sidebar-toggler hidden-phone"></div>
                </li>
                <li <?php if(isset($this->params['item'])&&$this->params['item']=='index'){echo "class='active'";}?>>
                    <a href="/">
                        <i class="glyphicon glyphicon-home"></i>
                        <span class="title">后台总览</span>
                        <?php if(isset($this->params['item'])&&$this->params['item']=='index'){?>
                            <span class="selected"></span>
                        <?php }?>
                    </a>
                </li>
                <?php if($this->params['open']==2){?>
                <li <?php if(isset($this->params['item'])&&$this->params['item']=='navigator'){echo "class='active'";}?>>
                    <a href="/navigator/index">
                        <i class="glyphicon glyphicon-th-large"></i>
                        <span class="title">导航管理</span>
                        <?php if(isset($this->params['item'])&&$this->params['item']=='navigator'){?>
                            <span class="selected"></span>
                        <?php }?>
                    </a>
                </li>
                <li <?php if(isset($this->params['item'])&&$this->params['item']=='category'){echo "class='active'";}?>>
                    <a href="/category/index">
                        <i class="glyphicon glyphicon-th-list"></i>
                        <span class="title">栏目管理</span>
                        <?php if(isset($this->params['item'])&&$this->params['item']=='category'){?>
                            <span class="selected"></span>
                        <?php }?>
                    </a>
                </li>
                <li <?php if(isset($this->params['item'])&&$this->params['item']=='article_list'){echo "class='active'";}?>>
                    <a href="/article/list/1">
                        <i class="glyphicon glyphicon-file"></i>
                        <span class="title">模版文章</span>
                        <?php if(isset($this->params['item'])&&$this->params['item']=='article_list'){?>
                            <span class="selected"></span>
                        <?php }?>
                    </a>
                </li>
                <?php }?>
                <li <?php if(isset($this->params['item'])&&$this->params['item']=='article'){echo "class='active'";}?>>
                    <a href="/article/index/1">
                        <i class="glyphicon glyphicon-pencil"></i>
                        <span class="title">文章管理</span>
                        <?php if(isset($this->params['item'])&&$this->params['item']=='article'){?>
                            <span class="selected"></span>
                        <?php }?>
                    </a>
                </li>
                
                <li <?php if(isset($this->params['item'])&&$this->params['item']=='resource'){echo "class='active'";}?>>
                    <a href="/resource/index">
                        <i class="glyphicon glyphicon-download-alt"></i>
                        <span class="title">下载管理</span>
                        <?php if(isset($this->params['item'])&&$this->params['item']=='resource'){?>
                            <span class="selected"></span>
                        <?php }?>
                    </a>
                </li>
                <li <?php if(isset($this->params['item'])&&$this->params['item']=='application'){echo "class='active'";}?>>
                    <a href="/application/index/0/1">
                        <i class="glyphicon glyphicon-globe"></i>
                        <span class="title">报名管理</span>
                        <?php if(isset($this->params['item'])&&$this->params['item']=='application'){?>
                            <span class="selected"></span>
                        <?php }?>
                    </a>
                </li>
                <li <?php if(isset($this->params['item'])&&$this->params['item']=='manager'){echo "class='active'";}?>>
                    <a href="/manager/index">
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="title">用户管理</span>
                        <?php if(isset($this->params['item'])&&$this->params['item']=='manager'){?>
                            <span class="selected"></span>
                        <?php }?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content" style="min-height:876px">
            <?php if(isset($this->params['item'])&&$this->params['item']!=''){?>
                <div class="page-bar">
                    <?php if(isset($this->params['item'])&&$this->params['item']=='resource'){?>
                    <div class="pull-right">
                        <span class="btn blue" id="images"><i class="fa fa-picture-o"></i> 图片上传</span>
                        <a class="btn blue" data-toggle="modal" href="#pdf_modal"><i class="fa fa-upload"></i> 文件上传</a>
                    </div>
                    <?php }elseif(isset($this->params['item'])&&$this->params['item']=='category'){?>
                    <div class="pull-right">
                        <span class="btn green" id="add_cate"><i class="fa fa-plus"></i> 添加栏目</span>
                    </div>
                    <?php }elseif(isset($this->params['item'])&&$this->params['item']=='navigator'){?>
                    <div class="pull-right">
                        <span class="btn green" id="add_nav" data-toggle="modal" href="#modals"><i class="fa fa-plus"></i> 添加导航</span>
                    </div>
                    <?php }elseif(isset($this->params['item'])&&$this->params['item']=='application'){?>
                    <div class="pull-right">
                        <?php
                            $type = Yii::$app->request->get('type',0);
                            if($type==0){
                                $tmp_name = '个人';
                            }elseif($type==1){
                                $tmp_name = '媒体';
                            }elseif($type==2){
                                $tmp_name = '展商';
                            }else{
                                $tmp_name = '现场';
                            }
                        ?>
                        <?php if($type==3){?>
                        <a class="btn grey-cascade" id="create_qrcode" data-toggle="modal" href="#qrcode_modal"><i class="fa fa-qrcode"></i> 批量生成<?=$tmp_name?>报名二维码
                        </a>
                        <?php }?>
                        <a class="btn grey-cascade" id="down_qrcode" data-toggle="modal" href="<?php if(isset($this->params['application_total'])&&$this->params['application_total']>0){echo '/application/downqrcode/'.$type;}else{echo 'javascript:;';}?>"><i class="fa fa-qrcode"></i> 下载<?=$tmp_name?>报名二维码
                        </a>
                        <a class="btn grey-cascade" id="down_excel" href="<?php if(isset($this->params['application_total'])&&$this->params['application_total']>0){echo '/application/export/'.$type;}else{echo 'javascript:;';}?>" download><i class="fa fa-file-excel-o"></i> 下载<?=$tmp_name?>报名表
                        </a>
                    </div>
                    <?php }?>
                    <ul class="page-breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/">管理后台</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="javascript:"><?= Html::encode($this->title) ?></a></li>
                    </ul>
                </div>
            <?php }?>
            <?php $this->beginBody() ?> <?= $content ?> <?php $this->endBody() ?>
        </div>
    </div>
</div>
<div class="page-footer">
    <div class="page-footer-inner">
        Copyright &copy; 未来出行
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!--[if lt IE 9]>
<script src="/js/plugins/respond.min.js"></script>
<script src="/js/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- GLOBAL -->
<script src="/js/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/js/plugins/jquery.form.js" type="text/javascript"></script>
<script src="/js/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/js/plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/js/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="/js/layout/metronic.js" type="text/javascript"></script>
<script src="/js/layout/layout.js" type="text/javascript"></script>
<!--BLOBAL END-->
<?php if(isset($this->params['item'])&&$this->params['item']=='index'){?>
    <script src="/js/custom/base.js" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function() {
            Metronic.init();
            Layout.init();
        });
    </script>
<?php }?>
<?php if(isset($this->params['item'])&&$this->params['item']=='resource'){?>
    <?php include("../views/layouts/upload.php");?>
    <!--删选排序-->
    <script src="/js/plugins/jquery-mixitup/jquery.mixitup.min.js" type="text/javascript"></script>
    <!--查看原图-->
    <script src="/js/plugins/jquery-fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="/js/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <!--图片加载-->
    <script src="/js/plugins/imagesLoaded.js" type="text/javascript"></script>
    <!--瀑布流-->
    <script src="/js/plugins/masonry.pkgd.min.js" type="text/javascript"></script>
    <script src="/js/plugins/uploader/webuploader.min.js" type="text/javascript"></script>
    <script src="/js/custom/base.js" type="text/javascript"></script>
    <script src="/js/custom/verify.js" type="text/javascript"></script>
    <script src="/js/custom/resource.js" type="text/javascript"></script>
<?php }?>
<?php if(isset($this->params['item'])&&$this->params['item']=='category'){?>
<?php include("../views/layouts/resource.php");?>
    <script src="/js/plugins/bootstrap-summernote/summernote.js" type="text/javascript"></script>
    <script src="/js/plugins/bootstrap-summernote/lang/summernote-zh-CN.js" type="text/javascript"></script>
    <script src="/js/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="/js/custom/base.js" type="text/javascript"></script>
    <script src="/js/custom/verify.js" type="text/javascript"></script>
    <script src="/js/custom/category.js" type="text/javascript"></script>
<?php }?>
<?php if(isset($this->params['item'])&&($this->params['item']=='article'||$this->params['item']=='article_list')){?>

    <script src="/js/plugins/bootstrap-summernote/summernote.js" type="text/javascript"></script>
    <script src="/js/plugins/bootstrap-summernote/lang/summernote-zh-CN.js" type="text/javascript"></script>
    <script src="/js/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="/js/plugins/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="/js/plugins/ladda/ladda.min.js" type="text/javascript"></script>
    <script src="/js/plugins/ladda/spin.min.js" type="text/javascript"></script>
    <script src="/js/custom/base.js" type="text/javascript"></script>
    <script src="/js/custom/verify.js" type="text/javascript"></script>
    <script src="/js/custom/article.js" type="text/javascript"></script>
<?php }?>
<?php if(isset($this->params['item'])&&$this->params['item']=='navigator'){?>
    <script src="/js/custom/base.js" type="text/javascript"></script>
    <script src="/js/custom/verify.js" type="text/javascript"></script>
    <script src="/js/custom/navigator.js" type="text/javascript"></script>
<?php }?>
<?php if(isset($this->params['item'])&&$this->params['item']=='application'){?>
    <script src="/js/custom/base.js" type="text/javascript"></script>
    <script src="/js/custom/verify.js" type="text/javascript"></script>
    <script src="/js/custom/application.js" type="text/javascript"></script>

<?php } ?>
<?php if(isset($this->params['item'])&&$this->params['item']=='manager'){?>
    <script src="/js/custom/base.js" type="text/javascript"></script>
    <script src="/js/custom/verify.js" type="text/javascript"></script>
    <script src="/js/custom/login.js" type="text/javascript"></script>
    <script src="/js/custom/manager.js" type="text/javascript"></script>
<?php }?>
</body>
</html>
<?php $this->endPage() ?>
