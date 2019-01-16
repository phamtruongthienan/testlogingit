<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            @if(Auth::user()->can('admin_website_view'))
                <li class="header">QUẢN LÝ CHÍNH</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-cog"></i> <span>Website</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admin.setting')}}"><i class="fas fa-angle-right"></i> Cấu hình website</a></li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->can('admin_email_view'))
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-envelope"></i> <span>Email</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admin.email')}}"><i class="fas fa-angle-right"></i> Quản lý email</a></li>
                        <li><a href="{{route('admin.group.email')}}"><i class="fas fa-angle-right"></i> Quản lý nhóm người nhận</a></li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->can('admin_advert_view'))
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-share-alt"></i> <span>Quảng cáo</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admin.advertise')}}"><i class="fas fa-angle-right"></i> Quản lý popup</a></li>
                        <li><a href="{{route('admin.client')}}"><i class="fas fa-angle-right"></i> Quản lý đối tác liên kết</a></li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->can('admin_user_view'))
                <li class="header">QUẢN LÝ TÀI KHOẢN</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-user-graduate"></i> <span>Nhân viên</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('admin.employee')}}"><i class="fas fa-angle-right"></i> Quản lý nhân viên</a></li>
                    </ul>
                </li>
            @endif   

            <li class="treeview">
                <a href="#">
                    <i class="fas fa-child"></i>
                    <span>Khách hàng</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                @if(Auth::user()->can('admin_customer_view'))
                    <li><a href="{{route('admin.customer')}}"><i class="fas fa-angle-right"></i> Quản lý khách hàng</a></li>
                @endif
                @if(Auth::user()->can('admin_booking_view'))
                    <li><a href="{{route('admin.visiter')}}"><i class="fas fa-angle-right"></i> Quản lý khách tham quan</a></li>
                @endif
                </ul>
            </li>
            @if(Auth::user()->can('admin_school_*'))
                <li class="header">QUẢN LÝ TRƯỜNG HỌC</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-school"></i>
                        <span>Trường học</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Auth::user()->can('admin_school_view'))
                            <li><a href="{{route('admin.school')}}"><i class="fas fa-angle-right"></i> Quản lý trường học</a></li>
                        @endif

                        @if(Auth::user()->can('admin_school_level_view'))
                            <li><a href="{{route('admin.level_school')}}"><i class="fas fa-angle-right"></i> Quản lý cấp trường</a></li>
                        @endif

                        @if(Auth::user()->can('admin_school_type_view'))
                            <li><a href="{{route('admin.type_school')}}"><i class="fas fa-angle-right"></i> Quản lý loại trường</a></li>
                        @endif

                        @if(Auth::user()->can('admin_school_class_view'))
                            <li><a href="{{route('admin.room')}}"><i class="fas fa-angle-right"></i> Quản lý phòng học</a></li>
                        @endif

                        @if(Auth::user()->can('admin_school_language_view'))
                            <li><a href="{{route('admin.language')}}"><i class="fas fa-angle-right"></i> Quản lý ngoại ngữ</a></li>
                        @endif

                        @if(Auth::user()->can('admin_school_event_view'))
                            <li><a href="{{route('admin.event')}}"><i class="fas fa-angle-right"></i> Quản lý sự kiện</a></li>
                        @endif

                        @if(Auth::user()->can('admin_school_category_view'))
                            <li><a href="{{route('admin.attribute')}}"><i class="fas fa-angle-right"></i> Quản lý thuộc tính</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            <li class="header">CẤU HÌNH KHÁC</li>
            @if(Auth::user()->can('admin_search_view'))
                <li><a href="{{route('admin.search')}}"><i class="fas fa-search"></i> <span>Quản lý tìm kiếm</span></a></li>
            @endif
            
            @if(Auth::user()->can('admin_location_view'))
                <li><a href="{{route('admin.place')}}"><i class="fas fa-map-marker-alt"></i> <span>Quản lý địa điểm</span></a></li>
            @endif

            @if(Auth::user()->can('admin_role_view'))
                <li><a href="{{route('admin.role')}}"><i class="fas fa-user-circle"></i> <span>Quản lý phân quyền</span></a></li>
            @endif

            @if(Auth::user()->can('admin_news_view'))
                <li><a href="{{route('admin.news')}}"><i class="fa fa-newspaper"></i> <span>Quản lý bài viết</span></a></li>
            @endif

            @if(Auth::user()->can('admin_localization_view'))
                <li><a href="{{asset('admin_esearch/localization')}}"><i class="fas fa-language"></i> <span>Quản lý từ vựng</span></a></li>
            @endif

            <li class="header">THỐNG KÊ</li>

            @if(Auth::user()->can('admin_statics_view'))
                <li><a href="{{route('admin.chart')}}"><i class="fas fa-chart-bar"></i> <span>Thống kê chung</span></a></li>
            @endif

            @if(Auth::user()->can('admin_menu_view'))
                <li class="header">GIAO DIỆN</li>
                <li><a href="{{route('admin.menu')}}"><i class="fas fa-ellipsis-v"></i> <span>Quản lý menu</span></a></li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>