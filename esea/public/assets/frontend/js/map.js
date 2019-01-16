var listAddress = [],
    data_response, options, contentInner, rating;
$(function() {
    $('#openMap').on('hidden.bs.modal', function() {
        gmarkers = [];
        count = 0;
    })

    $(document).on("click", "#btnSearchSchool", function() {
        if ($("#listSearchSchool").hasClass('show')) {
            $("#listSearchSchool, #btnSearchSchool").removeClass("show").addClass('hide');
        } else {
            $("#listSearchSchool, #btnSearchSchool").removeClass('hide').addClass("show");
        }
    });

    $(window).on('load resize', function() {
        var width = window.innerWidth || $(window).width();
        if (width >= 768) {
            $("#listSearchSchool, #btnSearchSchool").addClass('show').removeClass("hide");
        } else {
            $("#listSearchSchool, #btnSearchSchool").removeClass('show').addClass("hide");
        }
    });
});
var gmarkers = [];
var markers = [];
var id_remove;
var count = 0;
var map, infowindow, infowindow_here, requestSearch, directionsService, data_post, scope = {};
var isMapsApiLoaded = true;

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
}

function showPosition(position) {
    skeleton('.product-copy .map');
    contentInner = '';
    listAddress = [];
    var n = url_map_callback_api.search('/map/other/');
    if (n > 0) {
        data_post = {
            lat: url_map_lat_api,
            lng: url_map_lng_api,
            language: lang_id
        };
        data_center = {
            lat: url_map_lat_api,
            lng: url_map_lng_api
        };
        url_map_zoom = 12;
        url_map_distance = 100;
    } else {
        var na = url_map_callback_api.search('/map/get/');
        if (na > 0) {
            data_post = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
                id: school_map_id,
                language: lang_id
            };
            data_center = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            url_map_zoom = 14;
            url_map_distance = 10;
        } else {
            data_post = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
                language: lang_id
            };
            data_center = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            url_map_zoom = 14;
            url_map_distance = 10;
        }
    }
    $.ajax({
        url: base_url + url_map_callback_api + "?include=m_schooltranslations,m_schoolimages,m_schoollevel.m_schoolleveltranslations&append=rating,review",
        data: data_post,
        type: "post",
        success: function(response) {
            data_response = response;
            if (response.length > 0) {
                $.each(response, function(i, item) {
                    listAddress.push(response[i].mSchooltranslations[0].name + ', ' + response[i].mSchooltranslations[0].address);
                    $.each(response[i].mSchoolimages, function(i1, item) {
                        if (response[i].mSchoolimages[i1].is_avatar == 1) {
                            imageAvatar = base_url + '/imgfly/public/img/' + response[i].mSchoolimages[i1].image;
                        }
                    })
                    rating = '';
                    for (i2 = 1; i2 <= response[i].rating; i2++) {
                        rating += '<i class="fas fa-star text-warning"></i>';
                    }
                    contentInner += '<a class="map-product-items" id="location_id_' + i + '" href="javascript:google.maps.event.trigger(gmarkers[' + i + '],\'click\');" data-id="" data-image="' + imageAvatar + '?w=300" data-name="' + response[i].mSchooltranslations[0].name + '" data-address="' + response[i].mSchooltranslations[0].address + '" data-link="' + base_url + '/' + response[i].mSchooltranslations[0].slug + '"><div class="product-copy"><div class="product-photo _1"  style="background-image: url(' + imageAvatar + '?w=300) !important;"></div><div class="div-block-1176"><div class="div-block-71"><div class="div-block-1119"><h3 class="h2-school-name-copy" style="font-size:15px;width:200px">' + response[i].mSchooltranslations[0].name + '</h3><div class="div-block-diamond">' + rating + '</div></div><div class="div-block-1105-copy"><div class="div-icon-text"><div class="div-block-ico _1"></div><div class="text-language-copy" style="font-size:13px;width:200px">' + response[i].mSchoollevel.mSchoolleveltranslations[0].name + '</div></div></div></div></div></div></a>';
                })
                $('.result-map-items').html(contentInner);
            } else {
                $('#listSearchSchool').hide();
            }
            if (listAddress.length == 0) {
                options = {
                    disableDoubleClickZoom: true,
                    draggable: false,
                    scrollwheel: false,
                    panControl: false,
                    zoomControl: false,
                    center: data_center,
                    streetViewControl: false,
                    zoom: url_map_zoom,
                    clickableIcons: false,
                    fullscreenControl: false
                };
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: false,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: 'Không tìm thấy kết quả ở vị trị của bạn.'
                });
                
            } else {
                options = {
                    zoom: url_map_zoom,
                    center: data_center,
                    clickableIcons: false,
                    fullscreenControl: false,
                    streetViewControl: false,
                    gestureHandling: 'greedy',
                    disableDoubleClickZoom: true,
                    zoomControl: false,
                };
                if(listAddress.length == 1) {
                    map_click = true;
                    $('#listSearchSchool').hide();
                } else {
                    $('#listSearchSchool').show();
                } 
            }

            initMap(options);
            $('#openMap').modal('show');
            $('.result-map-items').slimScroll({
                height: '90vh',
                railVisible: true,
                alwaysVisible: false,
                allowPageScroll: true,
                disableFadeOut: true,
                size: '5px',
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#listSearchSchool').hide();
            $('#openMap').modal('hide');
        }
    });

}

