$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#Header").append("<div class='w-nav-overlay' data-wf-ignore></div>");
    scrolltop();
    $(document).on("click", ".menu-button", function(event) {
        event.preventDefault();
        if ($(".w-nav-overlay").is(":visible")) {
            $(this).next().slideUp(500, function() {
                $(this).empty().height('');
            });
            $(this).next().find("nav.w-nav-menu").removeClass('w--nav-menu-open');
            $(this).removeClass("w--open");
        } else {
            $(this).next().height($(document).height() - $(".footer-copy-right").height() - $(".w-nav-brand").height());
            $(this).next().append($("nav.w-nav-menu")[0].outerHTML).slideDown(500);
            $(this).next().find("nav.w-nav-menu").addClass('w--nav-menu-open');
            $(this).addClass("w--open");
        }
    });
    $(window).on("resize", function() {
        if ($(".w-nav-overlay").is(":visible")) {
            $(".w-nav-overlay").slideUp(500, function() {
                $(this).empty().height('');
            });
            $(".w-nav-overlay").find("nav.w-nav-menu").removeClass('w--nav-menu-open');
            $(".menu-button").removeClass("w--open");
        }
    });
    $(document).on("click", ".w-nav-overlay", function(event) {
        if ($(event.target).attr('class') == "w-nav-overlay") {
            $(".menu-button").trigger("click");
        }
    });

    if ($('[data-toggle="tooltip"]').length > 0) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    if ($('.popup_this').length > 0) {
        if (typeof $.cookie('popup_ads') === 'undefined') {
            $('.popup_this').show();
            $('.popup_this').bPopup();
            $.cookie('popup_ads', 'true')
        } else {
            $('.popup_this').remove();
        }
    }


    if ($('.copy-clipboard').length > 0) {
        new ClipboardJS('.copy-clipboard');
    }
    if ($('.b-description_readmore').length > 0) {
        $('.b-description_readmore').moreLines({
            linecount: 5,
            baseclass: 'b-description',
            basejsclass: 'js-description',
            classspecific: '_readmore',
            buttontxtmore: "<div class='b-description_readmore_button2'><i class='fas fa-chevron-circle-down'></i>" +  Lang.get('front.homepage.viewmore') +"</div>",
            buttontxtless: "<div class='b-description_readmore_button2'><i class='fas fa-chevron-circle-up'></i>"+  Lang.get('front.homepage.collapse') +"</div>",
            animationspeed: 250

        });
    }




    if ($().validator) {
        $('#subscribeForm').validator().on('submit', function(e) {
            if (e.isDefaultPrevented()) {
                $error = $("#subscribeForm .with-errors")[0].innerText;
                Lobibox.notify("error", {
                    title: 'Thông báo',
                    pauseDelayOnHover: false,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: 'Vui lòng kiểm tra lại email'
                });
            } else {
                e.preventDefault();

                var email_subscribe = $('#subscribeEmail').val();

                $.post(base_url + '/api/subscribe', {
                    email: email_subscribe
                }).done(function(response) {
                    if (response.code != '200') {
                        var error_type = 'error';
                    } else {
                        var error_type = 'success';
                    }
                    Lobibox.notify(error_type, {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: response.msg
                    });
                });
                return;
            }
        })
    }
    toggleElement(".w-dropdown-toggle");
});

function toggleElementSearch(element) {
    $(document).on("click", element, function(event) {
        event.preventDefault();
        var current = $(this).attr('data-current');
        var next =  $(this).attr('data-next');
        $(this).html(next);
        $(this).attr('data-current', next);
        $(this).attr('data-next', current);
        if($(this).hasClass('block-search-sp')) {
            if ($(this).prev().is(":visible")) {
                $(this).prev().slideUp();
                $(this).removeClass('w--open');
                $(this).prev().removeClass('w--open');
            } else {
                $(this).prev().slideDown();
                $(this).addClass('w--open');
                $(this).prev().addClass('w--open');
            }
        } else {
            if ($(this).next().is(":visible")) {
                $(this).next().slideUp();
                $(this).removeClass('w--open');
                $(this).next().removeClass('w--open');
            } else {
                $(this).next().slideDown();
                $(this).addClass('w--open');
                $(this).next().addClass('w--open');
            }
        }
    });
}

function toggleElement(element) {
    $(document).on("click", element, function(event) {
        event.preventDefault();
        if ($(this).next().is(":visible")) {
            $(this).next().slideUp();
            $(this).removeClass('w--open');
            $(this).next().removeClass('w--open');
        } else {
            $(this).next().slideDown();
            $(this).addClass('w--open');
            $(this).next().addClass('w--open');
        }
    });
}

