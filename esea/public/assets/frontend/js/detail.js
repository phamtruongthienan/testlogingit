$(function() {
    $('.table_render').each(function() {
        $.jsontotable($(this).data('content'), {
            id: '#table_render_'+$(this).data('keys'),
            header: true,
            className: "table table-hover table-bordered"
        });
    });

    $(document).on("click", ".open-map-location", function() {
        var query_string_map = 'query';
        school_map_id = $(this).data('id');
        url_map_callback_api = "/api/map/get/" + query_string_map
        if (school_map_id != temp_map) {
            $('#nearMap-main').html('').html('<div id="map"></div>')
            getLocation();
        } else {
            $('#openMap').modal('show');
        }
        temp_map = school_map_id;
    });

    $(document).on("click", ".wish-list", function() {
        var action_type =  $(this).attr('data-action');
        var  data_post = {
            id: $(this).attr('data-id'),
            action: action_type,
        };
        $.ajax({
            url: base_url + "/wishlist",
            data: data_post,
            type: "post",
            success: function(response) {
                if(response.code == 200) {
                    if(action_type == '1') {
                        $('.wish-list').css('background-color','#BD3518 !important');
                        $('.wish-list').attr('data-action', 0);
                    } else {
                        $('.wish-list').css('background-color','#D3D3D3 !important');
                        $('.wish-list').attr('data-action', 1);
                    } 
                    Lobibox.notify("success", {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: response.msg
                    });
                } else {
                    Lobibox.notify("warning", {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: response.msg
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: false,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: 'Có lỗi trong quá trình cập nhật'
                });
            }
        });
    });

    $('.w-slider-banner .w-slider-mask').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: $('.w-slider-banner .w-slider-arrow-left'),
        nextArrow: $('.w-slider-banner .w-slider-arrow-right')
    });
    $('.detail-section-introdution-2 .w-slider-mask').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: $('.detail-section-introdution-2 .w-slider-arrow-left'),
        nextArrow: $('.detail-section-introdution-2 .w-slider-arrow-right')
    });
    $('.gallery-slider').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: $('.gallery-prev'),
        nextArrow: $('.gallery-next'),
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }]
    });
    $('.sidebar-non-wrapper').slick({
        vertical: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        verticalSwiping: true,
        prevArrow: "<i class='fa fa-angle-up' aria-hidden='true'></i>",
        nextArrow: "<i class='fa fa-angle-down' aria-hidden='true'></i>"
    });
    var currentRating = $('.ratingStar');

    if (currentRating.data('current-rating') != '') {
        $('.ratingStar > option').each(function() {
            if ($(this).val() == currentRating.data('current-rating')) {
                $(".ratingStar").val(currentRating.data('current-rating'));
                $('.current-rating').find('div').html($(this).data('html'));
            }
        });
    }



    $('.ratingStar').barrating({
        theme: 'fontawesome-stars',
        showSelectedRating: false,
        initialRating: currentRating.data('current-rating'),
        onSelect: function(value, text) {
            if (!value) {
                $('.ratingStar').barrating('clear');
            } else {
                $('.current-rating').addClass('hidden');
                $('.your-rating').removeClass('hidden').find('div').html(text);
            }
        },
        onClear: function(value, text) {
            $('.current-rating').removeClass('hidden').end().find('.your-rating').addClass('hidden');
        }
    });
    $('.ratingBar').barrating({
        theme: 'bars-movie',
        onSelect: function(value, text, event) {
            var category_id = $(event.currentTarget).data('category-id');
            var school_id =$(event.currentTarget).data('school-id');
            postRating(school_id, category_id, value);
        },
    });

    $(window).on("resize scroll", function() {
        var y = $(this).scrollTop();
        var navWrap = $('.sub-menu-detail').offset().top + $('.sub-menu-detail').outerHeight(true);
        if (y > navWrap) {
            $('.sub-menu-detail-fix').fadeIn();
        } else {
            $('.sub-menu-detail-fix').fadeOut();
        }
    });

    $(document).on("click", ".btn-review", function(event) {
        event.preventDefault();
        if($('.ratingStar').val() == '') {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: false,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: 'Vui lòng đánh giá'
            });
        } else if($('#form-review textarea').val() == '') {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: false,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: 'Vui lòng nhập nội dung'
            });
        } else {
            $('#form-review').submit();
        }
    });

    if ($().validator) {
        $('#form-review').validator().on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                data_post = $('#form-review').serialize() + '&school_id=' + school_id;
                $.ajax({
                    url: base_url + "/school-review",
                    data: data_post,
                    type: "post",
                    success: function(response) {
                        if (response.code == '200') {
                            Lobibox.notify("success", {
                                title: 'Thông báo',
                                pauseDelayOnHover: false,
                                continueDelayOnInactiveTab: false,
                                icon: false,
                                sound: false,
                                msg: response.msg
                            });
                            $('#form-review textarea').val('');
                            grecaptcha.reset();
                        } else {
                            Lobibox.notify("warning", {
                                title: 'Thông báo',
                                pauseDelayOnHover: false,
                                continueDelayOnInactiveTab: false,
                                icon: false,
                                sound: false,
                                msg: response.msg
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Lobibox.notify("warning", {
                            title: 'Thông báo',
                            pauseDelayOnHover: false,
                            continueDelayOnInactiveTab: false,
                            icon: false,
                            sound: false,
                            msg: 'Có lỗi trong quá trình cập nhật'
                        });
                    }
                });
            } else {
                e.preventDefault();
            }
        })
    }

    $.fancybox.defaults.hash = false;
    $('.gallery-item:not(.slick-cloned) .view-normal').fancybox({
        margin: [44, 0, 22, 0],
        thumbs: {
            autoStart: true,
            axis: 'x'
        },
        clickContent: false,
        touch: false,
        closeClickOutside: false,
        beforeShow: function(e) {
            var currIndex = e.currIndex;
            var slideIndex = e.slides[currIndex].opts.$orig;
            if (typeof slideIndex !== 'undefined') {
                if ($(slideIndex).hasClass('image-360')) {
                    setTimeout(function() {
                        var div = document.getElementsByClassName('fancybox-slide--current')[0].getElementsByClassName('fancybox-image-wrap')[0];
                        var src = div.getElementsByClassName("fancybox-image")[0].src;
                        var PSV = new PhotoSphereViewer({
                            panorama: src,
                            container: div,
                            time_anim: 3000,
                            navbar: true,
                            navbar_style: {
                                backgroundColor: 'rgba(58, 67, 77, 0.7)'
                            },
                        });
                    }, 100);
                }
            }
        }
    });

    slideWrapper.on("beforeChange", function(event, slick) {
        slick = $(slick.$slider);
        playPauseVideo(slick, "pause");
    });
    slideWrapper.on("afterChange", function(event, slick) {
        slick = $(slick.$slider);
        playPauseVideo(slick, "play");
    });
    slideWrapper.on("lazyLoaded", function(event, slick, image, imageSource) {
        lazyCounter++;
        if (lazyCounter === lazyImages.length) {
            lazyImages.addClass('show');
            // slideWrapper.slick("slickPlay");
        }
    });
});



