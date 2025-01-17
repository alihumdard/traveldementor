@extends('layouts.main')
@section('title', ' Hotel Booking')
@section('content')

<style>
    tbody tr {
        cursor: move;
    }

    tbody tr td:first-child {
        cursor: grab;
    }

    .modal-backdrop.show {
        opacity: 0 !important;
    }

    .draggable-modal .modal-dialog {
        pointer-events: none;
    }

    .draggable-modal .modal-content {
        pointer-events: auto;
    }

    .form-group .form-check {
        margin-bottom: 5px;
    }


    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
    }

    #map {
        height: 400px;
        width: 100%;
    }

    .d-view_map {
        width: 100%;
        height: 400px;
    }

    #addAddressModal .modal-header {
        padding: 0.5rem 1rem;
    }

    #addAddressModal .modal-title {
        font-size: 1rem;
        margin-bottom: 0;
    }

    #btn_save_hotel {
        background-color: #452c88;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    #btn_save_hotel:hover {
        background-color: #331f66;
        transform: scale(1.05);
    }

    #btn_cancel_hotel {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    #btn_cancel_hotel:hover {
        transform: scale(1.05);
    }

    label {
        margin-bottom: 0px;
    }
</style>

<div class="content-wrapper py-0 my-2">
    <div style="border: none;">
        <div class="bg-white" style="border-radius: 20px;">
            <div class="p-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20" width="20">
                            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path d="M0 32C0 14.3 14.3 0 32 0L480 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l0 384c17.7 0 32 14.3 32 32s-14.3 32-32 32l-176 0 0-48c0-26.5-21.5-48-48-48s-48 21.5-48 48l0 48L32 512c-17.7 0-32-14.3-32-32s14.3-32 32-32L32 64C14.3 64 0 49.7 0 32zm96 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zM240 96c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zM112 192c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM328 384c13.3 0 24.3-10.9 21-23.8c-10.6-41.5-48.2-72.2-93-72.2s-82.5 30.7-93 72.2c-3.3 12.8 7.8 23.8 21 23.8l144 0z" fill="white" />
                        </svg>
                    </span>
                    <span>Hotel Booking</span>
                </h3>
            </div>
            <div class="container" id="home">
                <form action="{{ route('hotel.store') }}" id="formData" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{ isset($hotelbooking) ? $hotelbooking->id : '' }}">

                        <!-- Application ID -->
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="application_id">Applicant Name</label>
                            <select name="application_id" id="application_id" class="form-select">
                                <option disabled {{ isset($hotelbooking) ? '' : 'selected' }}>Select Applicant</option>
                                @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ isset($hotelbooking) && $hotelbooking->application_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                                @endforeach
                            </select>
                            <span id="application_id_error" class="error-message text-danger"></span>
                        </div>

                        <!-- Country -->
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-select">
                                <option disabled {{ isset($hotelbooking) ? '' : 'selected' }}>Select country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ isset($hotelbooking) && $hotelbooking->country_id == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                                @endforeach
                            </select>
                            <span id="country_id_error" class="error-message text-danger"></span>
                        </div>

                        <!-- Dates -->
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="s_date">Start Date</label>
                            <input type="date" name="s_date" id="s_date" class="form-control" value="{{ isset($hotelbooking) ? $hotelbooking->s_date : '' }}">
                            <span id="s_date_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="e_date">End Date</label>
                            <input type="date" name="e_date" id="e_date" class="form-control" value="{{ isset($hotelbooking) ? $hotelbooking->e_date : '' }}">
                            <span id="e_date_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="hotel_cancel_due_date">Hotel Cancellation Due Date</label>
                            <input type="date" name="hotel_cancel_due_date" id="hotel_cancel_due_date" class="form-control" value="{{ isset($hotelbooking) ? $hotelbooking->hotel_cancel_due_date : '' }}">
                            <span id="hotel_cancel_due_date_error" class="error-message text-danger"></span>
                        </div>

                        <!-- Hotel Details -->
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="name">Hotel Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ isset($hotelbooking) ? $hotelbooking->name : '' }}" placeholder="Enter hotel name">
                            <span id="name_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="reservation_id">Reservation ID</label>
                            <input type="text" name="reservation_id" id="reservation_id" class="form-control" value="{{ isset($hotelbooking) ? $hotelbooking->reservation_id : '' }}" placeholder="Enter Reservation ID">
                            <span id="reservation_id_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="reservation_email">Reservation Email</label>
                            <input type="email" name="reservation_email" id="reservation_email" class="form-control" value="{{ isset($hotelbooking) ? $hotelbooking->reservation_email : '' }}" placeholder="Enter reservation email">
                            <span id="reservation_email_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="status">Status</label>
                            <select name="status" id="status"    class="form-select">
                                @foreach ($status as $st )  
                                <option value="{{ $st->name }}" {{ isset($hotelbooking) && $hotelbooking->status == $st->name ? 'selected' : '' }}>{{ $st->name }}</option>

                                @endforeach
                            </select>

                            <span id="status_error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="row justify-content-end mt-2">
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                                <a href="/hotel" id="btn_cancel_hotel" class="btn btn-block btn-warning text-white" style="border-radius: 8px;">
                                    <span>Cancel</span>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-5">
                                <button type="submit" id="btn_save_hotel" class="btn btn-block text-white" style="border-radius: 8px;">
                                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">Submit</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</div>

<!-- viewlocation Modal End -->
@stop
@pushOnce('scripts')
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $("#formData").on("submit", function(e) {
            e.preventDefault(); // Prevent form submission

            let isValid = true; // Track overall form validity

            // Clear previous error messages
            $(".error-message").text("");

            // Validate Application ID
            if ($("#application_id").val() === null) {
                $("#application_id_error").text("Please select an application.");
                isValid = false;
            }

            // Validate Country
            if ($("#country_id").val() === null) {
                $("#country_id_error").text("Please select a country.");
                isValid = false;
            }

            // Validate Start Date
            if ($("#s_date").val() === "") {
                $("#s_date_error").text("Start date is required.");
                isValid = false;
            }

            // Validate End Date
            if ($("#e_date").val() === "") {
                $("#e_date_error").text("End date is required.");
                isValid = false;
            }

            // Validate Cancellation Due Date
            if ($("#hotel_cancel_due_date").val() === "") {
                $("#hotel_cancel_due_date_error").text("Cancellation due date is required.");
                isValid = false;
            }

            // Validate Hotel Name
            if ($("#name").val().trim() === "") {
                $("#name_error").text("Hotel name is required.");
                isValid = false;
            }

            // Validate Reservation
            if ($("#reservation_id").val().trim() === "") {
                $("#reservation_id_error").text("Please select a reservation.");
                isValid = false;
            }

            // Validate Reservation Email
            const email = $("#reservation_email").val().trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "") {
                $("#reservation_email_error").text("Reservation email is required.");
                isValid = false;
            } else if (!emailRegex.test(email)) {
                $("#reservation_email_error").text("Please enter a valid email.");
                isValid = false;
            }

            // Validate Status
            if ($("#status").val() === null) {
                $("#status_error").text("Please select a status.");
                isValid = false;
            }

            // Submit if all validations pass
            if (isValid) {
                this.submit(); // Submit the form
            }
        });
    });
</script>

@endPushOnce