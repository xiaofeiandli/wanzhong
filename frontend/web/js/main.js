// 首页轮播图
var Index = function() {

    new Vue({
        el: '#index',
        data: function() {
            return {
                height: 500
            }
        },
        mounted: function() {
            var that = this;
            this.getHeight();
            $(window).resize(function() {
                that.getHeight();
            });
        },
        methods: {
            getHeight: function() {
                var body = $(document).height(),
                    header = $('.header').height(),
                    footer = $('.footer').height(),
                    height1 = body - header - footer,
                    height = $("#lists").height();

                this.height = height > height1 ? height : (height1 - 564);
            }
        }
    })

};

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


var listInt = function(type) {

    new Vue({
        el: '#lists',
        data: function() {

            return {
                type: type,
                orderby: 'created_at',
                height: 300,
                page: 1,
                limit: 5,
                total: null,
                lists: [],
                player: null,
                apList: [],
                apIdx: [],
                current: null, // 当前选中
                msg: '', // 提示消息
                over: false, // 没有更多数据
                error: false, // 请求出错
                loading: true, // 加载
                ownStop: false,
                ownPlay: false
            }
        },
        mounted: function() {
            var that = this;

            this.getHeight();

            if (this.type == 'audio') {
                this.playerInt();
            }

            if (this.type == 'image' || this.type == 'calligraphy') {
                $(".fancybox").fancybox({
                    cyclic: true,
                    titleShow: true
                });
                this.limit = 20;
            }

            this.getList();

            $(window).resize(function() {
                that.getHeight();
            });

        },
        watch: {
            orderby: function(val) {
                this.page = 1;

                this.getList();
            }
        },
        methods: {
            getHeight: function() {
                var body = $(document).height(),
                    header = $('.header').height(),
                    footer = $('.footer').height(),
                    height1 = body - header - footer,
                    height = $("#lists").height();

                this.height = height > height1 ? height : (height1 - 110);
            },
            toggle: function(val) {

                if (this.type != val) {
                    this.type = val;
                    this.page = 1;
                    this.total = 0;
                    this.lists = [];
                    this.getList();
                }
            },
            addCount: function() {

                var that = this;

                id = this.current.id;

                $.ajax({
                    url: '/api/read',
                    type: 'post',
                    data: {
                        type: that.type,
                        id: id
                    },
                    success: function(res) {
                        if (res.code == 0) {
                            that.current.count++;

                            that.$set(that.lists, that.current.index, that.current);
                        }
                    }
                })
            },
            pageChange: function(val) {
                this.page = val;

                this.getList();
            },
            getList: function() {
                var that = this;

                this.msg = '';

                this.loading = true;
                $.ajax({
                    url: '/api/list',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        type: that.type,
                        page: that.page,
                        limit: that.limit,
                        orderby: that.orderby
                    },
                    success: function(res) {
                        if (res.code == 0) { // 结果为预期

                            if (that.page == 1) { // 改变排序后请求
                                that.lists = [];
                            }

                            that.lists = res.data.data;

                            that.total = Number(res.data.total);

                            if (res.data.data.length < that.limitnum) {
                                that.msg = "没有更多了";
                            }

                            $('html,body').animate({ scrollTop: 0 }, 500);

                            // 如果是音乐播放
                            if (that.type == 'audio' && that.current && that.current.page == that.page) {
                                that.$set(that.lists, that.current.index, that.current);
                            }

                        } else { // 结果不符合预期

                            if (res.msg == '暂无数据') { // 没有数据，不再请求

                                that.over = true;

                                if (that.page == 1) {
                                    res.msg = '暂无内容，请稍后访问。'
                                } else {
                                    res.msg = '';
                                }
                            }

                            that.msg = res.msg;
                        }

                    },
                    error: function(res) {
                        // 请求出错，显示再次按钮
                        that.error = true;
                    },
                    complete: function() {
                        that.loading = false;
                    }
                })
            },
            // 初始化播放器
            playerInt: function() {
                var that = this;

                this.player = new APlayer({
                    container: document.getElementById('music_player'),
                    fixed: true,
                    mini: true,
                    loop: 'all', // 循环播放列表
                    order: 'list', // 循环顺序 列表
                    volume: '0.5', // 音频初始大小
                    storageName: 'aplayer-setting',
                    audio: []
                });

                this.player.on('play', function() {

                    if (!that.ownPlay) {
                        var index = that.player.list.index,
                            audio = that.player.list.audios[index],
                            idx = audio.index;


                        if (that.current.page == that.page) {

                            that.current.play = false;

                            that.$set(that.lists, that.current.index, that.current);
                        }

                        that.current = {
                            id: audio.id,
                            description: audio.description,
                            name: audio.name,
                            artist: '万中',
                            path: audio.url,
                            index: audio.index,
                            page: audio.page,
                            cover: '/images/logo.png',
                            created_at: audio.created_at,
                            status: audio.status,
                            thumb: audio.thumb,
                            count: audio.count,
                            play: true
                        }
                        // 播放在当前页
                        if (audio.page == that.page) {

                            that.$set(that.lists, idx, that.current);

                        } 

                    } else {
                        
                        that.ownPlay = false;

                    }

                })

                this.player.on('pause', function() {
                    if (!that.ownStop) {

                        that.current.play = false;

                        if (that.current.page == that.page) {
                           
                            that.$set(that.lists, that.current.index, that.current);
                        }

                    } else {
                        that.ownStop = false;
                    }

                })
            },
            playMusic: function(idx) {
                var that = this,
                    index = null;

                this.ownPlay = true;

                if (this.current) {

                    this.current.play = false;

                    if (this.current.page == this.page) {
                        this.$set(this.lists, this.current.index, this.current);
                    }
                }

                this.current = this.lists[idx];

                index = this.apList.indexOf(this.current.id);

                if (index < 0) { // 未添加到播放器中

                    this.apList.push(this.current.id);

                    this.current.index = idx;
                    this.current.page = this.page;
                    this.current.play = true;

                    this.$set(this.lists, idx, this.current);

                    this.player.list.add([{
                        id: that.current.id,
                        description: that.current.description,
                        name: that.current.name,
                        artist: '万中',
                        url: that.current.path,
                        index: idx,
                        page: this.page,
                        cover: '/images/logo.png',
                        created_at: that.current.created_at,
                        status: that.current.status,
                        thumb: that.current.thumb,
                        count: that.current.count
                    }])

                    this.player.list.switch(this.apList.length - 1);

                    this.player.play();


                } else { // 已添加到播放器中

                    this.current.play = true;

                    this.$set(this.lists, idx, this.current);

                    this.player.list.switch(index);

                    this.player.play();

                }
                this.addCount();
            },
            // 暂停当前音乐
            stopMusic: function() {

                this.ownStop = true;

                this.current.play = false;

                if (this.current.page == this.page) {
                    this.$set(this.lists, this.current.index, this.current);
                }
                this.player.pause();
            }
        }
    })
}

$(document).ready(function() {
    $("#index").get(0) && Index();

    //$("#video").get(0) && Mv();

    $("#img").get(0) && listInt('image');


    $("#music").get(0) && listInt('audio');

    $("#play_page").get(0) && Play();

    $("#poem").get(0) && listInt('lyric');

    $("#video").get(0) && listInt('video');

    $("#writing").get(0) && listInt('calligraphy');

})