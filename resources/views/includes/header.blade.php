<style>
  .nav-profile-image .btn.content-background {
    background-color: #452C88 !important;
    /* Aap yahan apni desired color value daalain */
  }

  .dropdown-menu {
    background-color: #f0f0f0 !important;
    /* Dropdown menu ka background color change kare */
  }
/* Ensure the parent element is positioned correctly */
.navbar-nav .nav-item {
    position: relative; /* Important for absolute positioning of dropdown */
}

/* Style the dropdown menu */
.navbar-nav .nav-item .dropdown-menu {
    display: none; /* Initially hide the dropdown */
    position: absolute;
    top: 100%; /* Positions the dropdown directly below the parent item */
    right: 10; /* Aligns the dropdown to the right of the parent item */
    width: 200px; /* Set the width of the dropdown menu */
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    z-index: 9999; /* Ensure dropdown appears above other content */
    opacity: 0; /* Hide the dropdown initially */
     visibility: hidden; /*Hide it initially */
    transition: opacity 0.3s ease, visibility 0.3s ease; /* Smooth transition effect */
}

/* Show the dropdown when the parent is hovered */
.navbar-nav .nav-item:hover .dropdown-menu {
    display: block; /* Make the dropdown visible */
    opacity: 1; /* Make the dropdown fully opaque */
    visibility: visible; /* Ensure it's visible */
    margin-left: 50px;
}

/* Styling for items in the dropdown */
.dropdown-item {
    padding: 10px;
    color: #452C88;
    font-size: 14px;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Hover effect on items */
.dropdown-item:hover {
    background-color: #f4f4f4;
    color: #5a2a91;
}

/* Profile image styles */
.nav-profile-image img {
    border-radius: 50%;
    width: 34px;
    height: 34px;
    object-fit: cover;
}

/* Add divider between items */
.dropdown-divider {
    border-top: 1px solid #ddd;
    margin: 5px 0;
}

/* Styling for text and profile content */
.preview-item-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
}

/* Text styles for profile name */
.preview-item-content .nav-profile-text {
    margin-left: 10px;
    font-weight: bold;
}

/* Custom text color for links */
.preview-item-content p {
    margin: 0;
    font-size: 14px;
    color: #452C88;
}

