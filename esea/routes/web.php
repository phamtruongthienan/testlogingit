<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Imgfly::routes();
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::get('', 'Web\HomeController@homepage_index')->name('home.index');

    Route::get('login', 'Web\HomeController@homepage_login')->name('home.login');

    Route::get('sign-up', 'Web\HomeController@homepage_signup')->name('home.signup');

    Route::get('reset-password', 'Web\HomeController@homepage_reset_password')->name('home.resetpassword');

    Route::get('login/{provider}', 'Web\HomeController@homepage_social_login')->name('home.social.login');

    Route::get('callback/{provider}', 'Web\HomeController@homepage_social_callback')->name('home.social.callback');

    Route::get('school/{slug}{id}', 'Web\HomeController@homepage_detail_school')->name('home.detail.school');

    Route::get('schools', 'Web\HomeController@homepage_school')->name('home.school');

    Route::get('map', 'Web\HomeController@homepage_map')->name('home.map');

    Route::get('/press/{slug}', 'Web\NewsController@home_press')->name('home.press');

    Route::get('/course/{slug}', 'Web\NewsController@course_detail')->name('home.course.detail');

    Route::get('/i/{slug}', 'Web\NewsController@home_category')->name('home.news');

    Route::get('/promotion', 'Web\HomeController@homepage_promotion')->name('home.promotion');

    Route::get('promo/{slug}', 'Web\HomeController@homepage_promo_detail')->name('home.promotion.detail');

    Route::get('logout', 'Web\HomeController@homepage_logout')->name('home.logout');

    Route::get('404', 'Web\HomeController@homepage_logout')->name('home.logout');
});

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['auth', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('view/pdf/{filename}', 'Web\HomeController@homepage_view_pdf')->name('home.view.pdf');
    Route::get('account', 'Web\HomeController@homepage_account')->name('home.account');
});

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['auth.api', 'throttle:60,1']], function () {
    Route::post('school-review', 'Api\ApiController@api_post_review')->name('api.post.review');
    Route::post('school-rating', 'Api\ApiController@api_post_rating')->name('api.post.rating');
    Route::post('wishlist', 'Api\ApiController@api_post_wishlist')->name('api.post.wishlist');
    Route::post('account/update', 'Api\ApiController@api_post_account_update')->name('api.post.account.update');
    Route::post('account/update_child', 'Api\ApiController@api_post_child_update')->name('api.post.child.update');
    Route::post('account/add_child', 'Api\ApiController@api_post_child_add')->name('api.post.child.add');
    Route::post('account/change_password', 'Api\ApiController@api_post_change_password')->name('api.post.change.password');
    Route::post('account/delete_child', 'Api\ApiController@api_post_child_delete')->name('api.post.child.delete');
    Route::get('child', 'Api\ApiController@api_get_child_id')->name('api.get.child');

});

Route::get('genitive', 'Api\ApiController@genitive')->name('api.genitive');
Route::post('login', 'Web\HomeController@homepage_login_action')->name('home.login.action');
Route::post('sign-up', 'Web\HomeController@homepage_signup_action')->name('home.signup.action');
Route::post('reset-password', 'Web\HomeController@homepage_reset_password_action')->name('home.resetpassword.action');
Route::post('/sendcontact', 'Web\HomeController@send_contact')->name('send-contact');
Route::post('/booking', 'Web\HomeController@booking')->name('booking');

