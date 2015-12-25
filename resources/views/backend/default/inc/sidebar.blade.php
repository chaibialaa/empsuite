<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->imagepath }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->nom }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li><a href="/admin/"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li><a href="#"><i class="fa fa-users"></i><span>Users</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-gear"></i><span>Roles</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>Link in level 2</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Link in level 2</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-inbox"></i><span>Messages</span></a></li>
            <li><a href="#"><i class="fa fa-exclamation "></i><span>Notices</span></a>
                <ul class="treeview-menu">
                    <li><a href="/admin/notice"><i class="fa fa-circle-o"></i>Manage Notices</a></li>
                    <li><a href="/admin/notice/category"><i class="fa fa-circle-o"></i>Manage Categories</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-bookmark"></i><span>Levels</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/admin/level"><i class="fa fa-circle-o"></i>Manage Levels</a></li>
                    <li><a href="/admin/level/section"><i class="fa fa-circle-o"></i>Manage Sections</a></li>
                    <li><a href="/admin/level/class"><i class="fa fa-circle-o"></i>Manage Classes</a></li>
                </ul>
            </li>
            <li><a href="/admin/subject"><i class="fa fa-book"></i><span>Subjects</span></a></li>
            <li><a href="/admin/timetable"><i class="fa fa-calendar"></i><span>Timetables</span></a></li>
            <li><a href="#"><i class="fa fa-suitcase"></i><span>Resources</span></a></li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>