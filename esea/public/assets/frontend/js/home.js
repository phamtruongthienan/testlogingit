$(window).on('load', function(){
    if($('.basic_search').length > 0) {
        $.each( $('.basic_search'), function() {
            getSavedValue($(this).attr('id'), 'input');
        })
    }

    if($('.dd-container').length > 0) {
        $.each( $('.dd-container'), function() {
            getSavedValue($(this).attr('id'), 'select');
        })
    }
    if($('.radioinput').length > 0) {
        $.each( $('.radioinput'), function() {
            getSavedValue($(this).attr('id'), 'radio');
        })
    }
    if($('input[type=checkbox][class=checkboxinput]').length > 0) {
        getSavedValue('service', 'service');
    }
});
$(function() {

    if($('.txt-search-service').length > 0) {
        getSavedValue('service', 'servicehome');
    }

    $(document).on("click", "#searchBtn, #searchBtn2", function(event) {
        event.preventDefault();
        var SearchArray = {};
        $.each( $('.basic_search'), function() {
            if ($(this).val()) {
                SearchArray[$(this).attr('id')] = $(this).val();
                saveValue($(this).attr('id'), $(this).val());
            }
        })
        $.each( $('.dd-container'), function() {
            var ddData = $('#'+($(this).attr('id'))).data('ddslick');
            if (ddData.selectedData) {
                SearchArray[$(this).attr('id')] = ddData.selectedData.value;
                saveValue($(this).attr('id'), ddData.selectedIndex);
                saveValue($(this).attr('id')+'_val', ddData.selectedData.value);
            }
        })
        if($('#service').val().length > 0) {
            var service = $('#service').val();
            SearchArray['service'] = service.join('-');
            saveValue('service', service.join('-'));
        }
        var param = $.param( SearchArray, true );
        if(param) {
            window.location.replace(base_url+"/schools?"+param);
        } else {
            window.location.replace(base_url+"/schools");
        }
    });

    var searchAge = [{
            text: "0 - 1 tuổi",
            value: 1,
            selected: false,
            description: "Độ tuổi học mầm non",
        }, {
            text: "1 - 6 tuổi",
            value: 2,
            selected: false,
            description: "Độ tuổi học tiểu học",
        }, {
            text: "6 - 12 tuổi",
            value: 3,
            selected: false,
            description: "Độ tuổi học cấp 2",
        }, {
            text: "12 - 18 tuổi +",
            value: 4,
            selected: false,
            description: "Độ tuổi học cấp 3, đại học,...",
        },

    ];

    $('#age').ddslick({
        data: searchAge,
        imagePosition: "left",
        selectText: "<div class='select-holder'><i class='fas fa-user-graduate'></i> Độ tuổi trẻ em</div>",
    });

    var searchPrice = [{
            text: Lang.get('front.homepage.search.1to5')  ,
            value: 1,
            selected: false,
            description: Lang.get('front.homepage.search.1to5des'),
        }, {
            text: Lang.get('front.homepage.search.5to10'),
            value: 2,
            selected: false,
            description: Lang.get('front.homepage.search.5to10des'),
        }, {
            text: Lang.get('front.homepage.search.10to15'),
            value: 3,
            selected: false,
            description: Lang.get('front.homepage.search.10to15des'),
        }, {
            text: Lang.get('front.homepage.search.15'),
            value: 4,
            selected: false,
            description: Lang.get('front.homepage.search.15des'),
        },

    ];

    $('#price').ddslick({
        data: searchPrice,
        imagePosition: "left",
        selectText: "<div class='select-holder'><i class='fas fa-dollar-sign'></i> "+ Lang.get('front.homepage.search.price') +" </div>",
    });

    $('#language').ddslick({
        data: searchLanguage,
        imagePosition: "left",
        selectText: "<div class='select-holder'><i class='fas fa-globe-americas'></i> "+ Lang.get('front.homepage.search.languages') +" </div>",
    });

    var searchRating = [{
            text: "1 <i class='fas fa-star text-warning'></i>",
            value: 1,
            selected: false,
            description: Lang.get('front.homepage.search.searchwith') + " <i class='fas fa-star text-warning'></i>",
        }, {
            text: "2 <i class='fas fa-star text-warning'></i>",
            value: 2,
            selected: false,
            description: Lang.get('front.homepage.search.searchwith') +" <i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i>",
        }, {
            text: "3 <i class='fas fa-star text-warning'></i>",
            value: 3,
            selected: false,
            description: Lang.get('front.homepage.search.searchwith') +" <i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i>",
        }, {
            text: "4 <i class='fas fa-star text-warning'></i>",
            value: 4,
            selected: false,
            description: Lang.get('front.homepage.search.searchwith') +" <i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i>",
        }, {
            text: "5 <i class='fas fa-star text-warning'></i>",
            value: 5,
            selected: false,
            description: Lang.get('front.homepage.search.searchwith') +" <i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i><i class='fas fa-star text-warning'></i>",
        },

    ];

    $('#rating').ddslick({
        data: searchRating,
        imagePosition: "left",
        selectText: "<div class='select-holder'><i class='fas fa-star'></i> "+ Lang.get('front.homepage.search.evaluate') +" </div>",
    });

    $('#type').ddslick({
        data: searchSchoolType,
        imagePosition: "left",
        selectText: "<div class='select-holder'><i class='fas fa-school'></i>"+ Lang.get('front.homepage.school.typedes') + "</div>",
    });

    $('#level').ddslick({
        data: searchSchoolLevel,
        imagePosition: "left",
        selectText: "<div class='select-holder'><i class='fab fa-fort-awesome'></i> "+ Lang.get('front.homepage.school.leveldes') + " </div>",
    });


    $('.txt-search-service').fastselect({
        elementClass: 'fstElement txt-search-advanced _8',
        placeholder: Lang.get('front.homepage.search.utilitiesplace') ,
        maxItems: 4
    });
    autocomplete(".txt-search-area", "/api/get/city");


    $(document).on("keyup", ".txt-search-keyword", function() {
        $('#txt-search-keyword').val($('.txt-search-keyword').val());
    });

    $(document).on("change", ".txt-search-service", function() {
        if($('.txt-search-service').val().length) {
            $('._8').css('background-image','unset');
            $('._8').css('height','100%');
        } else {
            $('._8').css('background-image','');
            $('._8').css('height','65px');
        }
    });


    $('[data-toggle="tooltip"]').tooltip();
    toggleElementSearch(".btn-search-advanced");
    $('.w-slider-mask').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: $('.w-slider-arrow-left'),
        nextArrow: $('.w-slider-arrow-right')
    });
    $(window).on("load scroll", function() {
        var y = $(this).scrollTop();
        var navWrap = $('.block-search-basic').offset().top + $('.block-search-basic').outerHeight(true);
        if (y > navWrap) {
            $('.block-search-basic-fix').fadeIn();
        } else {
            $('.block-search-basic-fix').fadeOut();
        }
    });

    $(document).on("click", ".open-map-location", function() {
        var query_string_map = $(this).data('map');
        url_map_lat_api = $(this).data('lat');
        url_map_lng_api = $(this).data('lng');
        url_map_current = $(this).data('location');
        url_map_callback_api = "/api/map/other/" + query_string_map

        if (query_string_map != temp_map) {
            $('#nearMap-main').html('').html('<div id="map"></div>')
            getLocation();
        } else {
            $('#openMap').modal('show');
        }
        temp_map = query_string_map;
    });



    $(".block-search-location").on("click", ".btn-close-search-location", function(e) {
        e.preventDefault();
        $(".block-search-location").css("display", "none");
        $("body").css("overflow", "");
    });
});