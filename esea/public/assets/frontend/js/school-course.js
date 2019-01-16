var query = false;
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
    query = true;
});
function querySearch() {
    var SearchArray = {};
    if(localStorage.length > 0) {
        $.each(localStorage, function(e, i) {
            if(e == 'keyword') {
                SearchArray['keyword'] = localStorage.getItem(e);
            }
            if(e == 'location') {
                SearchArray['location'] = localStorage.getItem(e);
            }
            if(e == 'language') {
                SearchArray['language'] = localStorage.getItem('language_val');
            }
            if(e == 'price') {
                SearchArray['price'] = localStorage.getItem('price_val');
            }
            if(e == 'rating') {
                SearchArray['rating'] = localStorage.getItem('rating_val');
            }
            if(e == 'service') {
                SearchArray['service'] = localStorage.getItem(e);
            }
            if(e == 'type') {
                SearchArray['type'] = localStorage.getItem('type_val');
            }
            if(e == 'level') {
                SearchArray['level'] = localStorage.getItem('level_val');
            }
        })
    }

    var param = $.param( SearchArray, true );
    if(param) {
        window.location.replace(base_url+"/schools?"+param);
    } else {
        window.location.replace(base_url+"/schools");
    }
}
$(function() {

    $(document).on("change", ".search_sidebar, .checkboxinput", function(event) {
        event.preventDefault();
        $.each( $('.basic_search'), function() {
            if ($(this).val()) {
                saveValue($(this).attr('id'), $(this).val());
            }
        })
        if($('.radio_rating').length > 0) {
            var rating = $('.radio_rating:checked');
            if(rating.length > 0) {
                saveValue('rating', rating.data('index'));
                saveValue('rating_val', rating.val());
            }
        }

        if($('.radio_price').length > 0) {
            var rating = $('.radio_price:checked');
            if(rating.length > 0) {
                saveValue('price', rating.data('index'));
                saveValue('price_val', rating.val());
            }
        }

        if($('.checkboxinput').length > 0) {
            var service_tmp = [];
            $('.checkboxinput:checked').each(function(i){
                service_tmp[i] = $(this).val();
            });
            var service = service_tmp;
            if(service.length > 0) {
                saveValue('service', service.join('-'));
            }
        }
        querySearch();
    });

    $(document).on("click", "#searchBtn", function(event) {
        event.preventDefault();
        querySearch();
    });

    $(document).on("click", "#delete_keyword", function(event) {
        event.preventDefault();
        localStorage.removeItem('keyword');
        $('#delete_keyword').hide();
        $('input[id=keyword]').val('');
        querySearch();
    });

    $(document).on("click", "#delete_location", function(event) {
        event.preventDefault();
        localStorage.removeItem('location');
        $('#delete_location').hide();
        $('input[id=location]').val('');
        querySearch();
    });

    $(document).on("click", "#delete_level", function(event) {
        event.preventDefault();
        localStorage.removeItem('level');
        localStorage.removeItem('level_val');
        $('#delete_level').hide();
       // $('input[id=level]').find('.dd-option-selected').remove();
        querySearch();
    });

    $(document).on("click", "#delete_type", function(event) {
        event.preventDefault();
        localStorage.removeItem('type');
        localStorage.removeItem('type_val');
        $('#delete_type').hide();
      //  $('input[id=type]').find('.dd-option-selected').remove();
        querySearch();
    });

    $(document).on("click", "#delete_language", function(event) {
        event.preventDefault();
        localStorage.removeItem('language');
        localStorage.removeItem('language_val');
        $('#delete_language').hide();
       // $('input[id=language]').find('.dd-option-selected').remove();
        querySearch();
    });

    $(document).on("click", "#delete_rating", function(event) {
        event.preventDefault();
        localStorage.removeItem('rating');
        localStorage.removeItem('rating_val');
        $('#delete_rating').hide();
        $('input[id=rating]').removeAttr("checked");
        querySearch();
    });
    $(document).on("click", "#delete_price", function(event) {
        event.preventDefault();
        localStorage.removeItem('price');
        localStorage.removeItem('price_val');
        $('#delete_price').hide();
        $('input[id=price]').removeAttr("checked");
        querySearch();
    });
    $(document).on("click", "#delete_service", function(event) {
        event.preventDefault();
        localStorage.removeItem('service');
        $('#delete_service').hide();
        $('input[class=checkboxinput]').prop('checked',false); 
        querySearch();
    });


    $('#language').ddslick({
        data: searchLanguage,
        imagePosition: "left",
        selectText: "<div class='select-holder'><i class='fas fa-globe-americas'></i> "+ Lang.get('front.homepage.school.language') + "</div>",
        onSelected: function (data) {
            if(query) {
                if (data.selectedData) {
                    saveValue('language', data.selectedIndex);
                    saveValue('language_val', data.selectedData.value);
                }
                querySearch();
            }
        }
    });


    $('#type').ddslick({
        data: searchSchoolType,
        imagePosition: "left",
        selectText: "<div class='select-holder'><i class='fas fa-school'></i> "+ Lang.get('front.homepage.school.typedes') + "</div>",
        onSelected: function (data) {
            if(query) {
                if (data.selectedData) {
                    saveValue('type', data.selectedIndex);
                    saveValue('type_val', data.selectedData.value);
                }
                querySearch();
            }
        }
    });

    $('#level').ddslick({
        data: searchSchoolLevel,
        imagePosition: "left",
        selectText: "<div class='select-holder'><i class='fab fa-fort-awesome'></i> "+ Lang.get('front.homepage.school.leveldes') + " </div>",
        onSelected: function (data) {
            if(query) {
                if (data.selectedData) {
                    saveValue('level', data.selectedIndex);
                    saveValue('level_val', data.selectedData.value);
                }
                querySearch();
            }
        }
    });


    $('.txt-search-service').fastselect({
        elementClass: 'fstElement txt-search-advanced _8',
        placeholder: "Xe bus, hồ bơi,...",
        maxItems: 4
    });
    autocomplete(".txt-search-area", "/api/get/city");


    $(document).on("keyup", ".txt-search-keyword", function() {
        $('#txt-search-keyword').val($('.txt-search-keyword').val());
    });

  skeleton('.advertising');
  $('.txt-old').on('input', function(event) {
      this.value = this.value.replace(/[^0-9\.\>\<]/g, '');
  });

  $( ".hover-rating" ).hover(
    function() {
        $('#show-rating-'+$(this).data('id')).css('display', 'block');
    }, function() {
        $('#show-rating-'+$(this).data('id')).css('display', 'none');
    }
  );

  $(document).on("click", ".open-map", function() {
      if (isMapsApiLoaded) {
          getLocation();
      } else {
          $('#openMap').modal('show');
      }
  });

  $(document).on("click", ".btn-search-advanced", function(e) {
      e.preventDefault();
      if ($(".block-search-advanced").is(":visible")) {
          $(".block-search-advanced").css("display", "none");
          $("body").css("overflow", "");
      } else {
          $(".block-search-advanced").css("display", "flex");
          $("body").css("overflow", "hidden");
      }
  });

  $(".block-search-advanced").on("click", ".btn-close-search-advanced", function(e) {
      e.preventDefault();
      $(".block-search-advanced").css("display", "none");
      $("body").css("overflow", "");
  });
  $('[data-toggle="tooltip"]').tooltip();
  $(window).on("load scroll", function() {
      var y = $(this).scrollTop();
      var navWrap = $('.block-search-advanced-top').offset().top + $('.block-search-advanced-top').outerHeight(true);
      if (y > navWrap) {
          $('.block-search-advanced-fix').fadeIn();
      } else {
          $('.block-search-advanced-fix').fadeOut();
      }
  });
});