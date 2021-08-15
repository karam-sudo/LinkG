<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    @can('ContactUs')
                    <li>
                            <a href="{{ url('/dashboard') }}">
                                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                    </li>
                    @endcan
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>

                    <!-- Service-->
                    @can('services')
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Services-menu">
                            <div class="pull-left"><i class="fa fa-cogs"></i><span
                                    class="right-nav-text">{{trans('main_trans.Services')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Services-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('Services.index')}}"><i class="fa fa-bars"></i><span
                                class="right-nav-text">{{trans('main_trans.Services_list')}}</span></a></li>

                        </ul>
                    </li>
                    @endcan
                    <!-- Projects-->
                    @can('Project')
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Projects-menu">
                            <div class="pull-left"><i class="fa fa-cubes"></i><span
                                    class="right-nav-text">{{trans('main_trans.Projects')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Projects-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('Projects.index')}}"><i class="fa fa-bars"></i><span
                                class="right-nav-text">{{trans('main_trans.List_Projects')}}</span></a></li>
                        </ul>
                    </li>
                    @endcan
                       <!-- Positions-->
                       @can('Positions')
                       <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Positions-menu">
                            <div class="pull-left"><i class="fa fa-street-view"></i><span
                                    class="right-nav-text">{{trans('main_trans.Positions')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Positions-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('Positions.index')}}"><i class="fa fa-bars"></i><span
                                class="right-nav-text">{{trans('main_trans.List_position')}}</span></a></li>
                        </ul>
                    </li>
                    @endcan



                    <!-- team member-->
              <!--   <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#members-menu">
                        <div class="pull-left"><i class="fa fa-users"></i></i></i><span
                                class="right-nav-text">{{-- trans('main_trans.TeamMembers') --}}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="members-menu" class="collapse" data-parent="#sidebarnav">
                        <li> <a href="{{-- route('TeamMembers.create') --}}"><i class="fa fa-user-plus"></i><span
                            class="right-nav-text">{{-- trans('main_trans.add_member') --}}</a> </li>
                        <li> <a href="{{-- route('TeamMembers.index') --}}"><i class="fa fa-bars"></i><span
                            class="right-nav-text">{{-- trans('main_trans.list_members') --}}</a> </li>

                    </ul>
                </li>-->
                    <!-- Settings-->
                    @can('Employees')
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Employee-icon">
                            <div class="pull-left"><i class="fa fa-users"></i><span class="right-nav-text">{{trans('main_trans.Employees')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Employee-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('Employees.index') }}"><i class="fa fa-bars"></i><span
                                class="right-nav-text">{{ trans('main_trans.Employees_List') }}</a> </li>
                        </ul>
                    </li>
                    @endcan
                    @can('Gallery')
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Gallery-icon">
                            <div class="pull-left"><i class="fa fa-picture-o"></i><span class="right-nav-text">{{ trans('gallery_trans.title_page') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Gallery-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('Gallery.index') }}"><i class="fa fa-bars"></i><span
                                class="right-nav-text">{{ trans('gallery_trans.Add_to_Gallery') }}</a> </li>
                        </ul>

                    </li>
                    @endcan
                    <!-- Users-->

                    @can('Users')
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                            <div class="pull-left"><i class="fa fa-handshake-o"></i><span class="right-nav-text">{{trans('main_trans.Users')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ url('/' . $page='users') }}"><i class="fa fa-bars"></i><span
                                class="right-nav-text">{{ trans('Users_trans.user_list') }}</a> </li>
                            <li> <a href="{{ url('/' . $page='roles') }}"><i class="fa fa-lock"></i><span
                                class="right-nav-text">{{ trans('Users_trans.users_permission') }}</a> </li>

                        </ul>
                    </li>
                    @endcan

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
