<!-- Navigation--><!--.fixed-top-->
<nav class="navbar navbar-expand-lg navbar-dark" id="mainNav"
     uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
    <div class="container">
        <div class="branding">
            <a class="navbar-brand js-scroll-trigger" href="{{ route('frontend.index') }}">
                <img src="{{ asset('assets/img/navbar-logo.svg') }}" alt=""/>
            </a>
        </div>

        <div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
            <div class="uk-offcanvas-bar">

                <div class="page-mobile-menu-header">
                    <div class="page-mobile-popup-logo page-mobile-menu-logo">
                        <a href="#" role="home">
                            <img width="158" src="{{ asset('assets/img/navbar-logo.svg') }}" alt=""/>
                        </a>
                    </div>
                    <button class="uk-offcanvas-close" type="button" uk-close=""></button>
                </div>

                <div class="uk-panel">
                    <ul class="uk-nav uk-nav-default">
                        <li class="uk-nav-header"><a href="{{ route('frontend.index') }}">
                                @lang('navs.general.home')</a>
                        </li>
                        <li><a href="{{ route('frontend.index') }}">@lang('navs.general.home')</a></li>
                        <li><a href="{{ route('frontend.auth.subscripe') }}">@lang('custom-menu.nav-menu.subscripe')</a></li>
                   
                        
                    </ul>
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
            
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('frontend.index') }}">
                        @lang('navs.general.home')
                    </a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('frontend.auth.subscripe') }}">
                        {{trans('custom-menu.nav-menu.subscripe')}}
                    </a>
                </li>
              

                
              

            </ul>
        </div>
        <div class="header-right">
            <div class="header-right-inner" id="header-right-inner">

                @auth
                    <div class="dropdown">
                        <a class="nav-item header-icon header-login-link dropdown-toggle "
                           id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                           href="#">
                            <span class="nav-link">{{ $logged_in_user->name }}</span>
                            <i class="far fa-user-circle"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuUser">
                            <a class="dropdown-item text-center text-muted" href="#!">
                                {{ $logged_in_user->roles[0]->name??  $logged_in_user->user['email']}}</a>
                            <div class="dropdown-divider"></div>

                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                <i class="fas fa-tachometer-alt  fa-sm fa-fw text-gray-400"></i>
                                <span class="text-right p-0"> @lang('navs.frontend.dashboard') </span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw bg-green"></i>
                                <span class="text-right p-0"> @lang('navs.general.logout') </span>
                            </a>

                        </div>
                    </div>

                @else
                    <a class="header-icon header-login-link "
                       href="#" id="openLoginModal" data-target="#myModal">
                        <span class="nav-link"> @lang('navs.frontend.login') </span>
                        <i class="far fa-user-circle"></i>
                    </a>
                @endauth

              
            </div>



            @auth
                <div class="dropdown d-md-none">
                    <a class="nav-item header-icon header-login-link dropdown-toggle "
                       id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       href="#">
                        <i class="far fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu pull-left" aria-labelledby="dropdownMenuUser">
                        <a class="dropdown-item text-center text-muted" href="#!">
                            {{ $logged_in_user->roles[0]->name??  $logged_in_user->user['email']}}</a>
                        <div class="dropdown-divider"></div>

                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                            <i class="fas fa-tachometer-alt  fa-sm fa-fw text-gray-400"></i>
                            <span class="text-right p-0"> @lang('navs.frontend.dashboard') </span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw bg-green"></i>
                            <span class="text-right p-0"> @lang('navs.general.logout') </span>
                        </a>

                    </div>
                </div>

            @else
                <a class="d-md-none header-icon header-login-link "
                   href="#" id="openLoginModal" data-target="#myModal">
                    <span class="nav-link"> @lang('navs.frontend.login') </span>
                    <i class="far fa-user-circle"></i>
                </a>
            @endauth


            <button class="navbar-toggler uk-button uk-margin-small-right" type="button"
                    uk-toggle="target: #offcanvas-push">
                <i class="fas fa-bars ml-1 mr-1"></i>
            </button>

        </div>
    </div>
</nav>