// ADMIN

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'admin_esearch', 'middleware' => ['auth:admin']], function () {
        Route::get('/500', 'Web\AdminController@admin_home_error')->name('admin.error');
        Route::get('/', 'Web\AdminController@admin_home_index')->name('admin.index')->middleware('permission:admin_website_view');
        Route::get('advertise', 'Web\AdminController@admin_advertise_index')->name('admin.advertise')->middleware('permission:admin_advert_view');
        Route::get('setting', 'Web\AdminController@admin_setting_index')->name('admin.setting')->middleware('permission:admin_website_view');
        Route::get('email', 'Web\AdminController@admin_email_index')->name('admin.email')->middleware('permission:admin_email_view');
        Route::get('group-email', 'Web\AdminController@admin_group_email_index')->name('admin.group.email')->middleware('permission:admin_group_email_view');
        Route::get('client', 'Web\AdminController@admin_client_index')->name('admin.client')->middleware('permission:admin_client_view');
        Route::get('employee', 'Web\AdminController@admin_employee_index')->name('admin.employee')->middleware('permission:admin_user_view');
        Route::get('customer', 'Web\AdminController@admin_customer_index')->name('admin.customer')->middleware('permission:admin_customer_view');
        Route::get('visiter', 'Web\AdminController@admin_visiter_index')->name('admin.visiter')->middleware('permission:admin_booking_view');
        Route::get('school', 'Web\AdminController@admin_school_index')->name('admin.school')->middleware('permission:admin_school_view');
        Route::get('level_school', 'Web\AdminController@admin_level_school_index')->name('admin.level_school')->middleware('permission:admin_school_level_view');
        Route::get('type_school', 'Web\AdminController@admin_type_school_index')->name('admin.type_school')->middleware('permission:admin_school_type_view');
        Route::get('room', 'Web\AdminController@admin_room_index')->name('admin.room')->middleware('permission:admin_school_class_view');
        Route::get('language', 'Web\AdminController@admin_language_index')->name('admin.language')->middleware('permission:admin_school_language_view');
        Route::get('event', 'Web\AdminController@admin_event_index')->name('admin.event')->middleware('permission:admin_school_event_view');
        Route::get('attribute', 'Web\AdminController@admin_attribute_index')->name('admin.attribute')->middleware('permission:admin_school_category_view');
        Route::get('search', 'Web\AdminController@admin_search_index')->name('admin.search')->middleware('permission:admin_search_view');
        Route::get('place', 'Web\AdminController@admin_place_index')->name('admin.place')->middleware('permission:admin_location_view');
        Route::get('role', 'Web\AdminController@admin_role_index')->name('admin.role')->middleware('permission:admin_role_view');
        Route::get('news', 'Web\AdminController@admin_news_index')->name('admin.news')->middleware('permission:admin_news_view');
       // Route::get('localization', 'Web\AdminController@admin_localization_index')->name('admin.localization')->middleware('permission:admin_localization_view');
        Route::get('chart', 'Web\AdminController@admin_chart_index')->name('admin.chart')->middleware('permission:admin_statics_view');
        Route::get('menu', 'Web\AdminController@admin_menu_index')->name('admin.menu')->middleware('permission:admin_menu_view');
        Route::get('logout', 'Web\AdminController@admin_logout_index')->name('admin.logout');



        // AJAX
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('advertise', 'Web\AdminController@admin_advertise_ajax')->name('admin.advertise.ajax');
            Route::post('advertise', 'Web\AdminController@admin_post_advertise_ajax')->name('admin.post.advertise.ajax');
			Route::get('client', 'Web\AdminController@admin_client_ajax')->name('admin.client.ajax');
            Route::post('client', 'Web\AdminController@admin_post_client_ajax')->name('admin.post.client.ajax');
			Route::get('client/school', 'Web\AdminController@admin_get_client_school_ajax')->name('admin.get.client.school.ajax');
            Route::get('employee', 'Web\AdminController@admin_employee_ajax')->name('admin.employee.ajax');
            Route::post('employee', 'Web\AdminController@admin_post_employee_ajax')->name('admin.post.employee.ajax');
            Route::get('customer', 'Web\AdminController@admin_customer_ajax')->name('admin.customer.ajax');
            Route::post('customer', 'Web\AdminController@admin_post_customer_ajax')->name('admin.post.customer.ajax');
            Route::get('place', 'Web\AdminController@admin_place_ajax')->name('admin.place.ajax');
            Route::post('place', 'Web\AdminController@admin_post_place_ajax')->name('admin.post.place.ajax');
            //Route::get('school', 'Web\AdminController@admin_school_ajax')->name('admin.school.ajax');
            //Route::post('school', 'Web\AdminController@admin_post_school_ajax')->name('admin.post.school.ajax');
            Route::any('school/comment', 'Web\AdminController@admin_school_comment_ajax')->name('admin.school.comment.ajax');
            Route::any('school/course', 'Web\AdminController@admin_school_course_ajax')->name('admin.school.course.ajax');
            Route::any('school/program', 'Web\AdminController@admin_school_program_ajax')->name('admin.school.program.ajax');
            Route::any('school', 'Web\AdminController@admin_school_ajax')->name('admin.school.ajax');
            Route::get('child', 'Web\AdminController@admin_child_ajax')->name('admin.child.ajax');
            Route::post('child', 'Web\AdminController@admin_post_child_ajax')->name('admin.post.child.ajax');
            Route::get('visiter', 'Web\AdminController@admin_visiter_ajax')->name('admin.visiter.ajax');
            Route::post('visiter', 'Web\AdminController@admin_post_visiter_ajax')->name('admin.post.visiter.ajax');
            Route::post('sendFeedback', 'Web\AdminController@admin_send_feed_back')->name('admin.send.feed.back');
            Route::get('role', 'Web\AdminController@admin_role_ajax')->name('admin.role.ajax');
            Route::post('role', 'Web\AdminController@admin_post_role_ajax')->name('admin.post.role.ajax');
            Route::get('news', 'Web\AdminController@admin_news_ajax')->name('admin.news.ajax');
            Route::post('news', 'Web\AdminController@admin_post_news_ajax')->name('admin.post.news.ajax');
            Route::get('menu', 'Web\AdminController@admin_menu_ajax')->name('admin.menu.ajax');
            Route::post('menu', 'Web\AdminController@admin_post_menu_ajax')->name('admin.post.menu.ajax');
			Route::get('level', 'Web\AdminController@admin_level_ajax')->name('admin.level.ajax');
            Route::post('level', 'Web\AdminController@admin_post_level_ajax')->name('admin.post.level.ajax');
            Route::get('email', 'Web\AdminController@admin_email_ajax')->name('admin.email.ajax');
            Route::post('email', 'Web\AdminController@admin_post_email_ajax')->name('admin.post.email.ajax');
            Route::get('emailStatus', 'Web\AdminController@admin_email_status_ajax')->name('admin.email.status.ajax');
            Route::post('emailStatus', 'Web\AdminController@admin_post_email_status_ajax')->name('admin.post.email.status.ajax');
            Route::get('type', 'Web\AdminController@admin_type_ajax')->name('admin.type.ajax');
            Route::post('type', 'Web\AdminController@admin_post_type_ajax')->name('admin.post.type.ajax');
            Route::get('event', 'Web\AdminController@admin_event_ajax')->name('admin.event.ajax');
            Route::post('event', 'Web\AdminController@admin_post_event_ajax')->name('admin.post.event.ajax');
            Route::get('room', 'Web\AdminController@admin_room_ajax')->name('admin.room.ajax');
            Route::post('room', 'Web\AdminController@admin_post_room_ajax')->name('admin.post.room.ajax');
            Route::get('language', 'Web\AdminController@admin_language_ajax')->name('admin.language.ajax');
            Route::post('language', 'Web\AdminController@admin_post_language_ajax')->name('admin.post.language.ajax');
            Route::get('setting', 'Web\AdminController@admin_setting_ajax')->name('admin.setting.ajax');
            Route::post('setting', 'Web\AdminController@admin_post_setting_ajax')->name('admin.post.setting.ajax');
            Route::get('statics/keyword', 'Web\AdminController@admin_statics_keyword_ajax')->name('admin.statics.keyword.ajax');
            Route::get('statics/view', 'Web\AdminController@admin_statics_view_ajax')->name('admin.statics.view.ajax');
        });
    });
    Route::group(['prefix' => 'admin_esearch'], function () {
        Route::get('login', 'Web\AdminController@admin_login_index')->name('admin.login');
        Route::post('login', 'Web\AdminController@admin_login_action')->name('admin.login.action');
    });
});
