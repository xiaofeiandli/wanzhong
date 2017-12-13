<?php
$this->title = '页面未找到';
$this->registerCssFile("@web/css/global/plugins/font-awesome/css/font-awesome.min.css");
$this->registerCssFile("@web/css/global/plugins/bootstrap/css/bootstrap.min.css");
$this->registerCssFile("@web/css/admin/pages/css/error.css");
$this->registerCssFile("@web/css/global/css/components.css");
$this->registerCssFile("@web/css/admin/layout/css/layout.css");
$this->registerCssFile("@web/css/admin/layout/css/themes/darkblue.css");
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/">管理后台</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="javascript:;">404 Page</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12 page-404">
        <div class="number">
            404
        </div>
        <div class="details">
            <h2>页面未找到.</h2>
        </div>
    </div>
</div>