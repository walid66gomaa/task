@inject('request', 'Illuminate\Http\Request')

<div class="sidebar">
 
    <nav class="sidebar-nav">
        
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link "
                   href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>


            <!--=======================Custom menus===============================-->
           
            @if ($logged_in_user->isAdmin())
   


           

                <li class="nav-item nav-dropdown ">
                    <a class="nav-link nav-dropdown-toggle "
                       href="#">
                        <i class="nav-icon icon-user"></i>  @lang('labels.backend.access.users.management')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link "
                               href="{{ route('admin.auth.user.index') }}">
                                all users
                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link "
                            href="{{ route('admin.auth.user.create') }}">
                            Creat user
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link "
                               href="{{ route('admin.auth.user.deactivated') }}">
                           Deactivated users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link "
                               href="{{ route('admin.auth.user.deleted') }}">
                               Deleted users
                            </a>
                        </li>

                        
                    </ul>
                </li>


                <!--==================================================================-->
                <li class="divider"></li>

                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'subPackages' ? 'active' : '' }}"
                       href="{{ route('admin.subPackages.index') }}">
                        <i class="nav-icon icon-directions"></i>
                        <span class="title">@lang('menus.backend.sidebar.subPackages.title')</span>
                    </a>
                </li>


              


            @endif
          

       

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
