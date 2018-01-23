/**
 * 播放列表
 * @type {Array}
 * 请用数组来定义总列表
 * 再用二维数组定义每个列表
 * 其中列表里的每首歌需用对象定义
 * 请在每个列表中的第一个元素定义列表信息（必须位于第一位）
 * 列表信息必须有一个basic属性，值为true
 * 还要有一个name属性，值为列表名称
 * 可选参数为singer、image，用于为定义的该属性的歌曲调用
 * 每首歌必须有name、src、lrc三个属性
 * src为歌曲相对于index.html的相对路径或绝对路径
 * 可选singer和image属性
 * 在每首歌没有定义singer或image时将使用列表的singer或image
 * 请确保一定有一个被定义
 * 其中name为歌曲名称
 * src为歌曲文件路径
 * lrc为歌词，请用\n或\r将每行歌词隔开，否则无法识别
 */
var mplayer_song = [
    [{
            "basic": true,
            "name": "2016单曲集",
            "singer": "许嵩",
            "img": "https://y.gtimg.cn/music/photo_new/T001R300x300M000000CK5xN3yZDJt.jpg"
        },
        {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
            "lrc": "[ti:一睁眼]\n[ar:沈玮琦]\n[al:一睁眼]\n[by:]\n[offset:0]\n[00:02.65]一睁眼&#32;&#45;&#32;沈玮琦\n[00:03.36]词：许嵩\n[00:03.49]曲：许嵩\n[00:08.13]一睁眼\n[00:08.99]新的一天\n[00:10.84]跳出了多梦的一夜\n[00:13.71]可能旅店的枕垫\n[00:15.78]太软了一些\n[00:19.26]洗好脸走到窗边\n[00:22.08]有风轻轻掀动纱帘\n[00:24.90]心也\n[00:25.90]心也软了一些\n[00:30.58]一睁眼\n[00:31.56]新的一天\n[00:33.36]计划太多会添纠结\n[00:36.24]要不要试着接受\n[00:38.41]快乐一时是一时的哲学\n[00:41.92]没有你在我身边\n[00:44.72]我的幽默渐渐不见\n[00:47.56]雨斜斜&#32;歌绵绵\n[00:50.42]闭关修炼\n[00:52.95]昨晚的梦里面\n[00:55.63]楼台杏花琴弦\n[00:58.47]场面有些古典\n[01:01.02]谁飞扬了裙边\n[01:03.84]你抱着我转圈\n[01:06.40]在南方的雨天\n[01:09.44]怎么雨水都甜\n[01:12.19]怎么回忆都咸\n[01:15.43]昨晚的梦里面\n[01:18.29]时光倒回从前\n[01:21.07]心动还能重演\n[01:23.62]是爱情在身边\n[01:26.44]你送我的项链\n[01:29.23]戴上叫做想念\n[01:31.97]怎么没说再见\n[01:34.92]还没好好告别\n[01:36.95]已睁眼\n[02:06.76]一睁眼\n[02:07.61]新的一天\n[02:09.46]跳出了多梦的一夜\n[02:12.23]可能旅店的枕垫\n[02:14.31]太软了一些\n[02:17.89]洗好脸走到窗边\n[02:20.69]有风轻轻掀动纱帘\n[02:23.43]心也\n[02:24.44]心也软了一些\n[02:29.19]一睁眼\n[02:30.23]新的一天\n[02:32.08]计划太多会添纠结\n[02:34.81]要不要试着接受\n[02:36.96]快乐一时是一时的哲学\n[02:40.49]没有你在我身边\n[02:43.28]我的幽默渐渐不见\n[02:46.16]雨斜斜&#32;歌绵绵\n[02:48.92]闭关修炼\n[02:51.46]昨晚的梦里面\n[02:54.20]楼台杏花琴弦\n[02:57.01]场面有些古典\n[02:59.78]谁飞扬了裙边\n[03:02.38]你抱着我转圈\n[03:05.19]在南方的雨天\n[03:08.07]怎么雨水都甜\n[03:10.84]怎么回忆都咸\n[03:13.98]昨晚的梦里面\n[03:16.76]时光倒回从前\n[03:19.59]心动还能重演\n[03:22.09]是爱情在身边\n[03:24.94]你送我的项链\n[03:27.60]戴上叫做想念\n[03:30.60]怎么没说再见\n[03:33.38]还没好好告别\n[03:35.48]已睁眼\n[03:39.94]一睁眼\n[03:51.23]一睁眼\n[03:57.34]新的一天"
        },
        {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
        },
        {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
        }, {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
        }, {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
        }, {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
        }, {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
        }, {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
        }, {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
        }, {
            "name": "在荒芜中丰收地活着",
            "singer": "万中",
            "img": "http://imgcache.qq.com/music/photo/album_500/51/500_albumpic_1796451_0.jpg",
            "src": "http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=",
        }
    ]
];