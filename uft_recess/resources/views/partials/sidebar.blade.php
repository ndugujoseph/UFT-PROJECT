@inject('request', 'Illuminate\Http\Request')
<head>
<style type="text/css">
    
    .sidebar{
        background-size: 100%;
        background-image:url("/images/bg.png");
        text-decoration:bold;

    }

    .main-sidebar{
        background-size: 100%;
        background-image:url("/images/bg.png");
        
    }
    
    
</style>
</head>
<body>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.manage-users.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('quickadmin.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('payment_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-plug"></i>
                    <span>@lang('quickadmin.payments.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('well_wishers_access')
                    <li>
                        <a href="{{ route('admin.well_wishers.index') }}">
                            <i class="fa fa-user-plus"></i>
                            <span>@lang('quickadmin.well-wishers.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('agent_head_payment_access')
                    <li>
                        <a href="{{ route('admin.agent_head_payment.index') }}">
                            <i class="fa fa-adn"></i>
                            <span>Agent Head Payment</span>
                        </a>
                    </li>@endcan
                    
                    @can('agent_payments_access')
                    <li>
                        <a href="{{ route('admin.agent_payments.index') }}">
                            <i class="fa fa-adn"></i>
                            <span>Agent Payment</span>
                        </a>
                    </li>@endcan
                    
                    @can('admin_payment_access')
                    <li>
                        <a href="{{ route('admin.admin_payments.index') }}">
                            <i class="fa fa-adn"></i>
                            <span>@lang('quickadmin.admin-payment.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('agents_access')
            <li>
                <a href="{{ route('admin.agents.index') }}">
                    <i class="fa fa-amazon"></i>
                    <span>@lang('quickadmin.agents.title')</span>
                </a>
            </li>@endcan
            
            @can('districts_access')
            <li>
                <a href="{{ route('admin.districts.index') }}">
                    <i class="fa fa-institution"></i>
                    <span>@lang('quickadmin.districts.title')</span>
                </a>
            </li>@endcan
            
            @can('members_access')
            <li>
                <a href="{{ route('admin.members.index') }}">
                    <i class="fa fa-address-card-o"></i>
                    <span>@lang('quickadmin.members.title')</span>
                </a>
            </li>@endcan
            
            @can('tresuary_access')
            <li>
                 <a href="{{ route('admin.tresuaries.index') }}">
                    <i class="fa fa-rmb"></i>
                    <span>@lang('quickadmin.tresuary.title')</span>
                </a>
            </li>@endcan
        
            

            <li class="{{ $request->segment(1) == 'chart' ? 'active' : '' }}">
                <a href="{{ url('/chart/bar') }}">
                    <i class="fa fa-area-chart"></i>
                    <span class="title">@lang('quickadmin.uft-charts.title')</span>
                </a>
            </li>
            
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
</body>

