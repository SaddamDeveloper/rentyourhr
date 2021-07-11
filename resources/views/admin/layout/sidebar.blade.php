<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset('backend/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
{{--     <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                        class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form> --}}
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-lock"></i> <span>Access</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('admin.users') }}"><i class="fa fa-circle-o"></i> Users</a>
                </li>
                <li>
                    <a href="{{ route('admin.roles') }}"><i class="fa fa-circle-o"></i> Roles</a>
                </li>
                <li>
                    <a href="{{ route('permissions') }}"><i class="fa fa-circle-o"></i> Permissions</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-lock"></i> <span>Candidates</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('admin.candidates') }}"><i class="fa fa-circle-o"></i> Candidates</a>
                </li>
                <li>
                    <a href="{{ route('admin.candidate.create') }}"><i class="fa fa-circle-o"></i> Candidate Create</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-lock"></i> <span>Location</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('admin.states') }}"><i class="fa fa-circle-o"></i> State</a>
                </li>
                <li>
                    <a href="{{ route('admin.cities') }}"><i class="fa fa-circle-o"></i> City</a>
                </li>
            </ul>
        </li>
        <li><a href="{{ route('admin.jobs') }}"><i class="fa fa-circle-o"></i> <span>Job Profile</span></a></li>
        <li><a href="{{ route('admin.packages') }}"><i class="fa fa-circle-o"></i> <span>Packages</span></a></li>
        <li><a href="{{ route('admin.orders') }}"><i class="fa fa-circle-o"></i> <span>Order</span></a></li>
    </ul>
</section>
