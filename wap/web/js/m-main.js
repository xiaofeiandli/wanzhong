(function() {

    var navBar = function() {

        var $bar = $("#menu_btn").data("value", true),
            $icon = $("#icon"),
            $nav = $("#nav");

        $bar.on("click", function() {
            var val = $(this).data("value");
            console.log(11);
            if (val) {
                $icon.show();
                $nav.slideDown();
            } else {
                $nav.slideUp(function() {
                    $icon.hide();
                });
            }
            $(this).data("value", !val);
        });

        $(document).on("click", function(e) {

            var target = $(e.target).get(0),
                bar = $bar.get(0);

            if (!$bar.data("value") && target !== bar && !$.contains(bar, target)) {

                $bar.data("value", true);
                $nav.slideUp(function() {
                    $icon.hide();
                });
            }
        })

    };


    var Index = function() {



        new Vue({
            el: '#index',
            data: function() {
                return {
                    n: 0,
                    index: 0,
                    len: 0,
                    timer: null, //定时器
                    height: null
                }
            },
            mounted: function() {
                var that = this;
                this.getHeight();
                this.$banners = $("#banners");
                this.$banner = $("#banners").find(".banner-item");
                this.$btns = $("#banner_btns").find(".banner-btn");
                this.len = this.$banner.length;


                this.$banners.find(".banner-image").load(function() {

                    if (++that.n == that.len && !that.timer) {
                        that.timer = setInterval(function() {
                            that.roll();
                        }, 5000)
                    }


                }).each(function() {

                    if (this.complete && ++that.n == that.len && !that.timer) {
                        that.timer = setInterval(function() {
                            that.roll();
                        }, 5000)
                    }

                });

                $(window).resize(function() {
                    that.getHeight();
                });
            },
            methods: {

                getHeight: function() {
                    var body = $(document).height(),
                        header = $('.header').height(),
                        footer = $('.footer').height(),
                        banner = $('#banners').height(),
                        height1 = body - header - footer - banner,
                        height = $("#index").height() - banner;

                    this.height = height > height1 ? height : height1;
                },

                roll: function() {
                    var that = this;
                    this.$banner.eq(that.index).animate({
                        "left": "-100%"
                    }, 1000, function() {
                        $(this).css("left", "100%");
                        that.index = that.index + 1 == that.len ? 0 : that.index + 1;
                    });

                    this.$banner.eq(that.index + 1 == that.len ? 0 : that.index + 1).animate({
                        "left": "0"
                    }, 1000);

                    this.$btns.removeClass('current').eq(that.index + 1 == that.len ? 0 : that.index + 1).addClass('current');
                }
            }
        })
    }

    var listInt = function(type) {

        new Vue({
            el: '#lists',
            data: function() {

                return {
                    type: type,
                    orderby: 'created_at',
                    height: null,
                    page: 1,
                    limitnum: 10,
                    lists: [],
                    player: null,
                    apList: [],
                    apIdx:[],
                    current: null, // 当前选中
                    msg: '', // 提示消息
                    over: false, // 没有更多数据
                    error: false, // 请求出错
                    loading: true, // 加载
                    ownStop: null,
                    ownPlay: null
                }
            },
            mounted: function() {
                var that = this;

                this.getHeight();
                if(this.type == 'audio'){
                    this.playerInt();
                }
                this.getList();
                this.scroll();

                $(window).resize(function() {
                    that.getHeight();
                });

            },
            watch: {
                orderby: function(val){
                    this.page = 1;

                    this.getList();
                }
            },
            methods: {
                scroll: function() {
                    var that = this,
                        viewHeight = $(window).height();

                    $(window).scroll(function(e) {
                        var scroll = $(window).scrollTop(),
                            bodyHeight = $(document).height();

                        if (scroll + viewHeight + 100 >= bodyHeight && !that.loading && !that.over) {
                            that.getList();
                        }

                    });
                },
                getHeight: function() {
                    var body = $(document).height(),
                        header = $('.header').height(),
                        footer = $('.footer').height(),
                        height1 = body - header - footer,
                        height = $("#lists").height();

                    this.height = height > height1 ? height : height1;
                },
                toggle: function(val){ 
                    console.log(val); 

                    if(this.type != val){
                        this.type = val;
                        this.page = 1;
                        this.lists = [];
                        this.getList();
                    }
                },
                addCount: function(){
                    
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

                                that.page++;

                                for (var i = 0; i < res.data.data.length; i++) {
                                    that.lists.push(res.data.data[i])
                                }

                                if(res.data.data.length < that.limitnum){
                                    that.msg = "没有更多了";
                                }
                                that.total = Number(res.data.total);

                            } else { // 结果不符合预期

                                if (res.msg == '暂无数据') { // 没有数据，不再请求

                                    that.over = true;
                                    res.msg = '没有更多了';
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

                    this.player.on('play',function(){

                        if(!that.ownPlay){
                            var index = that.player.list.index,
                                idx = that.apIdx[index];

                            that.current.play = false;

                            that.$set(that.lists,that.current.index,that.current);

                            that.current = that.lists[idx];

                            that.current.play = true;
                            
                            that.$set(that.lists,idx,that.current);

                        }else{
                            that.ownPlay = false;
                        }

                    })

                    this.player.on('pause',function(){

                        if(!that.ownStop){
                            that.current.play = false;
                            that.$set(that.lists,that.current.index,that.current);
                        }else{
                            that.ownStop = false;
                        }
                        
                    })
                },
                playMusic: function(idx) {
                    var that = this,
                        index = null;

                    this.ownPlay = true;

                    if (this.current) {

                        this.stopMusic();
                    }

                    this.current = this.lists[idx];

                    index = this.apList.indexOf(this.current.id);

                    if (index < 0) { // 未添加到播放器中
                        this.apList.push(this.current.id);

                        this.apIdx.push(idx);

                        this.current.index = idx;

                        this.current.play = true;

                        this.$set(this.lists, idx, this.current);

                        this.player.list.add([{
                            name: that.current.name,
                            artist: '万中',
                            url: that.current.path,
                            data: idx,
                            cover: '/images/logo.png'
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

                    this.$set(this.lists, this.current.index, this.current);

                    this.player.pause();
                }
            }
        })
    }

    var detailInt = function(){
        new Vue({
            el: '#detail',
            data: function(){

                return {
                    id: 55,
                    type: 'lyric',
                    title: '',
                    content: '',
                    author: '',
                    read: 0,
                    created_at: ''
                }
            },
            mounted: function(){
                this.getDetail();
            },
            methods: {
                getData: function(){

                },
                getDetail: function(){
                    var that = this;                    

                    $.ajax({
                        url: '/api/detail',
                        type: 'post',
                        data: {
                            id: that.id,
                            type: that.type
                        },
                        dataType: 'json',
                        success: function(res){
                            if(res.code == 0){
                                var obj = res.data[0];

                                that.title = obj.title;
                                that.content = obj.content;
                                that.created_at = obj.created_at;
                                that.read = obj.read;
                            }
                        }
                    })
                }
            }
        })
    }

    var VideoInt = function(){
        new Vue({
            el:'#video',
            data: function(){

                return {
                    height: 600
                }
            },
            mounted: function(){

            },
            methods: {

            }
        })
    }
    $(document).ready(function() {
        // 导航
        navBar();

        $("#index").get(0) && Index();

        $("#music").get(0) && listInt('audio');


        $("#mv").get(0) && listInt('video');


        $("#pic").get(0) && listInt('image');

        $("#writing").get(0) && listInt('calligraphy');

        $("#poem").get(0) && listInt('lyric');

        $("#detail").get(0) && detailInt();
    })

})()