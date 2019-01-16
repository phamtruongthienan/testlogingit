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
                'display_name' => 'Website View',
                'description' => 'Website View'
            ],
            [
                'name' => 'admin_website_update',
                'display_name' => 'Website Update',
                'description' => 'Website Update'
            ],
            // EMAIL
            [
                'name' => 'admin_email_view',
                'display_name' => 'Email View',
                'description' => 'Email View'
            ],
            [
                'name' => 'admin_email_update',
                'display_name' => 'Email Update',
                'description' => 'Email Update'
            ],
            [
                'name' => 'admin_email_delete',
                'display_name' => 'Email Delete',
                'description' => 'Email Delete'
            ],
            [
                'name' => 'admin_email_create',
                'display_name' => 'Email Create',
                'description' => 'Email Create'
            ],
            [
                'name' => 'admin_email_send',
                'display_name' => 'Email Send',
                'description' => 'Email Send'
            ],
            // GROUP EMAIL
            [
                'name' => 'admin_group_email_view',
                'display_name' => 'Email Group View',
                'description' => 'Email Group View'
            ],
            [
                'name' => 'admin_group_email_update',
                'display_name' => 'Email Group Update',
                'description' => 'Email Group Update'
            ],
            [
                'name' => 'admin_group_email_delete',
                'display_name' => 'Email Group Delete',
                'description' => 'Email Group Delete'
            ],
            [
                'name' => 'admin_group_email_create',
                'display_name' => 'Email Group Create',
                'description' => 'Email Group Create'
            ],

            // ADVERTS
            [
                'name' => 'admin_advert_view',
                'display_name' => 'Advert View',
                'description' => 'Advert View'
            ],
            [
                'name' => 'admin_advert_update',
                'display_name' => 'Advert Update',
                'description' => 'Advert Update'
            ],
            [
                'name' => 'admin_advert_delete',
                'display_name' => 'Advert Delete',
                'description' => 'Advert Delete'
            ],
            [
                'name' => 'admin_advert_create',
                'display_name' => 'Advert Create',
                'description' => 'Advert Create'
            ],

            // Client
            [
                'name' => 'admin_client_view',
                'display_name' => 'Client View',
                'description' => 'Client View'
            ],
            [
                'name' => 'admin_client_update',
                'display_name' => 'Client Update',
                'description' => 'Client Update'
            ],
            [
                'name' => 'admin_client_delete',
                'display_name' => 'Client Delete',
                'description' => 'Client Delete'
            ],
            [
                'name' => 'admin_client_create',
                'display_name' => 'Client Create',
                'description' => 'Client Create'
            ],

            // USER
            [
                'name' => 'admin_user_view',
                'display_name' => 'User View',
                'description' => 'User View'
            ],
            [
                'name' => 'admin_user_update',
                'display_name' => 'User Update',
                'description' => 'User Update'
            ],
            [
                'name' => 'admin_user_delete',
                'display_name' => 'User Delete',
                'description' => 'User Delete'
            ],
            [
                'name' => 'admin_user_create',
                'display_name' => 'User Create',
                'description' => 'User Create'
            ],
            [
                'name' => 'admin_user_view_log',
                'display_name' => 'User View Log',
                'description' => 'User View Log'
            ],

            // CUSTOMER
            [
                'name' => 'admin_customer_view',
                'display_name' => 'Customer View',
                'description' => 'Customer View'
            ],
            [
                'name' => 'admin_customer_update',
                'display_name' => 'Customer Update',
                'description' => 'Customer Update'
            ],
            [
                'name' => 'admin_customer_delete',
                'display_name' => 'Customer Delete',
                'description' => 'Customer Delete'
            ],
            [
                'name' => 'admin_customer_create',
                'display_name' => 'Customer Create',
                'description' => 'Customer Create'
            ],

            // BOOKING
            [
                'name' => 'admin_booking_view',
                'display_name' => 'Booking View',
                'description' => 'Booking View'
            ],
            [
                'name' => 'admin_booking_update',
                'display_name' => 'Booking Update',
                'description' => 'Booking Update'
            ],
            [
                'name' => 'admin_booking_delete',
                'display_name' => 'Booking Delete',
                'description' => 'Booking Delete'
            ],
            [
                'name' => 'admin_booking_create',
                'display_name' => 'Booking Create',
                'description' => 'Booking Create'
            ],

            // SCHOOL
            [
                'name' => 'admin_school_view',
                'display_name' => 'School View',
                'description' => 'School View'
            ],
            [
                'name' => 'admin_school_update',
                'display_name' => 'School Update',
                'description' => 'School Update'
            ],
            [
                'name' => 'admin_school_delete',
                'display_name' => 'School Delete',
                'description' => 'School Delete'
            ],
            [
                'name' => 'admin_school_create',
                'display_name' => 'School Create',
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
                'display_name' => 'School Level Create',
                'description' => 'School Level Create'
            ],

            // SCHOOL TYPE
            [
                'name' => 'admin_school_type_view',
                'display_name' => 'School Type View',
                'description' => 'School Type View'
            ],
            [
                'name' => 'admin_school_type_update',
                'display_name' => 'School Type Update',
                'description' => 'School Type Update'
            ],
            [
                'name' => 'admin_school_type_delete',
                'display_name' => 'School Type Delete',
                'description' => 'School Type Delete'
            ],
            [
                'name' => 'admin_school_type_create',
                'display_name' => 'School Type Create',
                'description' => 'School Type Create'
            ],
            // SCHOOL CLASS
            [
                'name' => 'admin_school_class_view',
                'display_name' => 'School Class View',
                'description' => 'School Class View'
            ],
            [
                'name' => 'admin_school_class_update',
                'display_name' => 'School Class Update',
                'description' => 'School Class Update'
            ],
            [
                'name' => 'admin_school_class_delete',
                'display_name' => 'School Class Delete',
                'description' => 'School Class Delete'
            ],
            [
                'name' => 'admin_school_class_create',
                'display_name' => 'School Class Create',
                'description' => 'School Class Create'
            ],
            // SCHOOL LANGUAGE
            [
                'name' => 'admin_school_language_view',
                'display_name' => 'School Language View',
                'description' => 'School Language View'
            ],
            [
                'name' => 'admin_school_language_update',
                'display_name' => 'School Language Update',
                'description' => 'School Language Update'
            ],
            [
                'name' => 'admin_school_language_delete',
                'display_name' => 'School Language Delete',
                'description' => 'School Language Delete'
            ],
            [
                'name' => 'admin_school_language_create',
                'display_name' => 'School Language Create',
                'description' => 'School Language Create'
            ],
            // SCHOOL EVENT
            [
                'name' => 'admin_school_event_view',
                'display_name' => 'School Event View',
                'description' => 'School Event View'
            ],
            [
                'name' => 'admin_school_event_update',
                'display_name' => 'School Event Update',
                'description' => 'School Event Update'
            ],
            [
                'name' => 'admin_school_event_delete',
                'display_name' => 'School Event Delete',
                'description' => 'School Event Delete'
            ],
            [
                'name' => 'admin_school_event_create',
                'display_name' => 'School Event Create',
                'description' => 'School Event Create'
            ],
            // SCHOOL CATEGORY
            [
                'name' => 'admin_school_category_view',
                'display_name' => 'School Category View',
                'description' => 'School Category View'
            ],
            [
                'name' => 'admin_school_category_update',
                'display_name' => 'School Category Update',
                'description' => 'School Category Update'
            ],
            [
                'name' => 'admin_school_category_delete',
                'display_name' => 'School Category Delete',
                'description' => 'School Category Delete'
            ],
            [
                'name' => 'admin_school_category_create',
                'display_name' => 'School Category Create',
                'description' => 'School Category Create'
            ],
            // SEARCH
            [
                'name' => 'admin_search_view',
                'display_name' => 'Search View',
                'description' => 'Search View'
            ],
            [
                'name' => 'admin_search_update',
                'display_name' => 'Search Update',
                'description' => 'Search Update'
            ],
            [
                'name' => 'admin_search_delete',
                'display_name' => 'Search Delete',
                'description' => 'Search Delete'
            ],
            [
                'name' => 'admin_search_create',
                'display_name' => 'Search Create',
                'description' => 'Search Create'
            ],
            // LOCATION
            [
                'name' => 'admin_location_view',
                'display_name' => 'Location View',
                'description' => 'Location View'
            ],
            [
                'name' => 'admin_location_update',
                'display_name' => 'Location Update',
                'description' => 'Location Update'
            ],
            [
                'name' => 'admin_location_delete',
                'display_name' => 'Location Delete',
                'description' => 'Location Delete'
            ],
            [
                'name' => 'admin_location_create',
                'display_name' => 'Location Create',
                'description' => 'Location Create'
            ],
            // ROLE
            [
                'name' => 'admin_role_view',
                'display_name' => 'Role View',
                'description' => 'Role View'
            ],
            [
                'name' => 'admin_role_update',
                'display_name' => 'Role Update',
                'description' => 'Role Update'
            ],
            [
                'name' => 'admin_role_delete',
                'display_name' => 'Role Delete',
                'description' => 'Role Delete'
            ],
            [
                'name' => 'admin_role_create',
                'display_name' => 'Role Create',
                'description' => 'Role Create'
            ],
            // NEWS
            [
                'name' => 'admin_news_view',
                'display_name' => 'News View',
                'description' => 'News View'
            ],
            [
                'name' => 'admin_news_update',
                'display_name' => 'News Update',
                'description' => 'News Update'
            ],
            [
                'name' => 'admin_news_delete',
                'display_name' => 'News Delete',
                'description' => 'News Delete'
            ],
            [
                'name' => 'admin_news_create',
                'display_name' => 'News Create',
                'description' => 'News Create'
            ],
            // LOCALIZATION
            [
                'name' => 'admin_localization_view',
                'display_name' => 'Localization View',
                'description' => 'Localization View'
            ],
            [
                'name' => 'admin_localization_update',
                'display_name' => 'Localization Update',
                'description' => 'Localization Update'
            ],
            [
                'name' => 'admin_localization_delete',
                'display_name' => 'Localization Delete',
                'description' => 'Localization Delete'
            ],
            [
                'name' => 'admin_localization_create',
                'display_name' => 'Localization Create',
                'description' => 'Localization Create'
            ],
            // STATICS
            [
                'name' => 'admin_statics_view',
                'display_name' => 'Statics View',
                'description' => 'Statics View'
            ],
            [
                'name' => 'admin_statics_update',
                'display_name' => 'Statics Update',
                'description' => 'Statics Update'
            ],
            [
                'name' => 'admin_statics_delete',
                'display_name' => 'Statics Delete',
                'description' => 'Statics Delete'
            ],
            [
                'name' => 'admin_statics_create',
                'display_name' => 'Statics Create',
                'description' => 'Statics Create'
            ],
            // MENU
            [
                'name' => 'admin_menu_view',
                'display_name' => 'Menu View',
                'description' => 'Menu View'
            ],
            [
                'name' => 'admin_menu_update',
                'display_name' => 'Menu Update',
                'description' => 'Menu Update'
            ],
            [
                'name' => 'admin_menu_delete',
                'display_name' => 'Menu Delete',
                'description' => 'Menu Delete'
            ],
            [
                'name' => 'admin_menu_create',
                'display_name' => 'Menu Create',
                'description' => 'Menu Create'
            ]
        ];
        DB::table('permissions')->insert($permission);
    }
}
