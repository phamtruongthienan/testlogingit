<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            // WEBSITE
            [
                'name' => 'admin_website_view',
                'display_name' => 'Xem cấu hình website',
                'description' => 'Website View'
            ],
            [
                'name' => 'admin_website_update',
                'display_name' => 'Cập nhật cấu hình website',
                'description' => 'Website Update'
            ],
            // EMAIL
            [
                'name' => 'admin_email_view',
                'display_name' => 'Xem danh sách email',
                'description' => 'Email View'
            ],
            [
                'name' => 'admin_email_update',
                'display_name' => 'Cập nhật email',
                'description' => 'Email Update'
            ],
            [
                'name' => 'admin_email_delete',
                'display_name' => 'Xóa email',
                'description' => 'Email Delete'
            ],
            [
                'name' => 'admin_email_create',
                'display_name' => 'Tạo email',
                'description' => 'Email Create'
            ],
            [
                'name' => 'admin_email_send',
                'display_name' => 'Gửi email',
                'description' => 'Email Send'
            ],
            // GROUP EMAIL
            [
                'name' => 'admin_group_email_view',
                'display_name' => 'Xem danh sách nhóm người nhận',
                'description' => 'Email Group View'
            ],
            [
                'name' => 'admin_group_email_update',
                'display_name' => 'Cập nhật nhóm người nhận',
                'description' => 'Email Group Update'
            ],
            [
                'name' => 'admin_group_email_delete',
                'display_name' => 'Xóa nhóm người nhận',
                'description' => 'Email Group Delete'
            ],
            [
                'name' => 'admin_group_email_create',
                'display_name' => 'Tạo nhóm người nhận',
                'description' => 'Email Group Create'
            ],

            // ADVERTS
            [
                'name' => 'admin_advert_view',
                'display_name' => 'Xem danh sách quảng cáo',
                'description' => 'Advert View'
            ],
            [
                'name' => 'admin_advert_update',
                'display_name' => 'Cập nhật quảng cáo',
                'description' => 'Advert Update'
            ],
            [
                'name' => 'admin_advert_delete',
                'display_name' => 'Xóa quảng cáo',
                'description' => 'Advert Delete'
            ],
            [
                'name' => 'admin_advert_create',
                'display_name' => 'Tạo quảng cáo',
                'description' => 'Advert Create'
            ],

            // Client
            [
                'name' => 'admin_client_view',
                'display_name' => 'Xem danh sách đối tác',
                'description' => 'Client View'
            ],
            [
                'name' => 'admin_client_update',
                'display_name' => 'Cập nhật đối tác',
                'description' => 'Client Update'
            ],
            [
                'name' => 'admin_client_delete',
                'display_name' => 'Xóa đối tác',
                'description' => 'Client Delete'
            ],
            [
                'name' => 'admin_client_create',
                'display_name' => 'Tạo đối tác',
                'description' => 'Client Create'
            ],

            // USER
            [
                'name' => 'admin_user_view',
                'display_name' => 'Xem danh sách nhân viên',
                'description' => 'User View'
            ],
            [
                'name' => 'admin_user_update',
                'display_name' => 'Cập nhật nhân viên',
                'description' => 'User Update'
            ],
            [
                'name' => 'admin_user_delete',
                'display_name' => 'Xóa nhân viên',
                'description' => 'User Delete'
            ],
            [
                'name' => 'admin_user_create',
                'display_name' => 'Tạo nhân viên',
                'description' => 'User Create'
            ],
            [
                'name' => 'admin_user_view_log',
                'display_name' => 'Xem danh sách hoạt động của nhân viên',
                'description' => 'User View Log'
            ],

            // CUSTOMER
            [
                'name' => 'admin_customer_view',
                'display_name' => 'Xem danh sách khách hàng',
                'description' => 'Customer View'
            ],
            [
                'name' => 'admin_customer_update',
                'display_name' => 'Cập nhật khách hàng',
                'description' => 'Customer Update'
            ],
            [
                'name' => 'admin_customer_delete',
                'display_name' => 'Xóa khách hàng',
                'description' => 'Customer Delete'
            ],
            [
                'name' => 'admin_customer_create',
                'display_name' => 'Tạo khách hàng',
                'description' => 'Customer Create'
            ],

            // BOOKING
            [
                'name' => 'admin_booking_view',
                'display_name' => 'Xem danh sách khách tham quan',
                'description' => 'Booking View'
            ],
            [
                'name' => 'admin_booking_update',
                'display_name' => 'Cập nhật khách tham quan',
                'description' => 'Booking Update'
            ],
            [
                'name' => 'admin_booking_delete',
                'display_name' => 'Xóa khách tham quan',
                'description' => 'Booking Delete'
            ],
            [
                'name' => 'admin_booking_create',
                'display_name' => 'Tạo khách tham quan',
                'description' => 'Booking Create'
            ],

            // SCHOOL
            [
                'name' => 'admin_school_view',
                'display_name' => 'Xem trường',
                'description' => 'School View'
            ],
            [
                'name' => 'admin_school_update',
                'display_name' => 'Cập nhật trường',
                'description' => 'School Update'
            ],
            [
                'name' => 'admin_school_delete',
                'display_name' => 'Xóa trường',
                'description' => 'School Delete'
            ],
            [
                'name' => 'admin_school_create',
                'display_name' => 'Tạo trường',
                'description' => 'School Create'
            ],
            // SCHOOL LEVEL
            [
                'name' => 'admin_school_level_view',
                'display_name' => 'School Level View',
                'description' => 'School Level View'
            ],
            [
                'name' => 'admin_school_level_update',
                'display_name' => 'School Level Update',
                'description' => 'School Level Update'
            ],
            [
                'name' => 'admin_school_level_delete',
                'display_name' => 'School Level Delete',
                'description' => 'School Level Delete'
            ],
            [
                'name' => 'admin_school_level_create',
                'display_name' => 'Tạo cấp trường',
                'description' => 'School Level Create'
            ],

            // SCHOOL TYPE
            [
                'name' => 'admin_school_type_view',
                'display_name' => 'Xem danh sách loại trường',
                'description' => 'School Type View'
            ],
            [
                'name' => 'admin_school_type_update',
                'display_name' => 'Cập nhật loại trường',
                'description' => 'School Type Update'
            ],
            [
                'name' => 'admin_school_type_delete',
                'display_name' => 'Xóa loại trường',
                'description' => 'School Type Delete'
            ],
            [
                'name' => 'admin_school_type_create',
                'display_name' => 'Tạo loại trường',
                'description' => 'School Type Create'
            ],
            // SCHOOL CLASS
            [
                'name' => 'admin_school_class_view',
                'display_name' => 'Xem danh sách phòng học',
                'description' => 'School Class View'
            ],
            [
                'name' => 'admin_school_class_update',
                'display_name' => 'Cập nhật phòng học',
                'description' => 'School Class Update'
            ],
            [
                'name' => 'admin_school_class_delete',
                'display_name' => 'Xóa phòng học',
                'description' => 'School Class Delete'
            ],
            [
                'name' => 'admin_school_class_create',
                'display_name' => 'Tạo phòng học',
                'description' => 'School Class Create'
            ],
            // SCHOOL LANGUAGE
            [
                'name' => 'admin_school_language_view',
                'display_name' => 'Xem danh sách ngoại ngữ',
                'description' => 'School Language View'
            ],
            [
                'name' => 'admin_school_language_update',
                'display_name' => 'Cập nhật ngoại ngữ',
                'description' => 'School Language Update'
            ],
            [
                'name' => 'admin_school_language_delete',
                'display_name' => 'Xóa ngoại ngữ',
                'description' => 'School Language Delete'
            ],
            [
                'name' => 'admin_school_language_create',
                'display_name' => 'Tạo ngoại ngữ',
                'description' => 'School Language Create'
            ],
            // SCHOOL EVENT
            [
                'name' => 'admin_school_event_view',
                'display_name' => 'Xem danh sách sự kiện',
                'description' => 'School Event View'
            ],
            [
                'name' => 'admin_school_event_update',
                'display_name' => 'Cập nhật sự kiện',
                'description' => 'School Event Update'
            ],
            [
                'name' => 'admin_school_event_delete',
                'display_name' => 'Xóa sự kiện',
                'description' => 'School Event Delete'
            ],
            [
                'name' => 'admin_school_event_create',
                'display_name' => 'Tạo sự kiện',
                'description' => 'School Event Create'
            ],
            // SCHOOL CATEGORY
            [
                'name' => 'admin_school_category_view',
                'display_name' => 'Xem danh sách thuộc tính',
                'description' => 'School Category View'
            ],
            [
                'name' => 'admin_school_category_update',
                'display_name' => 'Cập nhật thuộc tính',
                'description' => 'School Category Update'
            ],
            [
                'name' => 'admin_school_category_delete',
                'display_name' => 'Xóa thuộc tính',
                'description' => 'School Category Delete'
            ],
            [
                'name' => 'admin_school_category_create',
                'display_name' => 'Tạo thuộc tính',
                'description' => 'School Category Create'
            ],
            // SEARCH
            [
                'name' => 'admin_search_view',
                'display_name' => 'Xem danh sách tìm kiếm',
                'description' => 'Search View'
            ],
            [
                'name' => 'admin_search_update',
                'display_name' => 'Cập nhật tìm kiếm',
                'description' => 'Search Update'
            ],
            [
                'name' => 'admin_search_delete',
                'display_name' => 'Xóa tìm kiếm',
                'description' => 'Search Delete'
            ],
            [
                'name' => 'admin_search_create',
                'display_name' => 'Tạo tìm kiếm',
                'description' => 'Search Create'
            ],
            // LOCATION
            [
                'name' => 'admin_location_view',
                'display_name' => 'Xem danh sách địa điểm',
                'description' => 'Location View'
            ],
            [
                'name' => 'admin_location_update',
                'display_name' => 'Cập nhật địa điểm',
                'description' => 'Location Update'
            ],
            [
                'name' => 'admin_location_delete',
                'display_name' => 'Xóa địa điểm',
                'description' => 'Location Delete'
            ],
            [
                'name' => 'admin_location_create',
                'display_name' => 'Tạo địa điểm',
                'description' => 'Location Create'
            ],
            // ROLE
            [
                'name' => 'admin_role_view',
                'display_name' => 'Xem quyền',
                'description' => 'Role View'
            ],
            [
                'name' => 'admin_role_update',
                'display_name' => 'Cập nhật quyền',
                'description' => 'Role Update'
            ],
            [
                'name' => 'admin_role_delete',
                'display_name' => 'Xóa quyền',
                'description' => 'Role Delete'
            ],
            [
                'name' => 'admin_role_create',
                'display_name' => 'Tạo quyền',
                'description' => 'Role Create'
            ],
            // NEWS
            [
                'name' => 'admin_news_view',
                'display_name' => 'Xem tin tức',
                'description' => 'News View'
            ],
            [
                'name' => 'admin_news_update',
                'display_name' => 'Cập nhật tin tức',
                'description' => 'News Update'
            ],
            [
                'name' => 'admin_news_delete',
                'display_name' => 'Xóa tin tức',
                'description' => 'News Delete'
            ],
            [
                'name' => 'admin_news_create',
                'display_name' => 'Tạo tin tức',
                'description' => 'News Create'
            ],
            // LOCALIZATION
            [
                'name' => 'admin_localization_view',
                'display_name' => 'Xem localization',
                'description' => 'Localization View'
            ],
            [
                'name' => 'admin_localization_update',
                'display_name' => 'Cập nhật localization',
                'description' => 'Localization Update'
            ],
            [
                'name' => 'admin_localization_delete',
                'display_name' => 'Xóa localization',
                'description' => 'Localization Delete'
            ],
            [
                'name' => 'admin_localization_create',
                'display_name' => 'Tạo localization',
                'description' => 'Localization Create'
            ],
            // STATICS
            [
                'name' => 'admin_statics_view',
                'display_name' => 'Xem thống kê',
                'description' => 'Statics View'
            ],
            [
                'name' => 'admin_statics_update',
                'display_name' => 'Cập nhật thống kê',
                'description' => 'Statics Update'
            ],
            [
                'name' => 'admin_statics_delete',
                'display_name' => 'Xóa thống kê',
                'description' => 'Statics Delete'
            ],
            [
                'name' => 'admin_statics_create',
                'display_name' => 'Tạo thống kê',
                'description' => 'Statics Create'
            ],
            // MENU
            [
                'name' => 'admin_menu_view',
                'display_name' => 'Xem menu',
                'description' => 'Menu View'
            ],
            [
                'name' => 'admin_menu_update',
                'display_name' => 'Cập nhật menu',
                'description' => 'Menu Update'
            ],
            [
                'name' => 'admin_menu_delete',
                'display_name' => 'Xóa menu',
                'description' => 'Menu Delete'
            ],
            [
                'name' => 'admin_menu_create',
                'display_name' => 'Tạo menu',
                'description' => 'Menu Create'
            ]
        ];
        DB::table('permissions')->insert($permission);
    }
}
