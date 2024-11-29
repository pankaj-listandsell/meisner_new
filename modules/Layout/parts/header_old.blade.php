<div class="bravo_header">
    <div class="{{$container_class ?? 'container'}}">
        <div class="content b-header-content">
            <div class="logo-wrapper">
                <a href="{{ getHomePageUrl() }}" class="bravo-logo">
                    @php
                        $logo_id = setting_item("logo_id");
                        if(!empty($row->custom_logo)){
                            $logo_id = $row->custom_logo;
                        }
                    @endphp
                    @if($logo_id)
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img height="200" width="78.8" src="{{$logo}}" alt="{{setting_item("site_title")}}">
                    @endif
                </a>
            </div>
            <div class="menu-wrapper">
                <div class="header-left">
                    <div class="bravo-menu">
                        {!! generate_primary_menu() !!}
                    </div>
                    
                    <ul class="multi-lang">
                        @include('Language::frontend.switcher')
                    </ul>
                    <span class="mo-whats"><a target="_blank" href="https://wa.me/4917623878600"><img width="26" height="26" src="https://aflex.de/uploads/0000/1/2024/02/26/aflex-whatsapp.png"></a></span>
                </div>
                <div class="header-right">
                    @if(!empty($header_right_menu))
                        <ul class="topbar-items">
                            @include('Core::frontend.currency-switcher')
                            @include('Language::frontend.switcher')
                            @if(!Auth::check())
                                <li class="login-item">
                                    <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                                </li>
                                @if(is_enable_registration())
                                    <li class="signup-item">
                                        <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                                    </li>
                                @endif
                            @else
                                <li class="login-item dropdown">
                                    <a href="#" data-toggle="dropdown" class="is_login">
                                        @if($avatar_url = Auth::user()->getAvatarUrl())
                                            <img class="avatar" src="{{$avatar_url}}" alt="{{ Auth::user()->getDisplayName()}}">
                                        @else
                                            <span class="avatar-text">{{ucfirst( Auth::user()->getDisplayName()[0])}}</span>
                                        @endif
                                        {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                                        <i class="icon-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu text-left">
                                        <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class="icon-clock"></i> {{__("Booking History")}}</a></li>
                                        <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class="icon-lock"></i> {{__("Change password")}}</a></li>
                                        @if(Auth::user()->hasPermissionTo('dashboard_access'))
                                            <li class="menu-hr"><a href="{{route('admin.index')}}"><i class="icon-home"></i> {{__("Admin Dashboard")}}</a></li>
                                        @endif
                                        <li class="menu-hr">
                                            <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                        </li>
                                    </ul>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    @endif
                    <button class="bravo-more-menu" title="show menu button">
                        <i class="icon-menu"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <div class="bravo-menu-mobile" style="display:none;">
        <div class="user-profile">
            <div class="b-close"><i class="icon-left"></i></div>
            <div class="avatar"></div>
            <ul>
                @if(!Auth::check())
                    <li>
                        <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                    </li>
                    @if(is_enable_registration())
                        <li>
                            <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                        </li>
                    @endif
                @else
                    <li>
                        <a href="{{route('user.profile.index')}}">
                            <i class="icofont-user-suited"></i> {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                        </a>
                    </li>
                    @if(Auth::user()->hasPermissionTo('dashboard_access'))
                        <li>
                            <a href="{{route('admin.index')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{route('user.profile.index')}}">
                            <i class="icon ion-md-construct"></i> {{__("My profile")}}
                        </a>
                    </li>
                    <li>
                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            <i class="fa fa-sign-out"></i> {{__('Logout')}}
                        </a>
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                @endif
            </ul>
            <ul class="multi-lang">
                @include('Language::frontend.switcher')
            </ul>
        </div>
        <div class="g-menu">
            {!! generate_primary_menu() !!}
        </div>
    </div>
</div>
