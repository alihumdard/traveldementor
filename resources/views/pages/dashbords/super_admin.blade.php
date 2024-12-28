@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<!-- partial -->
<style>
    .col-lg-6.col-xl-4.col-md-6.mb-4 .card {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .col-lg-6.col-xl-4.col-md-6.mb-4 .card:hover {
        transform: translateX(15px) scale(1.05);
        /* Slide and zoom */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    a:hover {
        text-decoration: none;
    }
</style>
<div class="content-wrapper py-0 my-2">
    <div class="bg-white rounded">
        <div class="page-header px-3 py-2">
            <h3 class="page-title font-weight-bold">
                <span class="page-title-icon text-white me-2 py-2">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.54 0H5.92C7.33 0 8.46 1.15 8.46 2.561V5.97C8.46 7.39 7.33 8.53 5.92 8.53H2.54C1.14 8.53 0 7.39 0 5.97V2.561C0 1.15 1.14 0 2.54 0ZM2.54 11.4697H5.92C7.33 11.4697 8.46 12.6107 8.46 14.0307V17.4397C8.46 18.8497 7.33 19.9997 5.92 19.9997H2.54C1.14 19.9997 0 18.8497 0 17.4397V14.0307C0 12.6107 1.14 11.4697 2.54 11.4697ZM17.4601 0H14.0801C12.6701 0 11.5401 1.15 11.5401 2.561V5.97C11.5401 7.39 12.6701 8.53 14.0801 8.53H17.4601C18.8601 8.53 20.0001 7.39 20.0001 5.97V2.561C20.0001 1.15 18.8601 0 17.4601 0ZM14.0801 11.4697H17.4601C18.8601 11.4697 20.0001 12.6107 20.0001 14.0307V17.4397C20.0001 18.8497 18.8601 19.9997 17.4601 19.9997H14.0801C12.6701 19.9997 11.5401 18.8497 11.5401 17.4397V14.0307C11.5401 12.6107 12.6701 11.4697 14.0801 11.4697Z" fill="#452c88" />
                    </svg>
                </span>
                <span>Admin Dashboard</span>
            </h3>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-6 col-xl-4 col-md-6 mb-4">
            <a href="#">
                <div class="card h-100" style="border-radius: 20px;">
                    <div class="own-card-padding card-body d-flex justify-content-between" style="border-top: none !important;">
                        <div>
                            <h5 class="font-weight-bold" style="color:black;"><span>Active User</span></h5>
                            <h5 style="color: #452C88;">25</h5>
                        </div>
                        <div>
                            <div class="ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="50" height="50">
                                    <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" fill="#452C88" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 mb-4">
            <a href="{{route('application.index')}}">
                <div class="card h-100" style="border-radius: 20px;">
                    <div class=" own-card-padding card-body d-flex justify-content-between" style="border-top:none !important;">
                        <div>
                            <h5 class="font-weight-bold" style="color: black;"><span>Total Applications</span></h5>
                            <h5 style="color: #452C88;">12</h5>
                        </div>
                        <div>
                            <div class="ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="50" height="50">
                                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" fill="#452C88" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 mb-4">
            <a href="#">
                <div class="  card h-100" style="border-radius: 20px;">
                    <div class=" own-card-padding card-body d-flex justify-content-between" style="border-top:none !important;">
                        <div>
                            <h5 class="font-weight-bold" style="color: black;"><span>Pending Appointment</span></h5>
                            <h5 style="color: #452C88;">12</h5>
                        </div>
                        <div>
                            <div class="ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="50" height="50">
                                    <path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z" fill="#452c88" />
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 mb-4">
            <a href="#">
                <div class="  card h-100" style="border-radius: 20px;">
                    <div class=" own-card-padding card-body d-flex justify-content-between" style="border-top:none !important;">
                        <div>
                            <h5 class="font-weight-bold" style="color: black;"><span>Schedule Appointment</span></h5>
                            <h5 style="color: #452C88;">10</h5>
                        </div>
                        <div class="ms-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="50" height="50">
                                <path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z" fill="#452c88" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-xl-4 col-md-6 mb-4">
            <a href="#">
                <div class="card h-100" style="border-radius: 20px;">
                    <div class=" own-card-padding card-body d-flex justify-content-between" style="border-top:none !important;">
                        <div>
                            <h5 class="font-weight-bold" style="color: black;"><span>Staff</span></h5>
                            <h5 style="color: #452C88;">10</h5>
                        </div>
                        <div class="ms-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="50" height="50" fill="#452C88">
                                <path d="M192 0c-41.8 0-77.4 26.7-90.5 64L64 64C28.7 64 0 92.7 0 128L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64l-37.5 0C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM128 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM80 432c0-44.2 35.8-80 80-80l64 0c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16L96 448c-8.8 0-16-7.2-16-16z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>
@stop

@pushOnce('scripts')
<script>

</script>
@endPushOnce