</style>
<nav class="navbar p-0 row">
  <div class="navbar-menu-wrapper col-12 col-lg-12 col-sm-12 d-flex" style="background-color: #F5F5F5 !important; justify-content: flex-end;">
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <div class="nav-profile-image">
            <button class="btn content-background btn-sm text-white">
              <i class="fa fa-plus" style="font-size: 20px;"></i>
            </button>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          @if(view_permission('quotations'))
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="{{ route('quotations') }}">
            <div class="preview-thumbnail">
              <div class="preview-icon">
                <i class="ml-3 fa-regular fa-file-lines"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.quotations')</p>
            </div>
          </a>
          @endif

          @if(view_permission('contracts'))
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="{{ route('contracts') }}">
            <div class="preview-thumbnail">
              <div class="preview-icon">
                <i class=" ml-3  fa-solid fa-file-signature"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.contracts')</p>
            </div>
          </a>
          @endif

          @if(view_permission('invoices'))
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="{{ route('invoices') }}">
            <div class="preview-thumbnail">
              <div class="preview-icon">
                <i class=" ml-3 fa-solid fa-receipt"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.invoices')</p>
            </div>
          </a>
          @endif

          @if(view_permission('users'))
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="{{ '/users' }}">
            <div class="preview-thumbnail">
              <div class="preview-icon ml-2">
                <svg width="40" height="32" viewBox="0 0 27 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.15246 34.6808H12.5431V27.2902C8.66263 27.7192 5.58148 30.8003 5.15246 34.6808ZM14.4035 27.2902V34.6808H21.7942C21.3652 30.8003 18.284 27.7192 14.4035 27.2902ZM21.7943 36.5412C21.6643 37.7177 21.2909 38.8194 20.7258 39.7963L22.3362 40.7279C23.2074 39.2219 23.7057 37.4732 23.7057 35.611C23.7057 29.9599 19.1245 25.3787 13.4733 25.3787C7.82218 25.3787 3.24097 29.9599 3.24097 35.611C3.24097 37.4732 3.73928 39.2219 4.61043 40.7279L6.22082 39.7963C5.65571 38.8194 5.28232 37.7177 5.15237 36.5412H21.7943Z" fill="#452C88" />
                  <path d="M16.264 35.6108C16.264 37.1521 15.0146 38.4015 13.4734 38.4015C11.9321 38.4015 10.6827 37.1521 10.6827 35.6108C10.6827 34.0696 11.9321 32.8202 13.4734 32.8202C15.0146 32.8202 16.264 34.0696 16.264 35.6108Z" fill="#452C88" />
                  <path d="M20.5285 32.6761C20.2626 31.6836 20.8516 30.6635 21.844 30.3975L23.6411 29.916C24.6336 29.6501 25.6537 30.2391 25.9197 31.2315L26.8827 34.8256C27.1486 35.8182 26.5597 36.8382 25.5672 37.1042L23.7701 37.5857C22.7777 37.8516 21.7575 37.2627 21.4916 36.2701L20.5285 32.6761Z" fill="#452C88" />
                  <path d="M1.02687 31.2307C1.29282 30.2382 2.31298 29.6492 3.30543 29.9152L5.10251 30.3967C6.09496 30.6626 6.68397 31.6828 6.41802 32.6752L5.45497 36.2693C5.18902 37.2618 4.16886 37.8507 3.17641 37.5849L1.37942 37.1033C0.386901 36.8374 -0.202083 35.8173 0.0638563 34.8248L1.02687 31.2307Z" fill="#452C88" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.10141 14.2159V11.4252H6.96184V14.2159C6.96184 17.8121 9.87713 20.7274 13.4733 20.7274C17.0696 20.7274 19.9848 17.8121 19.9848 14.2159V11.4252H21.8453V14.2159C21.8453 18.8396 18.0971 22.5878 13.4733 22.5878C8.84962 22.5878 5.10141 18.8396 5.10141 14.2159Z" fill="#452C88" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M3.97984 8.63467H23.0075C23.0744 8.46397 23.1465 8.26277 23.2184 8.03245L23.2297 7.99645C23.4806 7.1934 23.7057 6.47281 23.7057 5.00383C23.7057 4.25891 23.2217 3.63166 22.5811 3.13569C21.932 2.63319 21.0455 2.20297 20.058 1.85229C18.0806 1.15 15.5867 0.727844 13.4733 0.727844C11.36 0.727844 8.86607 1.15 6.88862 1.85229C5.9012 2.20297 5.0147 2.63319 4.3656 3.13569C3.72496 3.63166 3.24097 4.25891 3.24097 5.00383C3.24097 6.36758 3.46906 7.08632 3.70338 7.82492C3.72524 7.89375 3.7471 7.96268 3.76886 8.03235C3.84077 8.26268 3.91295 8.46388 3.97984 8.63467ZM9.75247 5.84402C9.75247 5.33029 10.1689 4.91381 10.6827 4.91381H16.264C16.7777 4.91381 17.1942 5.33029 17.1942 5.84402C17.1942 6.35776 16.7777 6.77424 16.264 6.77424H10.6827C10.1689 6.77424 9.75247 6.35776 9.75247 5.84402Z" fill="#452C88" />
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M4.19109 10.877C4.23332 10.6558 4.43583 10.4951 4.67219 10.4951H22.2745C22.5108 10.4951 22.7133 10.6558 22.7556 10.877L22.7558 10.8781L22.756 10.8792L22.7565 10.8819L22.7576 10.8883L22.7603 10.9052C22.7623 10.9183 22.7645 10.9351 22.7666 10.9553C22.7709 10.9958 22.7748 11.0501 22.7754 11.1163C22.7765 11.2486 22.7643 11.4297 22.7142 11.643C22.6128 12.0742 22.3599 12.6223 21.7809 13.1549C20.6329 14.2109 18.2743 15.1461 13.4733 15.1461C8.6723 15.1461 6.31374 14.2109 5.16576 13.1549C4.58671 12.6223 4.33387 12.0742 4.23248 11.643C4.18234 11.4297 4.17016 11.2486 4.17127 11.1163C4.17183 11.0501 4.17574 10.9958 4.18002 10.9553C4.18216 10.9351 4.18439 10.9183 4.18634 10.9052L4.18904 10.8883L4.19016 10.8819L4.19062 10.8792L4.1909 10.8781L4.19109 10.877Z" fill="#452C88" />
                </svg>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.users')</p>
            </div>
          </a>
          @endif

          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <div class="nav-profile-image" style="margin-top: 6px;">
            <div class="preview-thumbnail">
              <i class="" style="color:#67748E; position: relative;">
                <svg width="25" height="25" viewBox="0 0 25 29" fill="#452C88" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.3158 0.315918C6.48571 0.315918 1.75945 5.04218 1.75945 10.8723V17.1812L0.515364 18.4252C0.0121758 18.9284 -0.138341 19.6851 0.133979 20.3426C0.406299 21.0001 1.04785 21.4287 1.75945 21.4287H22.8722C23.5839 21.4287 24.2253 21.0001 24.4977 20.3426C24.7701 19.6851 24.6195 18.9284 24.1163 18.4252L22.8722 17.1812V10.8723C22.8722 5.04218 18.1459 0.315918 12.3158 0.315918Z" fill="#452C88" />
                  <path d="M12.3163 28.4664C9.40122 28.4664 7.03809 26.1034 7.03809 23.1882H17.5945C17.5945 26.1034 15.2314 28.4664 12.3163 28.4664Z" fill="#452C88" />
                </svg>
              </i>
              <span class="badge bg-danger text-white" style="position: absolute; top: 1.2rem; right: 0.1rem; border-radius: 50%;">{{ $count ?? 0 }}</span>
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <div class="row pt-2">
            <div class="col-lg-6">
              <b class="ellipsis ml-1">@lang('lang.notifications')</b>
            </div>
            <div class="col-lg-6 text-right pr-4">
              <form id="form-notification" method="post" action="notifications">
                @csrf
                <input type="hidden" name="all_read" value="all-read">
                <p id="all-read" style="cursor:pointer; color: #ACADAE; font-size: small;">Mark all as read</p>
              </form>
            </div>

            <script>
              $('#all-read').on('click', function(e) {
                e.preventDefault();
                $('#form-notification').submit();
              });
            </script>
            @if($notifications ?? '')
            @foreach($notifications as $key => $value)
            <a href="/notifications" style="text-decoration: none !important;">
              <div class="dropdown-divider"></div>
              <div class="p-2" style="width: 100%; height: 100%; background: rgba(69, 44, 136, 0.06); border-left: 3px solid #452C88;">
                <div class="row">
                  <div class="col-lg-10">
                    <p style="font-size: 11px;" class="mb-0">{{$value['title']}}</p>
                  </div>
                  <div class="col-lg-2 p-1 text-center">
                    <svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M4.93979 3.99943L7.8041 1.14179C7.92953 1.01635 8 0.846231 8 0.668843C8 0.491455 7.92953 0.321332 7.8041 0.1959C7.67867 0.0704672 7.50854 0 7.33116 0C7.15377 0 6.98365 0.0704672 6.85821 0.1959L4.00057 3.06021L1.14292 0.1959C1.01749 0.0704672 0.847368 -1.32164e-09 0.66998 0C0.492592 1.32165e-09 0.322469 0.0704672 0.197036 0.1959C0.0716041 0.321332 0.0011368 0.491455 0.0011368 0.668843C0.0011368 0.846231 0.0716041 1.01635 0.197036 1.14179L3.06134 3.99943L0.197036 6.85708C0.134602 6.919 0.0850471 6.99267 0.0512292 7.07385C0.0174113 7.15502 0 7.24208 0 7.33002C0 7.41795 0.0174113 7.50502 0.0512292 7.58619C0.0850471 7.66737 0.134602 7.74104 0.197036 7.80296C0.258961 7.8654 0.332634 7.91495 0.413807 7.94877C0.494979 7.98259 0.582045 8 0.66998 8C0.757915 8 0.844981 7.98259 0.926153 7.94877C1.00733 7.91495 1.081 7.8654 1.14292 7.80296L4.00057 4.93866L6.85821 7.80296C6.92014 7.8654 6.99381 7.91495 7.07498 7.94877C7.15616 7.98259 7.24322 8 7.33116 8C7.41909 8 7.50616 7.98259 7.58733 7.94877C7.6685 7.91495 7.74218 7.8654 7.8041 7.80296C7.86653 7.74104 7.91609 7.66737 7.94991 7.58619C7.98373 7.50502 8.00114 7.41795 8.00114 7.33002C8.00114 7.24208 7.98373 7.15502 7.94991 7.07385C7.91609 6.99267 7.86653 6.919 7.8041 6.85708L4.93979 3.99943Z" fill="#323C47" />
                    </svg>
                  </div>
                  <div class="col-lg-12">
                    <p style="font-size: 11px; color: #8F9090;" class="mb-0">{{ implode(' ', array_slice(explode(' ', $value['desc']), 0, 5)) }} ...</p>
                  </div>
                  <div class="col-lg-10">
                    <p style="font-size: 11px;" class="mb-0">{{table_date($value['created_at'])}}</p>
                  </div>
                  <div class="col-lg-2 p-1 text-center">
                    <svg width="13" height="3" viewBox="0 0 13 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="1.5" cy="1.5" r="1.5" fill="#452C88" />
                      <circle cx="6.5" cy="1.5" r="1.5" fill="#452C88" />
                      <circle cx="11.5" cy="1.5" r="1.5" fill="#452C88" />
                    </svg>
                  </div>
                </div>
              </div>
            </a>
            @endforeach
            @endif

            <div class="dropdown-divider"></div>
          </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <div class="nav-profile-image">
            <div class="preview-thumbnail">
              <img style="border-radius: 50% !important; width: 34px;  height: 34px; object-fit: cover;" src="{{ (isset($user->user_pic)) ? asset('storage/' . $user->user_pic) : '/assets/images/user.png'}}" alt="profile">
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <div class="dropdown-divider"></div>

          <!-- Profile info -->
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon">
                <img style="border-radius: 12px !important; object-fit: cover; width: 45px; height: 45px;" src="{{ (isset($user->user_pic)) ? asset('storage/' . $user->user_pic) : 'assets/images/user.png'}}" alt="profile">
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <div class="nav-profile-text d-flex flex-column text-wrap">
                <span class="mb-1 text-dark mx-4" style="font-size: large; color: #452C85;">{{(isset($user->name)) ? $user->name : 'Guest'}}</span>
                <span class="text-secondary mx-4 text-small">{{(isset($user->role)) ? $user->role : 'Guest'}}</span>
              </div>
            </div>
          </a>

          <div class="dropdown-divider"></div>

          <!-- Settings link -->
          <a class="dropdown-item preview-item" href="/settings">
            <div class="preview-thumbnail">
              <div class="preview-icon">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M25.5028 16.9751C25.9499 17.2126 26.2948 17.5876 26.5375 17.9626C27.0102 18.7376 26.9719 19.6876 26.512 20.5251L25.6178 22.0251C25.1451 22.8251 24.2637 23.3251 23.3567 23.3251C22.9096 23.3251 22.4114 23.2001 22.0026 22.9501C21.6705 22.7376 21.2872 22.6626 20.8785 22.6626C19.6138 22.6626 18.5535 23.7001 18.5152 24.9376C18.5152 26.3751 17.3399 27.5001 15.8709 27.5001H14.1335C12.6517 27.5001 11.4764 26.3751 11.4764 24.9376C11.4509 23.7001 10.3906 22.6626 9.12594 22.6626C8.70439 22.6626 8.32115 22.7376 8.00179 22.9501C7.59301 23.2001 7.08203 23.3251 6.6477 23.3251C5.72793 23.3251 4.8465 22.8251 4.37384 22.0251L3.4924 20.5251C3.01975 19.7126 2.9942 18.7376 3.46685 17.9626C3.67125 17.5876 4.05448 17.2126 4.48881 16.9751C4.8465 16.8001 5.07644 16.5126 5.2936 16.1751C5.93233 15.1001 5.54909 13.6876 4.46326 13.0501C3.19859 12.3376 2.78981 10.7501 3.51795 9.51262L4.37384 8.03762C5.11476 6.80012 6.69879 6.36262 7.97624 7.08762C9.08762 7.68762 10.5311 7.28762 11.1826 6.22512C11.387 5.87512 11.502 5.50012 11.4764 5.12512C11.4509 4.63762 11.5914 4.17512 11.8341 3.80012C12.3068 3.02512 13.1627 2.52512 14.0952 2.50012H15.8964C16.8417 2.50012 17.6976 3.02512 18.1703 3.80012C18.4002 4.17512 18.5535 4.63762 18.5152 5.12512C18.4896 5.50012 18.6046 5.87512 18.809 6.22512C19.4605 7.28762 20.904 7.68762 22.0282 7.08762C23.2928 6.36262 24.8896 6.80012 25.6178 8.03762L26.4737 9.51262C27.2146 10.7501 26.8058 12.3376 25.5284 13.0501C24.4425 13.6876 24.0593 15.1001 24.7108 16.1751C24.9152 16.5126 25.1451 16.8001 25.5028 16.9751ZM11.387 15.0126C11.387 16.9751 13.0094 18.5376 15.015 18.5376C17.0206 18.5376 18.6046 16.9751 18.6046 15.0126C18.6046 13.0501 17.0206 11.4751 15.015 11.4751C13.0094 11.4751 11.387 13.0501 11.387 15.0126Z" fill="#452C88" />
                </svg>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <p class="ellipsis mb-0 mx-4" style="color: #452C88;">@lang('lang.settings')</p>
            </div>
          </a>

          <div class="dropdown-divider"></div>

          <!-- Google Link -->
          <a class="dropdown-item preview-item" href="https://www.google.com" target="_blank">
            <div class="preview-icon">
              <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 9H6V12H8V9ZM8 5H6V7H8V5ZM11 2H9V4H11V2ZM13 6H11V8H13V6ZM13 9H11V11H13V9ZM11 14H9V16H11V14ZM9 18H7V20H9V18ZM6 22H8V20H6V22ZM4 20H6V18H4V20ZM4 16H6V14H4V16ZM5 12H7V10H5V12Z" fill="#452C88" />
              </svg>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <p class="ellipsis mb-0 mx-4" style="color: #452C88;">Google</p>
            </div>
          </a>

          <!-- Facebook Link -->
          <a class="dropdown-item preview-item" href="https://www.facebook.com" target="_blank">
            <div class="preview-icon">
              <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 2C6.923 2 2 6.923 2 13C2 19.077 6.923 24 13 24C19.077 24 24 19.077 24 13C24 6.923 19.077 2 13 2ZM13 22.5C7.664 22.5 3 17.836 3 13C3 8.164 7.664 3.5 13 3.5C18.336 3.5 23 8.164 23 13C23 17.836 18.336 22.5 13 22.5ZM14 12H12V10H14V12ZM14 16H12V13H14V16ZM14 8H12V6H14V8Z" fill="#452C88" />
              </svg>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <p class="ellipsis mb-0 mx-4" style="color: #452C88;">Facebook</p>
            </div>
          </a>

          <div class="dropdown-divider"></div>

          <!-- Logout link -->
          <a class="dropdown-item preview-item" href="/logout">
            <div class="preview-thumbnail">
              <div class="preview-icon">
                <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16.3488 6.7V3.85C16.3488 3.09413 16.0548 2.36922 15.5315 1.83475C15.0081 1.30027 14.2983 1 13.5581 1H3.7907C3.05056 1 2.34073 1.30027 1.81738 1.83475C1.29402 2.36922 1 3.09413 1 3.85V20.15C1 20.9059 1.29402 21.6308 1.81738 22.1652C2.34073 22.6997 3.05056 23 3.7907 23H13.5581C14.2983 23 15.0081 22.6997 15.5315 22.1652C16.0548 21.6308 16.3488 20.9059 16.3488 20.15V17.3C16.3488 16.5441 16.0548 15.8192 15.5315 15.2847C15.0081 14.7502 14.2983 14.45 13.5581 14.45H10.3988V10.75H16.3488C16.8888 10.75 17.3588 10.5003 17.5788 10.0653C17.7988 9.63027 17.7328 9.09025 17.2788 8.84725L11.2788 6.09725C11.0508 5.96025 10.7288 6.05025 10.4788 6.22725L6.47881 8.47725C6.27881 8.62725 6.10881 8.84725 6.06881 9.09725C6.02881 9.34725 6.10881 9.59725 6.27881 9.74725L10.4788 12.99725C10.7288 13.17425 11.0508 13.26425 11.2788 13.12725L17.2788 10.37725C17.7328 10.13425 17.7988 9.59425 17.5788 9.15925C17.3588 8.72425 16.8888 8.47425 16.3488 8.47425H10.3988V6.7H16.3488Z" fill="#452C88" />
                </svg>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <p class="ellipsis mb-0 mx-4" style="color: #452C88;">Logout</p>
            </div>
          </a>
        </div>
      </li>

    </ul>
  </div>
</nav>