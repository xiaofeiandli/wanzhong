<?php
return [
    'application/index/<type:.+>/<page:.+>'=>'application/index',//报名列表
    'application/detail/<id:.+>/<type:.+>'=>'application/detail',//报名详情
    'application/qrcode/<id:.+>'=>'application/qrcode',//报名详情
    'article/index/<page:.+>'=>'article/index',//文章列表
    'article/list/<page:.+>'=>'article/list',//文章列表
    'application/downqrcode/<type:.+>'=>'application/downqrcode',//下载二维码
    'application/export/<type:.+>'=>'application/export',//下载报名表
    'application/sceneqrcode/<begin:.+>/<number:.+>'=>'application/sceneqrcode'//下载现场报名二维码
];