// Resize event
$(window).on("resize.slickVideoPlayer", function() {
    // resizePlayer(iframes, 16/9);
});

var slideWrapper = $(".gallery-slider"),
    iframes = slideWrapper.find('.embed-player'),
    lazyImages = slideWrapper.find('.slide-image'),
    lazyCounter = 0;

// POST commands to YouTube or Vimeo API
function postMessageToPlayer(player, command) {
    if (player == null || command == null) return;
    player.contentWindow.postMessage(JSON.stringify(command), "*");
}

// When the slide is changing
function playPauseVideo(slick, control) {
    var currentSlide, slideType, startTime, player, video;

    currentSlide = slick.find(".slick-current");
    slideType = currentSlide.attr("class").split(" ")[1];
    player = currentSlide.find("iframe").get(0);
    startTime = currentSlide.data("video-start");

    if (slideType === "vimeo") {
        switch (control) {
            case "play":
                if ((startTime != null && startTime > 0) && !currentSlide.hasClass('started')) {
                    currentSlide.addClass('started');
                    postMessageToPlayer(player, {
                        "method": "setCurrentTime",
                        "value": startTime
                    });
                }
                postMessageToPlayer(player, {
                    "method": "play",
                    "value": 1
                });
                break;
            case "pause":
                postMessageToPlayer(player, {
                    "method": "pause",
                    "value": 1
                });
                break;
        }
    } else if (slideType === "youtube") {
        switch (control) {
            case "play":
                postMessageToPlayer(player, {
                    "event": "command",
                    "func": "mute"
                });
                postMessageToPlayer(player, {
                    "event": "command",
                    "func": "playVideo"
                });
                break;
            case "pause":
                postMessageToPlayer(player, {
                    "event": "command",
                    "func": "pauseVideo"
                });
                break;
        }
    } else if (slideType === "video") {
        video = currentSlide.children("video").get(0);
        if (video != null) {
            if (control === "play") {
                video.play();
            } else {
                video.pause();
            }
        }
    }
}

function postRating(school_id, category_id, value) {
    var data_post = 'school_id='+school_id+'&category_id='+category_id+'&rating='+value
    $.ajax({
        url: base_url + "/school-rating",
        data: data_post,
        type: "post",
        success: function(response) {
            if (response.code == '200') {
                Lobibox.notify("success", {
                    title: 'Thông báo',
                    pauseDelayOnHover: false,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: response.msg
                });
                $('#rating-panel-view').hide().prepend('<div class="col-rating"><div class="counter col_fourth"> \
                <h2 class="timer count-title count-number"><b class="text-danger">'+value+'</b>/<small>10</small></h2>\
                <p class="count-text ">'+ $('#rating-name-'+category_id).text()+'</p>\
                </div></div>').slideToggle();
                //$('#rating-panel-'+category_id).remove();
                var col = 12/($('#rating-panel-view > div').length);
                if(col <3) {
                    col = 3;
                }
                var class_css = "col-rating col-"+col;
                $.each( $('#rating-panel-view'), function(i, left) {
                    $('.col-rating', left).each(function() {
                        $(this).removeClass();
                        $(this).addClass(class_css);
                    });
                })
            } else {
                //$('#rating-panel-'+category_id).remove();
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: false,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: response.msg
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: false,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: 'Có lỗi trong quá trình cập nhật'
            });
        }
    });
}

// Resize player
function resizePlayer(iframes, ratio) {
    if (!iframes[0]) return;
    var win = $(".slider-single"),
        width = win.width(),
        playerWidth,
        height = win.height(),
        playerHeight,
        ratio = ratio || 16 / 9;

    iframes.each(function() {
        var current = $(this);
        if (width / ratio < height) {
            playerWidth = Math.ceil(height * ratio);
            current.width(playerWidth).height(height).css({
                left: (width - playerWidth) / 2,
                top: 0
            });
        } else {
            playerHeight = Math.ceil(width / ratio);
            current.width(width).height(playerHeight).css({
                left: 0,
                top: (height - playerHeight) / 2
            });
        }
    });
}