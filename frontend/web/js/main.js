// 首页轮播图
var Index = function() {

    var index = 0,
        n = 0, // 计算导航图片数
        timer = null, // 定时器
        $banners = $("#banners"),
        $banner = $banners.find(".banner-item"),
        $btns = $("#banner_btns").find(".banner-btn"),
        len = $banner.length;

    $banners.find(".banner-image").load(function() {

        if (++n == len && !timer) {
            timer = setInterval(function() {
                console.log(1);
                roll();
            }, 5000)
        }


    }).each(function() {

        if (this.complete && ++n == len && !timer) {
            timer = setInterval(function() {
                roll();
            }, 5000)
        }

    });


    function roll() {

        $banner.eq(index).animate({
            "left": "-100%"
        }, 1000, function() {
            $(this).css("left", "100%");
            index = index + 1 == len ? 0 : index + 1;
        });

        $banner.eq(index + 1 == len ? 0 : index + 1).animate({
            "left": "0"
        }, 1000);

        $btns.removeClass('current').eq(index + 1 == len ? 0 : index + 1).addClass('current');

    }

};

var Mv = function(){

    new Vue({
        el: '#video',
        data: {
            lists: [],
            height: 0
        },
        mounted: function() {
            this.height = getHeight();
            this.getInfo();
        },
        methods: {
            getInfo: function() {
                var that = this;
                $.ajax({
                    url: '/api/list',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        type: 'video',
                        page: 1,
                        limit: 40
                    },
                    success: function(res) {
                        if (res.code == 0) {
                            that.lists = res.data;
                        }
                    }
                })
            }
        }
    })
}

// 图片查看
var Img = function() {

    $(".fancybox").fancybox({
        cyclic: true,
        titleShow: true
    });

    new Vue({
        el: '#img',
        data: {
            lists: []
        },
        mounted: function() {
            this.getInfo();
        },
        methods: {
            getInfo: function() {
                var that = this;
                $.ajax({
                    url: '/api/list',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        type: 'image',
                        page: 1,
                        limit: 40
                    },
                    success: function(res) {
                        if (res.code == 0) {
                            that.lists = res.data;
                        }
                    }
                })
            }
        }
    })
};

function getHeight(){
    var minHeight = 400,
        height = $(document).height() -323;

    return height > minHeight ? height : minHeight;
}

// 书法查看
var Write = function(){

    $(".fancybox").fancybox({
        cyclic: true,
        titleShow: true
    });

    new Vue({
        el: '#writing',
        data: {
            lists: [],
            height: 0
        },
        mounted: function() {
            this.height = getHeight();
            this.getInfo();
        },
        methods: {
            getInfo: function() {
                var that = this;
                $.ajax({
                    url: '/api/list',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        type: 'calligraphy',
                        page: 1,
                        limit: 40
                    },
                    success: function(res) {
                        if (res.code == 0) {
                            that.lists = res.data;
                        }
                    }
                })
            }
        }
    })
}


