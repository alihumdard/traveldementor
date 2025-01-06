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
    position: relative;
    /* Important for absolute positioning of dropdown */
  }

  /* Style the dropdown menu */
  .navbar-nav .nav-item .dropdown-menu {
    display: none;
    /* Initially hide the dropdown */
    position: absolute;
    top: 100%;
    /* Positions the dropdown directly below the parent item */
    right: 10;
    /* Aligns the dropdown to the right of the parent item */
    width: 200px;
    /* Set the width of the dropdown menu */
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    z-index: 9999;
    /* Ensure dropdown appears above other content */
    opacity: 0;
    /* Hide the dropdown initially */
    visibility: hidden;
    /*Hide it initially */
    transition: opacity 0.3s ease, visibility 0.3s ease;
    /* Smooth transition effect */
  }

  /* Show the dropdown when the parent is hovered */
  .navbar-nav .nav-item:hover .dropdown-menu {
    display: block;
    /* Make the dropdown visible */
    opacity: 1;
    /* Make the dropdown fully opaque */
    visibility: visible;
    /* Ensure it's visible */
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
  <div class="navbar-menu-wrapper col-12 col-lg-12 col-sm-12 d-flex"
    style="background-color: #F5F5F5 !important; justify-content: flex-end;">
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#"
          data-bs-toggle="dropdown">
          <div class="nav-profile-image">
            <button class="btn content-background btn-sm text-white">
              <i class="fas fa-plus" style="font-size: 20px;"></i>
            </button>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
          aria-labelledby="notificationDropdown">
          <ul class="list-unstyled m-0 p-2">
            <!-- First List Item -->
            <li class="d-flex align-items-center py-2">
              <i class="fas fa-envelope mx-2" style="font-size: 18px; color: #452C88;"></i>
              <a href="#" class="text-decoration-none" style="color: #452C88;">Application</a>
            </li>

            <!-- Second List Item -->
            <li class="d-flex align-items-center py-2">
              <i class="fas fa-house-crack mx-2" style="font-size: 18px; color: #452C88;"></i>
              <a href="#" class="text-decoration-none" style="color: #452C88;">Insurance</a>
            </li>
            <!-- Third List Item -->
            <li class="d-flex align-items-center py-2">
              <i class="fas fa-hotel mx-2" style="font-size: 18px; color: #452C88;"></i>
              <a href="#" class="text-decoration-none" style="color: #452C88;">Hotel Booking</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#"
          data-bs-toggle="dropdown">
          <div class="nav-profile-image" style="margin-top: 6px;">
            <div class="preview-thumbnail">
              <i class="" style="color:#67748E; position: relative;">
                <svg width="25" height="25" viewBox="0 0 25 29" fill="#452C88" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M12.3158 0.315918C6.48571 0.315918 1.75945 5.04218 1.75945 10.8723V17.1812L0.515364 18.4252C0.0121758 18.9284 -0.138341 19.6851 0.133979 20.3426C0.406299 21.0001 1.04785 21.4287 1.75945 21.4287H22.8722C23.5839 21.4287 24.2253 21.0001 24.4977 20.3426C24.7701 19.6851 24.6195 18.9284 24.1163 18.4252L22.8722 17.1812V10.8723C22.8722 5.04218 18.1459 0.315918 12.3158 0.315918Z"
                    fill="#452C88" />
                  <path
                    d="M12.3163 28.4664C9.40122 28.4664 7.03809 26.1034 7.03809 23.1882H17.5945C17.5945 26.1034 15.2314 28.4664 12.3163 28.4664Z"
                    fill="#452C88" />
                </svg>
              </i>
              <span class="badge bg-danger text-white"
                style="position: absolute; top: 1.2rem; right: 0.1rem; border-radius: 50%;" id="alertBadge">0</span>
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
          aria-labelledby="notificationDropdown">
          <div class="row pt-2">
            <div class="col-lg-12">
              <b class="ellipsis ml-1">@lang('lang.notifications')</b>
            </div>
            <div class="col-lg-12 text-left pr-4" id="alertDropdown"
              style="max-height: 300px; overflow-y: auto; width:40%">

            </div>

            {{-- @if($notifications ?? '')
            @foreach($notifications as $key => $value)
            <a href="/notifications" style="text-decoration: none !important;">
              <div class="dropdown-divider"></div>
              <div class="p-2"
                style="width: 100%; height: 100%; background: rgba(69, 44, 136, 0.06); border-left: 3px solid #452C88;">
                <div class="row">
                  <div class="col-lg-10">
                    <p style="font-size: 11px;" class="mb-0">{{$value['title']}}</p>
                  </div>
                  <div class="col-lg-2 p-1 text-center">
                    <svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M4.93979 3.99943L7.8041 1.14179C7.92953 1.01635 8 0.846231 8 0.668843C8 0.491455 7.92953 0.321332 7.8041 0.1959C7.67867 0.0704672 7.50854 0 7.33116 0C7.15377 0 6.98365 0.0704672 6.85821 0.1959L4.00057 3.06021L1.14292 0.1959C1.01749 0.0704672 0.847368 -1.32164e-09 0.66998 0C0.492592 1.32165e-09 0.322469 0.0704672 0.197036 0.1959C0.0716041 0.321332 0.0011368 0.491455 0.0011368 0.668843C0.0011368 0.846231 0.0716041 1.01635 0.197036 1.14179L3.06134 3.99943L0.197036 6.85708C0.134602 6.919 0.0850471 6.99267 0.0512292 7.07385C0.0174113 7.15502 0 7.24208 0 7.33002C0 7.41795 0.0174113 7.50502 0.0512292 7.58619C0.0850471 7.66737 0.134602 7.74104 0.197036 7.80296C0.258961 7.8654 0.332634 7.91495 0.413807 7.94877C0.494979 7.98259 0.582045 8 0.66998 8C0.757915 8 0.844981 7.98259 0.926153 7.94877C1.00733 7.91495 1.081 7.8654 1.14292 7.80296L4.00057 4.93866L6.85821 7.80296C6.92014 7.8654 6.99381 7.91495 7.07498 7.94877C7.15616 7.98259 7.24322 8 7.33116 8C7.41909 8 7.50616 7.98259 7.58733 7.94877C7.6685 7.91495 7.74218 7.8654 7.8041 7.80296C7.86653 7.74104 7.91609 7.66737 7.94991 7.58619C7.98373 7.50502 8.00114 7.41795 8.00114 7.33002C8.00114 7.24208 7.98373 7.15502 7.94991 7.07385C7.91609 6.99267 7.86653 6.919 7.8041 6.85708L4.93979 3.99943Z"
                        fill="#323C47" />
                    </svg>
                  </div>
                  <div class="col-lg-12">
                    <p style="font-size: 11px; color: #8F9090;" class="mb-0">{{ implode(' ', array_slice(explode(' ',
                      $value['desc']), 0, 5)) }} ...</p>
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
            @endif --}}

            <div class="dropdown-divider"></div>
          </div>
      </li>
      {{-- <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#"
          data-bs-toggle="dropdown">
          <div class="nav-profile-image" style="margin-top: 6px;">
            <div class="preview-thumbnail">
              <i class="" style="color:#67748E; position: relative;">
                <!-- Notification Icon -->
                <svg width="25" height="25" viewBox="0 0 25 29" fill="#452C88" xmlns="http://www.w3.org/2000/svg">
                  <!-- SVG Path Here -->
                </svg>
              </i>
              <span id="alertBadge" class="badge bg-danger text-white"
                style="position: absolute; top: 1.2rem; right: 0.1rem; border-radius: 50%;">0</span>
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
          aria-labelledby="notificationDropdown" id="alertDropdown">
          <!-- Dynamic Content Will Be Loaded Here -->
        </div>
      </li>
      --}}
      {{-- <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#"
          data-bs-toggle="dropdown">
          <div class="nav-profile-image" style="margin-top: 6px;">
            <div class="preview-thumbnail">
              <i class="" style="color:#67748E; position: relative;">
                <!-- Notification Icon -->
                <svg width="25" height="25" viewBox="0 0 25 29" fill="#452C88" xmlns="http://www.w3.org/2000/svg">
                  <!-- SVG Path Here -->
                </svg>
              </i>
              <span id="alertBadge" class="badge bg-danger text-white"
                style="position: absolute; top: 1.2rem; right: 0.1rem; border-radius: 50%;">0</span>
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
          aria-labelledby="notificationDropdown" id="alertDropdown" style="max-height: 300px; overflow-y: auto;">
          <!-- Dynamic Content Will Be Loaded Here -->
        </div>
      </li> --}}


      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle mx-1" id="notificationDropdown" href="#"
          data-bs-toggle="dropdown">
          <div class="nav-profile-image">
            <div class="preview-thumbnail">
              <img style="border-radius: 50% !important; width: 34px;  height: 34px; object-fit: cover;"
                src="{{ (isset($user->user_pic)) ? asset('storage/' . $user->user_pic) : '/assets/images/user.png'}}"
                alt="profile">
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
          aria-labelledby="notificationDropdown">
          <div class="dropdown-divider"></div>

          <!-- Profile info -->
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon">
                <img style="border-radius: 12px !important; object-fit: cover; width: 45px; height: 45px;"
                  src="{{ (isset($user->user_pic)) ? asset('storage/' . $user->user_pic) : '/assets/images/user.png'}}"
                  alt="profile">
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <div class="nav-profile-text d-flex flex-column text-wrap">
                <span class="mb-1 text-dark mx-4" style="font-size: large; color: #452C85;">{{(isset($user->name)) ?
                  $user->name : 'Guest'}}</span>
                <span class="text-secondary mx-4 text-small">{{(isset($user->role)) ? $user->role : 'Guest'}}</span>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <!-- Logout link -->
          <a class="dropdown-item preview-item" href="/logout">
            <div class="preview-thumbnail">
              <div class="preview-icon">
                <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M16.3488 6.7V3.85C16.3488 3.09413 16.0548 2.36922 15.5315 1.83475C15.0081 1.30027 14.2983 1 13.5581 1H3.7907C3.05056 1 2.34073 1.30027 1.81738 1.83475C1.29402 2.36922 1 3.09413 1 3.85V20.15C1 20.9059 1.29402 21.6308 1.81738 22.1652C2.34073 22.6997 3.05056 23 3.7907 23H13.5581C14.2983 23 15.0081 22.6997 15.5315 22.1652C16.0548 21.6308 16.3488 20.9059 16.3488 20.15V17.3C16.3488 16.5441 16.0548 15.8192 15.5315 15.2847C15.0081 14.7502 14.2983 14.45 13.5581 14.45H10.3988V10.75H16.3488C16.8888 10.75 17.3588 10.5003 17.5788 10.0653C17.7988 9.63027 17.7328 9.09025 17.2788 8.84725L11.2788 6.09725C11.0508 5.96025 10.7288 6.05025 10.4788 6.22725L6.47881 8.47725C6.27881 8.62725 6.10881 8.84725 6.06881 9.09725C6.02881 9.34725 6.10881 9.59725 6.27881 9.74725L10.4788 12.99725C10.7288 13.17425 11.0508 13.26425 11.2788 13.12725L17.2788 10.37725C17.7328 10.13425 17.7988 9.59425 17.5788 9.15925C17.3588 8.72425 16.8888 8.47425 16.3488 8.47425H10.3988V6.7H16.3488Z"
                    fill="#452C88" />
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 
 $(document).ready(function() {
 $(document).on('click', '[data-update]', function() {
    var alertId = $(this).data('update'); // Get the alert id from the data-update attribute
    var iconElement = $(this).find('i');  // Find the <i> element inside the clicked <p>

    $.ajax({
        url: '/update/alert/status',
        method: 'POST',
        data: {
            alert_id: alertId,
        },
        success: function(response) {
            if(response.success) {
                iconElement.css('color', 'green');
                iconElement.removeClass('fa-circle').addClass('fa-check-circle'); // Change the icon to check-circle
            } else {
                console.error('Failed to update status');
                iconElement.css('color', 'red');
                iconElement.removeClass('fa-circle').addClass('fa-sync-alt'); // Change the icon to sync-alt on failure
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            iconElement.css('color', 'red');
            iconElement.removeClass('fa-circle').addClass('fa-sync-alt'); // Change to sync-alt icon in case of error
        }
    });
});


$(document).on('click', '[data-id]', function() {
    var alertId = $(this).data('id');

    $.ajax({
        url: '/delete/alert',  
        method: 'POST',
        data: {
            alert_id: alertId,
        },
        success: function(response) {
            if(response.success) {
 
              $('#alertBadge').text(function(index, currentCount) {
                    return Math.max(0, parseInt(currentCount) - 1); // Ensure count doesn't go below 0
                });
              $(`[data-alert-id="${alertId}"]`).closest('.p-2').fadeOut();
            } else {
                console.error('Failed to deleted');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            statusElement.css('color', 'red'); 
        }
    });
});

});

</script>