function initMap(options) {
    clearOverlays();
    scope.directionsService = new google.maps.DirectionsService();
    map = new google.maps.Map(document.getElementById('map'), options);
    var geocoder = new google.maps.Geocoder();
    geocodeAddress(geocoder, map);
    var myoverlay = new google.maps.OverlayView();
    myoverlay.draw = function() {
        this.getPanes().markerLayer.id = 'markerLayer';
    };
    myoverlay.setMap(map);
    isMapsApiLoaded = false;
}



function geocodeAddress(geocoder, resultsMap) {
    infowindow_here = new google.maps.InfoWindow();

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {

            var n = url_map_callback_api.search('/map/other/');
            if (n > 0) {
                var latlng = new google.maps.LatLng(url_map_lat_api, url_map_lng_api);
            } else {
                var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            }

            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                if (status === 'OK') {
                    resultsMap.setCenter(results[0].geometry.location);
                    var service = new google.maps.places.PlacesService(resultsMap);

                    service.getDetails({
                        placeId: results[0].place_id
                    }, function(place, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            marker = new google.maps.Marker({
                                map: resultsMap,
                                draggable: true,
                                icon: {
                                    url: 'data:image/png;base64,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',
                                    scaledSize: new google.maps.Size(40, 40) // pixels
                                },
                                animation: google.maps.Animation.DROP,
                                position: results[0].geometry.location,
                                title: results[0]['formatted_address']
                            });
                            markers.push(marker);
                            for (var i = 0; i < markers.length; i++) {
                                markers[i].setAnimation(null);
                            }
                            toggleBounce(marker);
                            for (var i = 0; i < listAddress.length; i++) {
                                renderMap(place.formatted_address, url_map_distance, listAddress[i]);
                            }
                        }
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
            var n = url_map_callback_api.search('/map/other/');
            if (n > 0) {
                $('.current-location').html(url_map_current);
            }

        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}

function toggleBounce(ele) {
    if (ele.getAnimation() !== null) {
        ele.setAnimation(null);
    } else {
        ele.setAnimation(google.maps.Animation.BOUNCE);
    }
}

function calcRoute(pointStart, pointEnd) {
    var start = pointStart;
    var end = pointEnd;
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    m_get_directions_route(request);
}

function m_get_directions_route(request) {
    var delayFactor = 0;
    scope.directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            var directionsDisplay = new google.maps.DirectionsRenderer({
                map: map,
                preserveViewport: true,
                suppressMarkers: true
            });
            directionsDisplay.setDirections(response);
            computeTotals(response, infowindow);
        } else if (status === google.maps.DirectionsStatus.OVER_QUERY_LIMIT) {
            delayFactor++;
            setTimeout(function() {
                m_get_directions_route(request);
            }, delayFactor * 1000);
        } else {
            console.log("Route: " + status);
        }
    });
}

