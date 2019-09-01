<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ url('/home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Country<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('countries/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('countries') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> State<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('states/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('states') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> City<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('cities/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('cities') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Address<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('addresses/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('addresses') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Roles<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('roles/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('roles') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('users/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('users') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Payment Types<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('payment-types/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('payment-types') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Modules<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('modules/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('modules') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Worker Service Costs<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('worker-service-costs/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('worker-service-costs') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('categories/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('categories') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Sub Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('sub-categories/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('sub-categories') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Sub Sub Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('sub-sub-categories/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('sub-sub-categories') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Stores<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('stores/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('stores') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Products<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('products/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('products') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Service Types<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('service-types/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('service-types') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Reviews<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('reviews/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('reviews') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Offers<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('offers/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('offers') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="{{ url('/orders') }}"><i class="fa fa-dashboard fa-fw"></i> Orders</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Days<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('days/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('days') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Schedule Types<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('schedule-types/create') }}">Create</a>
                    </li>
                    <li>
                        <a href="{{ url('schedule-types') }}">Manage</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="{{ url('/booked-schedules') }}"><i class="fa fa-dashboard fa-fw"></i> Booked Schedule</a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>