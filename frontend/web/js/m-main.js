(function() {
    var Index = function() {

        new Vue({
            el: '#index',
            data: function() {
                return {
                    height: null
                }
            },
            mounted: function() {
                var that = this;
                this.getHeight()

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
                }
            }
        })
    }


    var Mv = function() {

        new Vue({
            el: '#mv',
            data: function() {
                return {
                    height: null
                }
            },
            mounted: function() {
            	var that = this;
            	this.getHeight();

            	$(window).resize(function(){
            		that.getHeight();
            	});
            },
            methods: {
                getHeight: function() {
                    var body = $(document).height(),
                        header = $('.header').height(),
                        footer = $('.footer').height(),
                        height1 = body - header - footer,
                        height = $("#mv").height();

                    this.height = height > height1 ? height : height1;
                }
            }
        })
    }


    $(document).ready(function() {
        $("#index").get(0) && Index();

        $("#mv").get(0) && Mv();
    })

})()