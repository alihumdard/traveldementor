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
            background-color: #C0C0C0 !important;
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
    @stack('scripts')
</body>

</html>