function renderMap(add, rad, textSearch) {
    $('.current-location').html(add);
    var address = add;
    var radius = parseInt(rad) * 1000;
    var geocoder = new google.maps.Geocoder();
    var selLocLat = 0;
    var selLocLng = 0;

    geocoder.geocode({
        'address': address
    }, function(results, status) {
        if (status === 'OK') {
            selLocLat = results[0].geometry.location.lat();
            selLocLng = results[0].geometry.location.lng();

            var pyrmont = new google.maps.LatLng(selLocLat, selLocLng);

            requestSearch = {
                location: pyrmont,
                radius: radius,
                name: textSearch
            };

            infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch(requestSearch, callback);
        } else {
            console.log('NO');
        }
    });
}

function callback(results, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
            if (gmarkers.length < listAddress.length) {
                createMarker(results[i], results[i].icon);
            }
        }
        //  calcRoute(requestSearch.location, results[0].geometry.location);
    }
}

function createMarker(place, icon) {
    var url_photo, data_link, data_image, data_name, data_address;
    var markers2 = [];
    $('#location_id_' + count).attr('data-id', place.id);
    url_photo = $('a[data-id=' + place.id + ']').data('image');
    var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location,
        icon: {
            url: url_photo,
            scaledSize: new google.maps.Size(40, 40) // pixels
        },
        animation: google.maps.Animation.DROP,
        optimized: false
    });
    markers2.push(marker);
    gmarkers.push(marker);
    google.maps.event.addListener(infowindow, 'domready', function() {
        var iwOuter = $('.gm-style-iw');
        var iwBackground = iwOuter.prev();
        iwBackground.children(':nth-child(2)').css({
            'display': 'none'
        });
        iwBackground.children(':nth-child(4)').css({
            'display': 'none'
        });
    });

    google.maps.event.addListener(marker, 'click', function() {
        var center = marker.getPosition();
        var offsetX = 0;
        var offsetY = 0.2;
        var span = map.getBounds().toSpan();
        var newCenter = {
            lat: center.lat() + span.lat() * offsetY,
            lng: center.lng() + span.lng() * offsetX
        };
        map.panTo(newCenter);
        data_link = $('a[data-id=' + place.id + ']').data('link');
        data_image = $('a[data-id=' + place.id + ']').data('image');
        data_name = $('a[data-id=' + place.id + ']').data('name');
        data_address = $('a[data-id=' + place.id + ']').data('address');
        var content_inner = '<div class="card"> \
      <img class="card-img-top" src="' + data_image + '"> \
      <div class="card-body" id="card"> \
        <h5 class="card-title"><i class="fas fa-graduation-cap"></i>  <a href="' + data_link + '">' + data_name + '</a></h5> \
        <i class="fas fa-location-arrow"></i> ' + data_address;
        infowindow.setContent(content_inner);
        $('#view_' + place.id).attr('href', 'testss');
        infowindow.open(map, this);
        calcRoute(requestSearch.location, place.geometry.location, infowindow);
    });
    $('#location_id_' + count).show();
    if(map_click) {
        google.maps.event.trigger(gmarkers[0],'click');
    }
    count++;
}

function computeTotals(result, infowindow) {
    var totalDist = 0;
    var totalTime = 0;
    var myroute = result.routes[0];
    for (i = 0; i < myroute.legs.length; i++) {
        totalDist += myroute.legs[i].distance.value;
        totalTime += myroute.legs[i].duration.value;
    }
    totalDist = totalDist / 1000.
    var append_inner = infowindow.getContent() + "<br><i class='fas fa-car'></i> Khoảng cách: " + totalDist.toFixed(2) + " km <br><i class='fas fa-clock'></i> Thời gian di chuyển:" + (totalTime / 60).toFixed(0) + " phút </div></div>";
    infowindow.setContent(append_inner);
}

function clearOverlays() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers = [];
}