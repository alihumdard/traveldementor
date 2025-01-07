@php
use App\Models\User;
$user = null;
if (session()->has('user_details')) {
$user_id = session('user_details')->id;
$user = User::find($user_id);
$notifications = NULL;
}
@endphp

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title' , 'Travel De Mentor')</title>
    @include('includes.head')
    <style>
        * {
            scrollbar-width: thin;
            scrollbar-color: #452C85 #F5F5F5;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .preloader .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .modal-backdrop {
            /* z-index: 1 !important; */
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }


        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }


        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar:horizontal {
            height: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #452C85;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track {
            background-color: #FFFFF5;
        }

        ::-webkit-scrollbar-track:horizontal {
            display: none;
        }

        ::-webkit-scrollbar-horizontal {
            display: none;
        }

        .version {
            position: absolute;
            bottom: 0;
            left: 6rem;
        }

        .dismiss-btn {
            background-color: #233A85;
            color: #FFFFFF;
            border-radius: 10px;
            box-shadow: 3px 4px 12px -2px rgba(35, 58, 133, 0.5);
            -webkit-box-shadow: 3px 4px 12px -2px rgba(35, 58, 133, 0.5);
            -moz-box-shadow: 3px 4px 12px -2px rgba(35, 58, 133, 0.5);
        }

        .dismiss-btn:hover {
            background-color: #233A85;
            color: #FFFFFF;
            border-radius: 10px;
        }

        body {
            zoom: 90%;
        }

        .menu-acitve {
            background-color: #c49b31 !important;
        }
    </style>
</head>

<body style="background-color: #F5F5F5;">
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    @include('includes.sidebar')
    <section class="home-section">
        <i class="menu btn-menu-openClose open-btn-menu" id="btn" style=" cursor: pointer;  left: 63;"></i>
        <div class="container-scroller">
            @include('includes.header')
            @yield('content')
            @include('includes.footer')
        </div>
    </section>
    <!-- Import Js Files -->
    @include('includes.script')
    <script>
        function fetchAlerts() {
        $.ajax({
            url: '{{ route('alerts.fetch') }}',
            method: 'GET',
            success: function(response) {
                $('#alertBadge').text(response.count);
                $('#alertDropdown').empty();
                if (response.alerts.length > 0) {
                    response.alerts.forEach(function(alert) {
                        var alertHTML = `
                            <div class="dropdown-divider"></div>
                            <div class="p-2" style="background: rgba(69, 44, 136, 0.06); border-left: 3px solid #452C88;" data-alert-id="${alert.id}">
                                <div class="row">
                                    
                                    <div class="col-lg-10">
                                        <p class="mb-0" style="font-size: 11px;">${alert.title}</p>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <!-- SVG Path Here -->
                                        </svg>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="mb-0" style="font-size: 11px; color: #8F9090;">${alert.name || 'No name'}</p>
                                        <p class="mb-0" style="font-size: 11px; color: #8F9090;">${alert.message || 'No message'}</p>
                                    </div>
                                    <div class="col-lg-10">
                                        <a href="${alert.url}"  style="text-decoration: none; color: inherit;">Goto Page</a>
                                    </div>
                                  <div class="col-lg-6 ">
                                      <p class="mb-0 update" style="font-size: 15px; color:red; cursor: pointer;" data-update="${alert.id}">
                                          <i class="fas fas fa-circle"></i>  
                                      </p>
                                </div>
                              <div class="col-lg-6">
                                  <p class="mb-0" style="font-size: 15px; color:red; cursor: pointer;" data-id="${alert.id}">
                                      <i class="fas fa-trash-alt"></i>  
                                  </p>
                              </div>
                                </div>
                            </div>
                        `;
                        $('#alertDropdown').append(alertHTML);
                    });
                } else {
                    $('#alertDropdown').append('<p>No new alerts</p>');
                }
            }
        });
    }

    // Define the function to fetch alerts
function expiry() {
    $.ajax({
        url: '/passport/expiry',  // Route to call the controller
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',  // CSRF Token to protect the request
        },
        success: function(response) {
            console.log('Alerts checked successfully!');
            // You can also update the UI to show the alert message or any other updates here.
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
}

setInterval(expiry, 10000);  // 10 seconds

    fetchAlerts();
        setInterval(fetchAlerts, 10000);
    </script>
    @stack('scripts')
</body>

</html>