<div class="sidebar" style="background-color: #452C88;">
    <div class="navbar-brand brand-logo d-none mx-5 px-2 mb-2" id="logo-full-img">
        <img src="/assets/images/traveldementor.jpeg" height="30px" width="140px" alt="logo">
    </div>
    <div class="navbar-brand brand-logo mb-2 mx-2" id="logo-img">
        <img src="/assets/images/scooble.svg" style="width: 100%; " alt="logo">
    </div>
    <div class="logo_details py-2" style="border-top: 1px solid #FFFFFF45; border-bottom: 1px solid #FFFFFF45;">
        <div class="pl-3 pr-2" id="profile_img">
            <img style="border-radius: 12px !important; object-fit: cover; width: 45px; height: 45px; background-color:#FFFFFF"
                src="{{ (isset($user->user_pic)) ? asset('storage/' . $user->user_pic) : '/assets/images/user.png'}}"
                alt="profile">
        </div>
        <div class="logo_name d-none" id="logo-name">
            <div class="nav-profile-text d-flex flex-column text-wrap">
                <span class="mb-1" style="font-size: small;">{{(isset($user->name)) ? $user->name : 'Guest'}}</span>
                <span class="text-secondary text-white text-small">
                    {{ $user->role ?? 'Guest'}}
                </span>
            </div>
        </div>
    </div>
    <ul class="nav-list pl-0 sidebar_list">
        @if(view_permission('index'))
        <li>
            <a href="{{ route('dashboard') }}" class="{{(request()->routeIs('dashboard')) ? 'menu-acitve' : ''}}">
                <i class="mt-3 ml-3">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.317 0H12.3519C11.115 0 10.1237 1.035 10.1237 2.3049V5.373C10.1237 6.65099 11.115 7.67699 12.3519 7.67699H15.317C16.5452 7.67699 17.5452 6.65099 17.5452 5.373V2.3049C17.5452 1.035 16.5452 0 15.317 0ZM2.22823 1.7589e-05H5.19336C6.43029 1.7589e-05 7.42159 1.03502 7.42159 2.30492V5.37301C7.42159 6.65101 6.43029 7.67701 5.19336 7.67701H2.22823C1.00007 7.67701 0 6.65101 0 5.37301V2.30492C0 1.03502 1.00007 1.7589e-05 2.22823 1.7589e-05ZM2.22823 10.3229H5.19336C6.43029 10.3229 7.42159 11.3498 7.42159 12.6278V15.6959C7.42159 16.9649 6.43029 17.9999 5.19336 17.9999H2.22823C1.00007 17.9999 0 16.9649 0 15.6959V12.6278C0 11.3498 1.00007 10.3229 2.22823 10.3229ZM12.3519 10.3229H15.317C16.5452 10.3229 17.5452 11.3498 17.5452 12.6278V15.6959C17.5452 16.9649 16.5452 17.9999 15.317 17.9999H12.3519C11.115 17.9999 10.1237 16.9649 10.1237 15.6959V12.6278C10.1237 11.3498 11.115 10.3229 12.3519 10.3229Z"
                            fill="white" />
                    </svg>
                </i>
                <span class="link_name">@lang('lang.dashboard')</span>
            </a>
        </li>
        @endif
        @if(view_permission('users'))
        <li>
            <a href="{{ route('users') }}" class="{{(request()->routeIs('users')) ? 'menu-acitve' : ''}}">

                <i class="ml-3 fa-solid fa-users"></i>

                <span class="link_name">@lang('lang.users')</span>
            </a>
        </li>
        @endif
        @if(view_permission('vfs'))
        <li>
            <a href="{{ route('vfs.embassy') }}" class="{{(request()->routeIs('vfs.embassy')) ? 'menu-acitve' : ''}}">
                <i class="ml-3 fa-solid fa-passport"></i>
                <span class="link_name">VFS</span>
            </a>
        </li>
        @endif
        @if(view_permission('categories'))
        <li>
            <a href="{{ route('categories') }}" class="{{(request()->routeIs('categories')) ? 'menu-acitve' : ''}}">
                <i class="ml-3 fa-solid fa-layer-group"></i>
                <span class="link_name">Categories</span>
            </a>
        </li>
        @endif
        @if(view_permission('countries'))
        <li>
            <a href="{{ route('countries') }}" class="{{(request()->routeIs('countries')) ? 'menu-acitve' : ''}}">
                <i class="ml-3 fa-solid fa-globe"></i>
                <span class="link_name">Countries</span>
            </a>
        </li>
        @endif

        @if(view_permission('staff'))
        <li>
            <a href="{{ route('staff') }}" class="{{(request()->routeIs('staff')) ? 'menu-acitve' : ''}}">
                <i class=" ml-3 fa-solid fa-users"></i>
                <span class="link_name">Staff</span>
            </a>
        </li>
        @endif

        @if(view_permission('currencies'))
        <li>
            <a href="{{ route('currencies') }}" class="{{(request()->routeIs('currencies')) ? 'menu-acitve' : ''}}">
            <i class="ml-3 fa-solid fa-dollar-sign"></i>
                <span class="link_name">@lang('Currencies')</span>
            </a>
        </li>
        @endif
        @if(view_permission('application'))
        <li>
            <a href="{{ route('application.index') }}" class="{{(request()->routeIs('application.index')) ? 'menu-acitve' : ''}}">
                <i class="ml-3 fa-solid fa-envelope"></i>
                <span class="link_name">Application</span>
            </a>
        </li>
        @endif
        
        @if(view_permission('schedule_appointment'))
        <li>
            <a href="{{ route('schedule.appointment.index') }}" class="{{(request()->routeIs('schedule.appointment.index')) ? 'menu-acitve' : ''}}">
                <i class=" ml-3 fas fa-money-bill"></i>
                <span class="link_name">Schedule Appointment</span>
            </a>
        </li>
        @endif
        
        @if(view_permission('pending_appointment'))
        <li>
            <a href="{{ route('pending.appointment.index') }}" class="{{(request()->routeIs('pending.appointment.index')) ? 'menu-acitve' : ''}}">
            <i class="ml-3 fa-solid fa-calendar-check"></i>
                <span class="link_name">Pending Appointment</span>
            </a>
        </li>
        @endif
        
        @if(view_permission('insurance'))
        <li>
            <a href="{{ route('insurance.index') }}"
                class="{{(request()->routeIs('insurance.index')) ? 'menu-acitve' : ''}} scroll-item">
                <i class="ml-3 fa-solid fa-house-chimney-crack"></i>
                <span class="link_name">Insurance</span>
            </a>
        </li>
        @endif
        @if(view_permission('hotel_booking'))
        <li>
            <a href="{{ route('hotel.index') }}"
                class="{{(request()->routeIs('hotel.index')) ? 'menu-acitve' : ''}} scroll-item">
                <i class="ml-3 fa-solid fa-hotel"></i>
                <span class="link_name">Hotel Booking</span>
            </a>
        </li>
        @endif
        @if(view_permission('ds_160'))
        <li>
            <a href="{{ route('ds.index') }}"
                class="{{(request()->routeIs('ds.index')) ? 'menu-acitve' : ''}} scroll-item">
                <i class="ml-3 fa-solid fa-passport"></i>
                <span class="link_name">DS160</span>
            </a>
        </li>
        @endif

        @if(view_permission('locations'))
        <li>
            <a href="{{ route('locations') }}" class="{{(request()->routeIs('locations')) ? 'menu-acitve' : ''}}">
                <i class=" ml-3 fas fa-map-marker-alt"></i>
                <span class="link_name">@lang('Locations')</span>
            </a>
        </li>
        @endif
        @if(view_permission('blank-temp'))
        <li>
            <a href="{{ route('blank.temp') }}" class="{{(request()->routeIs('blank.temp')) ? 'menu-acitve' : ''}}">
                <i class=" ml-3 fas fa-money-bill"></i>
                <span class="link_name">Blank Temp</span>
            </a>
        </li>
        @endif


        @if(view_permission('settings'))
        <li>
            <a href="{{ route('settings') }}"
                class="{{(request()->routeIs('settings')) ? 'menu-acitve' : ''}} scroll-item">
                <i class="mt-3 ml-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M20.4023 13.5801C20.76 13.7701 21.036 14.0701 21.2301 14.3701C21.6083 14.9901 21.5776 15.7501 21.2097 16.4201L20.4943 17.6201C20.1162 18.2601 19.411 18.6601 18.6855 18.6601C18.3278 18.6601 17.9292 18.5601 17.6022 18.3601C17.3365 18.1901 17.0299 18.1301 16.7029 18.1301C15.6911 18.1301 14.8429 18.9601 14.8122 19.9501C14.8122 21.1001 13.872 22.0001 12.6968 22.0001H11.3069C10.1215 22.0001 9.18125 21.1001 9.18125 19.9501C9.16081 18.9601 8.31259 18.1301 7.30085 18.1301C6.96361 18.1301 6.65702 18.1901 6.40153 18.3601C6.0745 18.5601 5.66572 18.6601 5.31825 18.6601C4.58245 18.6601 3.87729 18.2601 3.49917 17.6201L2.79402 16.4201C2.4159 15.7701 2.39546 14.9901 2.77358 14.3701C2.93709 14.0701 3.24368 13.7701 3.59115 13.5801C3.87729 13.4401 4.06125 13.2101 4.23498 12.9401C4.74596 12.0801 4.43937 10.9501 3.57071 10.4401C2.55897 9.87012 2.23194 8.60012 2.81446 7.61012L3.49917 6.43012C4.09191 5.44012 5.35913 5.09012 6.38109 5.67012C7.27019 6.15012 8.425 5.83012 8.9462 4.98012C9.10972 4.70012 9.20169 4.40012 9.18125 4.10012C9.16081 3.71012 9.27323 3.34012 9.4674 3.04012C9.84553 2.42012 10.5302 2.02012 11.2763 2.00012H12.7172C13.4735 2.00012 14.1582 2.42012 14.5363 3.04012C14.7203 3.34012 14.8429 3.71012 14.8122 4.10012C14.7918 4.40012 14.8838 4.70012 15.0473 4.98012C15.5685 5.83012 16.7233 6.15012 17.6226 5.67012C18.6344 5.09012 19.9118 5.44012 20.4943 6.43012L21.179 7.61012C21.7718 8.60012 21.4447 9.87012 20.4228 10.4401C19.5541 10.9501 19.2475 12.0801 19.7687 12.9401C19.9322 13.2101 20.1162 13.4401 20.4023 13.5801ZM9.10972 12.0101C9.10972 13.5801 10.4076 14.8301 12.0121 14.8301C13.6165 14.8301 14.8838 13.5801 14.8838 12.0101C14.8838 10.4401 13.6165 9.18012 12.0121 9.18012C10.4076 9.18012 9.10972 10.4401 9.10972 12.0101Z"
                            fill="white" />
                    </svg>
                </i>
                <span class="link_name">@lang('lang.settings')</span>
            </a>
        </li>
        @endif
        @if(view_permission('Insurance'))
        <li>
            <a href="{{ route('insurance.index') }}"
                class="{{(request()->routeIs('insurance.index')) ? 'menu-acitve' : ''}} scroll-item">
                <i class="mt-3 ml-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M20.4023 13.5801C20.76 13.7701 21.036 14.0701 21.2301 14.3701C21.6083 14.9901 21.5776 15.7501 21.2097 16.4201L20.4943 17.6201C20.1162 18.2601 19.411 18.6601 18.6855 18.6601C18.3278 18.6601 17.9292 18.5601 17.6022 18.3601C17.3365 18.1901 17.0299 18.1301 16.7029 18.1301C15.6911 18.1301 14.8429 18.9601 14.8122 19.9501C14.8122 21.1001 13.872 22.0001 12.6968 22.0001H11.3069C10.1215 22.0001 9.18125 21.1001 9.18125 19.9501C9.16081 18.9601 8.31259 18.1301 7.30085 18.1301C6.96361 18.1301 6.65702 18.1901 6.40153 18.3601C6.0745 18.5601 5.66572 18.6601 5.31825 18.6601C4.58245 18.6601 3.87729 18.2601 3.49917 17.6201L2.79402 16.4201C2.4159 15.7701 2.39546 14.9901 2.77358 14.3701C2.93709 14.0701 3.24368 13.7701 3.59115 13.5801C3.87729 13.4401 4.06125 13.2101 4.23498 12.9401C4.74596 12.0801 4.43937 10.9501 3.57071 10.4401C2.55897 9.87012 2.23194 8.60012 2.81446 7.61012L3.49917 6.43012C4.09191 5.44012 5.35913 5.09012 6.38109 5.67012C7.27019 6.15012 8.425 5.83012 8.9462 4.98012C9.10972 4.70012 9.20169 4.40012 9.18125 4.10012C9.16081 3.71012 9.27323 3.34012 9.4674 3.04012C9.84553 2.42012 10.5302 2.02012 11.2763 2.00012H12.7172C13.4735 2.00012 14.1582 2.42012 14.5363 3.04012C14.7203 3.34012 14.8429 3.71012 14.8122 4.10012C14.7918 4.40012 14.8838 4.70012 15.0473 4.98012C15.5685 5.83012 16.7233 6.15012 17.6226 5.67012C18.6344 5.09012 19.9118 5.44012 20.4943 6.43012L21.179 7.61012C21.7718 8.60012 21.4447 9.87012 20.4228 10.4401C19.5541 10.9501 19.2475 12.0801 19.7687 12.9401C19.9322 13.2101 20.1162 13.4401 20.4023 13.5801ZM9.10972 12.0101C9.10972 13.5801 10.4076 14.8301 12.0121 14.8301C13.6165 14.8301 14.8838 13.5801 14.8838 12.0101C14.8838 10.4401 13.6165 9.18012 12.0121 9.18012C10.4076 9.18012 9.10972 10.4401 9.10972 12.0101Z"
                            fill="white" />q
                    </svg>
                </i>
                <span class="link_name">Insurance</span>
            </a>
        </li>
        @endif

        @if(true)
        <div class="profile text-center mb-2">
            <a href="/logout">
                <div id="logout_icon" class="">
                    <button class="btn" style="background-color: #FFFFFF;">
                        <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.7907 5.75V3.375C13.7907 2.74511 13.5457 2.14102 13.1096 1.69562C12.6734 1.25022 12.0819 1 11.4651 1H3.32558C2.7088 1 2.11728 1.25022 1.68115 1.69562C1.24502 2.14102 1 2.74511 1 3.375V17.625C1 18.2549 1.24502 18.859 1.68115 19.3044C2.11728 19.7498 2.7088 20 3.32558 20H11.4651C12.0819 20 12.6734 19.7498 13.1096 19.3044C13.5457 18.859 13.7907 18.2549 13.7907 17.625V15.25"
                                stroke="#452C88" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.72095 10.5H21M21 10.5L17.5116 6.9375M21 10.5L17.5116 14.0625" stroke="#452C88"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="mx-auto d-none" id="logout_btn">
                    <button class="btn" style="background-color: #FFFFFF; width: 70%; height: 50px;">
                        <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.7907 5.75V3.375C13.7907 2.74511 13.5457 2.14102 13.1096 1.69562C12.6734 1.25022 12.0819 1 11.4651 1H3.32558C2.7088 1 2.11728 1.25022 1.68115 1.69562C1.24502 2.14102 1 2.74511 1 3.375V17.625C1 18.2549 1.24502 18.859 1.68115 19.3044C2.11728 19.7498 2.7088 20 3.32558 20H11.4651C12.0819 20 12.6734 19.7498 13.1096 19.3044C13.5457 18.859 13.7907 18.2549 13.7907 17.625V15.25"
                                stroke="#452C88" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.72095 10.5H21M21 10.5L17.5116 6.9375M21 10.5L17.5116 14.0625" stroke="#452C88"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span style="color: #452C88;">@lang('lang.logout')</span>
                    </button>
                </div>
            </a>
        </div>
        @endif

        <div class="text-white text-center">
            <span>V 1.0.0</span>
        </div>

    </ul>
</div>