// 音乐播放
var Music = function() {
    var $playerContainer = $("#music_player_container"),
        $hand = $playerContainer.find('.music-hand');

    var modeText = ['顺序播放', '单曲循环', '随机播放', '列表循环'];

    //var player =


        //$(document.body).append(player.audio); // 测试用




        // 显示播放器
        /*$playerContainer.on("mouseover", function() {
            console.log(1);
            //$(this).css('bottom', 0);
        });

        // 隐藏播放器
        $playerContainer.on("mouseout", function() {
            var that = this;
            setTimeout(function() {
                //$(that).css('bottom', '-50px')
            }, 5000)
        });*/


        new Vue({
            el: '#music',
            data: {
                lists: [],
                songs: [
                    [{
                        "basic": true,
                        "name": "播放列表",
                        "singer": "万中",
                        "img": ''
                    }]
                ],
                height: 0,
                player: ''
            },
            mounted: function() {
                this.height = getHeight();
                this.getInfo();
            },
            methods: {
                getInfo: function() {
                    var that = this;

                    $.ajax({
                        url: '/api/list',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            type: 'audio',
                            page: 1,
                            limit: 10
                        },
                        success: function(res) {
                            if (res.code == 0) {

                                that.lists = res.data;

                                for(var i = 0; i < res.data.length; i++){
                                    that.songs[0].push({
                                        name: res.data[i].name,
                                        singer: '万中',
                                        src: res.data[i].path,
                                        img: res.data[i].thumb,
                                        lrc: ''
                                    })
                                }
                                console.log(that.songs)
                                that.createPlayer();
                                setEffects(that.player);

                            }
                        }
                    })
                },
                createPlayer: function() {
                    var that = this;
                    this.player = new MPlayer({
                        // 容器选择器名称
                        containerSelector: '#music_player',
                        // 播放列表
                        songList: that.songs,
                        // 专辑图片错误时显示的图片
                        defaultImg: '/images/logo.png',
                        // 自动播放
                        autoPlay: false,
                        // 播放模式(0->顺序播放,1->单曲循环,2->随机播放,3->列表循环(默认))
                        playMode: 0,
                        playList: 0,
                        playSong: 0,
                        // 当前歌词距离顶部的距离
                        lrcTopPos: 34,
                        // 列表模板，用${变量名}$插入模板变量
                        listFormat: '<tr><td>${name}$</td><td>${singer}$</td><td>${time}$</td></tr>',
                        // 音量滑块改变事件名称
                        volSlideEventName: 'change',
                        // 初始音量
                        defaultVolume: 60
                    }, function() {
                        // 绑定事件
                        this.on('afterInit', function() {
                            console.log('播放器初始化完成，正在准备播放');
                        }).on('beforePlay', function() {
                            var $this = this;
                            var song = $this.getCurrentSong(true);
                            var songName = song.name + ' - ' + song.singer;
                            console.log('即将播放' + songName + '，return false;可以取消播放');
                        }).on('timeUpdate', function() {
                            var $this = this;
                            console.log('当前歌词：' + $this.getLrc());
                        }).on('end', function() {
                            var $this = this;
                            var song = $this.getCurrentSong(true);
                            var songName = song.name + ' - ' + song.singer;
                            //console.log(songName + '播放完毕，return false;可以取消播放下一曲');
                        }).on('mute', function() {
                            var status = this.getIsMuted() ? '已静音' : '未静音';
                            //console.log('当前静音状态：' + status);
                        }).on('changeMode', function() {
                            var $this = this;
                            var mode = modeText[$this.getPlayMode()];
                            $this.dom.container.find('.mp-mode').attr('title', mode);
                            //console.log('播放模式已切换为：' + mode);
                        });
                    });

                },
                play: function(idx) {
                    this.player.play(0, idx);
                }
            }
        })

}


// mv播放
var Play = function() {

    $("#player").mediaelementplayer({
        autoplay: true,
        alwaysShowControls: true,
        features: ['playpause', 'current', 'progress', 'duration', 'volume', 'fullscreen'],
        poster: "", // 封面
        //audioVolume: 'horizontal',
        startVolume: 0.6, // 播放的初始音量
        success: function() {
            //console.log(arguments)
        },
        error: function() {
            console.log("加载失败")
        },
        //customError: "加载失败",
        videoWidth: 734,
        videoHeight: 490
    });


}


var Poem = function(){

        new Vue({
        el: '#poem',
        data: {
            lists: [],
            height: 0
        },
        mounted: function() {
            this.height = getHeight();
            this.getInfo();
        },
        methods: {
            getInfo: function() {
                var that = this;
                $.ajax({
                    url: '/api/list',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        type: 'poem',
                        page: 1,
                        limit: 40
                    },
                    success: function(res) {
                        if (res.code == 0) {
                            that.lists = res.data;
                        }
                    }
                })
            }
        }
    })
}
$(document).ready(function() {
    $("#index").get(0) && Index();

    $("#video").get(0) && Mv();

    $("#img").get(0) && Img();

    $("#writing").get(0) && Write();

    $("#music").get(0) && Music();

    $("#play_page").get(0) && Play();

    $("#poem").get(0) && Poem();
})