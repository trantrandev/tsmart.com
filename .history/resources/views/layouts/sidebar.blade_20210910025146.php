   <nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="{{ route('dashboard') }}" class="b-brand">
                <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div>
                <span class="b-title">Datta Able</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>HOME</label>
                </li>
                <li class="nav-item {{ Route::is('dashboard')?'active':null }}">
                    <a href="{{ route('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>

                <li class="nav-item pcoded-menu-caption">
                    <label>Pages</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Pages</span></a>
                    <ul class="pcoded-submenu">
                       <li class=""><a href="layout-dark.html" class="" target="_blank">List page</a></li>
                       <li class=""><a href="layout-menu-icon.html" class="" target="_blank">Add page</a></li>
                   </ul>
               </li>
               <li class="nav-item pcoded-hasmenu">
                <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-feather"></i></span><span class="pcoded-mtext">Posts</span></a>
                <ul class="pcoded-submenu">
                    <li class=""><a href="widget-statistic.html" class="">List post</a></li>
                    <li class=""><a href="widget-data.html" class="">Add post</a></li>
                    <li class=""><a href="widget-table.html" class="">Categories post</a></li>
                </ul>
            </li>
            <li class="nav-item pcoded-hasmenu">
                <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Products</span></a>
                <ul class="pcoded-submenu">
                    <li class=""><a href="bc_alert.html" class="">List product</a></li>
                    <li class=""><a href="bc_button.html" class="">Add product</a></li>
                    <li class=""><a href="bc_badges.html" class="">Categories product</a></li>
                </ul>
            </li>
            <li class="nav-item pcoded-menu-caption">
                <label>Order Performance</label>
            </li>
            <li class="nav-item pcoded-hasmenu">
                <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Orders</span></a>
                <ul class="pcoded-submenu">
                    <li class=""><a href="ac_alert.html" class="">List Order</a></li>
                </ul>
            </li>
            <li class="nav-item pcoded-hasmenu">
                <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-trending-up"></i></span><span class="pcoded-mtext">Statistical</span></a>
                <ul class="pcoded-submenu">
                    <li class=""><a href="ec-session-timeout.html" class="">Session timeout</a></li>
                    <li class=""><a href="ec-session-idle-timeout.html" class="">Session idle timeout</a></li>
                    <li class=""><a href="ec-offline.html" class="">Offline</a></li>
                </ul>
            </li>
            <li class="nav-item pcoded-menu-caption">
                <label>Manager HR</label>
            </li>
            <li class="nav-item"><a href="animation.html" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Customers</span></a></li>
            <li class="nav-item pcoded-hasmenu {{ Request::segment(2)=='user'?'pcoded-trigger active':null }}">
                <a href="{{ url('admin/user/list') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user-check"></i></span><span class="pcoded-mtext">Users</span></a>
                <ul class="pcoded-submenu">
                    <li class="{{ Route::is('user.list')?'active':null }}"><a href="{{ url('admin/user/list') }}" class="">List user</a></li>
                    <li class="{{ Route::is('user.add')?'active':null }}"><a href="{{ url('admin/user/add') }}" class="">Add user</a></li>
                </ul>
            </li>
            <li class="nav-item pcoded-hasmenu">
                <a href="#!" class="nav-link"></a><span class="pcoded-micon"><i class="feather icon-award"></i></span><span class="pcoded-mtext">Roles</span>
                <ul class="pcoded-submenu">
                    <li class=""><a href="form-picker.html" class="">List role</a></li>
                    <li class=""><a href="form-select.html" class="">Add role</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Setting</span></a>
            </li>
        </ul>
    </div>{{-- End navbar-conent --}}
</div>{{-- End navbar wrapper --}}
</nav>

<script>
    $(function() {
        function initMenuItemScroll() {
           if ($(".navbar-wrapper").length > 0 && $(".navbar-wrapper li.active").length > 0) {
             var activeMenu = $(".navbar-wrapper li.active").offset().top;
             if (activeMenu > 300) {
                activeMenu = activeMenu - 300;
                $(".navbar-content").animate({
                    scrollTop: activeMenu
                }, "slow");
            }
        }
    }
    initMenuItemScroll();
});
</script>
