<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu" style="background: #191A35;">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu text-white" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ Route('home') }}" class="text-white">
                        <i class="dripicons-meter"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('user.index') }}" class="text-white">
                        <i class="dripicons-user"></i>
                        <span> Users </span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('tags.index') }}" class="text-white">
                        <i class="dripicons-document"></i>
                        <span> Tags </span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('books.index') }}" class="text-white">
                        <i class="dripicons-document-new"></i>
                        <span> Books </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ Route('sermon.index') }}" class="text-white">
                        <i class="dripicons-headset"></i>
                        <span> Sermon </span>
                    </a>
                </li> --}}
                 <li>
                    <a href="{{ Route('songs.index') }}" class="text-white">
                        <i class="dripicons-headset"></i>
                        <span> Sermon </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('videos.index')}}" class="text-white">
                        <i class="dripicons-camcorder"></i>
                        <span> Videos </span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('admins.index') }}" class="text-white">
                        <i class="dripicons-user"></i>
                        <span> Manage Admin </span>
                    </a>
                </li>

            </ul>
            <ul class="metismenu text-white" id="side-menu">
                <li class="menu-title">User Analytics</li>
                <li>
                    <a href="{{ Route('recently-joined.index') }}" class="text-white">
                        <i class="dripicons-user"></i>
                        <span> Recently Join Users </span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('push-notifications.index') }}" class="text-white">
                        <i class="dripicons-user"></i>
                        <span> Push Notifications </span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('privacypolicy.index') }}" class="text-white">
                        <i class="dripicons-user"></i>
                        <span> Privacy Policy </span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('termscondition.index') }}" class="text-white">
                        <i class="dripicons-user"></i>
                        <span> Terms and Condition </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
