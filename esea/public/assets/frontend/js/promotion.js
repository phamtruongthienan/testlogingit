$(function() {
  $(document).on("click", "#view-more-promotion", function(e) {
      e.preventDefault();
      var btn = this;
      buttonLoading(btn, 'start');
      if (typeof exclude_promo !== undefined) {
          var url_more_promotion = base_url + "/api/get/promotion?page=" + current_page_promotion + "&record=" + num_promo + "&exclude=" + exclude_promo;
      } else {
          var url_more_promotion = base_url + "/api/get/promotion?page=" + current_page_promotion + "&record=" + num_promo;
      }
      $.get(url_more_promotion, function(response) {
              current_page_promotion++;
              if (response.length == 0) {
                  $('#view-more-promotion').hide();
              } else {
                  $('.load-more-result').append(response);
              }
          })
          .always(function() {
              initReadmore();
              buttonLoading(btn, 'stop');
          });
      return false;
  });
});