function autocomplete(element, url) {
    var availableData = new Bloodhound({
        datumTokenizer: function(datum) {
            return Bloodhound.tokenizers.whitespace(datum.name);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: base_url + url + '?term=%QUERY',
            wildcard: '%QUERY',
            filter: function(response) {
                return $.map(response.data, function(items) {
                    return {
                        id: items.id,
                        value: items.name
                    };
                });
            }
        }
    });
    availableData.initialize();
    $(element).typeahead(null, {
        limit: 10,
        displayKey: 'value',
        source: availableData.ttAdapter()
    }).on('typeahead:selected', function(event, selection) {
        if ($(event.target).hasClass("txt-search-area")) {
            $('#txt-search-area').val($(this).val()).trigger("input");
        }
    });
}

function scrolltop() {
    var offset = 220;
    var duration = 500;

    $(window).on("scroll load", function() {
        if ($(this).scrollTop() > offset) {
            $('#back-to-top').fadeIn(duration);
        } else {
            $('#back-to-top').fadeOut(duration);
        }
    });

    $('#back-to-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, duration);
        return false;
    });

    $('#back-to-menu').click(function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, duration);
        return false;
    });

    $('#back-to-bottom').click(function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 10000
        }, duration);
        return false;
    });

    $('.anchor-animation').click(function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, 400);
        return false;
    });
}

function buttonLoading(btn, start) {
    var l = Ladda.create(btn);
    if (start == 'start') {
        l.start();
    } else {
        l.stop();
    }
}

function initReadmore() {
    if ($('.b-description_readmore').length > 0) {
        $('.b-description_readmore').moreLines({
            linecount: 5,
            baseclass: 'b-description',
            basejsclass: 'js-description',
            classspecific: '_readmore',
            buttontxtmore: "<div class='b-description_readmore_button2'><i class='fas fa-chevron-circle-down'></i>"+Lang.get('front.homepage.search.1to5des') +"aaaaaaa Xem thêm</div>",
            buttontxtless: "<div class='b-description_readmore_button2'><i class='fas fa-chevron-circle-up'></i> Thu gọn</div>",
            animationspeed: 250

        });
    }
}

function initSkeleton(el) {
    $(el).scheletrone({
        maskText: true,
        skelParentText: true,
        removeIframe: true,
        backgroundImage: true,
        replaceImageWith: '.bg-image-skeleton',
        onComplete: function() {
            setTimeout(function() {
                $('.pending_el').fadeOut(100).removeClass('pending_el').fadeIn(500);
            }, 500);
        }

    });
}

function skeleton(el) {
    if (el.includes(" ")) {
        var array = el.split(" "),
            i;
        for (i = 0; i < array.length; i++) {
            initSkeleton(array[i]);
        }
    } else {
        initSkeleton(el);
    }

}

function saveValue(id, val){
    localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
}
function getSavedValue(id, type){
    if (localStorage.getItem(id) !== null) {
        if(type == 'input') {
            if(localStorage.getItem(id) != "") {
                if(id == "keyword") {
                    $('#delete_keyword').show();
                }
                if(id == "location") {
                    $('#delete_location').show();
                }
                $('#'+id).val(localStorage.getItem(id));
            }
        } else if(type == 'select') {
            if(localStorage.getItem(id) != "") {
                if(id == "level") {
                    $('#delete_level').show();
                }
                if(id == "type") {
                    $('#delete_type').show();
                }
                if(id == "language") {
                    $('#delete_language').show();
                }
                $('#'+id).ddslick('select', {index: localStorage.getItem(id) });
            }
        } else if(type == 'service') {
            var service = localStorage.getItem(id);
            if(service != "") {
                var temp = new Array();
                temp = service.split("-");
                if(temp.length > 0) {
                    $('#delete_service').show();
                    for (a in temp ) {
                        $("input[type=checkbox][class=checkboxinput][value=" + temp[a] + "]").prop("checked", true);
                    }
                }
            }
        } else if(type == 'servicehome') {
            var service = localStorage.getItem(id);
            if(service != "") {
                var temp = new Array();
                temp = service.split("-");
                if(temp.length > 0) {
                    for (a in temp ) {
                        $(".txt-search-service option[value="+temp[a]+"]").prop('selected', true);
                    }
                }
            }
        } else if(type == 'radio') {
            if(localStorage.getItem(id) != "") {
                if(id == "rating") {
                    $('#delete_rating').show();
                }
                if(id == "price") {
                    $('#delete_price').show();
                }
               
                $("input[type=radio][id="+id+"][value=" + localStorage.getItem(id+'_val') + "]").attr('checked', 'checked');
            }
        } else {
            if(localStorage.getItem(id) != "") {
                $('#'+id).val(localStorage.getItem(id));
            }
        }
    }
}