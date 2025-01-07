@extends('layouts.main')
@section('title', 'Pending Appoinment')
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

    #btn_save_appointment {
        background-color: #452c88;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    #btn_save_appointment:hover {
        background-color: #331f66;
        transform: scale(1.05);
    }

    #btn_cancel_appointment {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    #btn_cancel_appointment:hover {
        transform: scale(1.05);
    }
    label{
        margin-bottom: 0px !important;
    }
</style>

<div class="content-wrapper py-0 my-2">
    <div style="border: none;">
        <div class="bg-white" style="border-radius: 20px;">
            <div class="p-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.6667 0H3.33333C2.44928 0 1.60143 0.35119 0.976311 0.976311C0.35119 1.60143 0 2.44928 0 3.33333V16.6667C0 17.5507 0.35119 18.3986 0.976311 19.0237C1.60143 19.6488 2.44928 20 3.33333 20H16.6667C17.5507 20 18.3986 19.6488 19.0237 19.0237C19.6488 18.3986 20 17.5507 20 16.6667V3.33333C20 2.44928 19.6488 1.60143 19.0237 0.976311C18.3986 0.35119 17.5507 0 16.6667 0ZM17.7778 16.6667C17.7778 16.9614 17.6607 17.244 17.4523 17.4523C17.244 17.6607 16.9614 17.7778 16.6667 17.7778H3.33333C3.03865 17.7778 2.75603 17.6607 2.54766 17.4523C2.33929 17.244 2.22222 16.9614 2.22222 16.6667V3.33333C2.22222 3.03865 2.33929 2.75603 2.54766 2.54766C2.75603 2.33929 3.03865 2.22222 3.33333 2.22222H16.6667C16.9614 2.22222 17.244 2.33929 17.4523 2.54766C17.6607 2.75603 17.7778 3.03865 17.7778 3.33333V16.6667Z"
                                fill="white" />
                            <path
                                d="M13.3333 8.88888H11.1111V6.66665C11.1111 6.37197 10.994 6.08935 10.7857 5.88098C10.5773 5.67261 10.2947 5.55554 9.99999 5.55554C9.7053 5.55554 9.42269 5.67261 9.21431 5.88098C9.00594 6.08935 8.88888 6.37197 8.88888 6.66665V8.88888H6.66665C6.37197 8.88888 6.08935 9.00594 5.88098 9.21431C5.67261 9.42269 5.55554 9.7053 5.55554 9.99999C5.55554 10.2947 5.67261 10.5773 5.88098 10.7857C6.08935 10.994 6.37197 11.1111 6.66665 11.1111H8.88888V13.3333C8.88888 13.628 9.00594 13.9106 9.21431 14.119C9.42269 14.3274 9.7053 14.4444 9.99999 14.4444C10.2947 14.4444 10.5773 14.3274 10.7857 14.119C10.994 13.9106 11.1111 13.628 11.1111 13.3333V11.1111H13.3333C13.628 11.1111 13.9106 10.994 14.119 10.7857C14.3274 10.5773 14.4444 10.2947 14.4444 9.99999C14.4444 9.7053 14.3274 9.42269 14.119 9.21431C13.9106 9.00594 13.628 8.88888 13.3333 8.88888Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>Pending Appointment</span>
                </h3>
            </div>
            <div class="container" id="home">
                <form action="{{ route('pending.appointment.store') }}" id="formData" method="post">
                    <div class="row">
                        @csrf
                        <input type="hidden" id="appointment_id" name="id" value="{{ isset($appointment) ? $appointment->id : '' }}">
                        <input type="hidden" name="appointment_type" value="pending">
                        
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="application_id">Applicant Name</label>
                            <select name="application_id" id="application_id" class="form-select">
                                <option disabled selected> Select Applicant</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ isset($appointment) && $appointment->application_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <span id="application_id_error" class="error-message text-danger"></span>
                        </div>
                
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-select">
                                <option disabled selected> Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ isset($appointment) && $appointment->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <span id="country_id_error" class="error-message text-danger"></span>
                        </div>
                
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="vfs_embassy_id">VFS Embassy</label>
                            <select name="vfs_embassy_id" id="vfs_embassy_id" class="form-select">
                                <option disabled selected>Select Vfs Embassy</option>
                                @foreach ($vfsembasses as $vfsembassy)
                                    <option value="{{ $vfsembassy->id }}" {{ isset($appointment) && $appointment->vfs_embassy_id == $vfsembassy->id ? 'selected' : '' }}>{{ $vfsembassy->name }}</option>
                                @endforeach
                            </select>
                            <span id="vfs_embassy_id_error" class="error-message text-danger"></span>
                        </div>
                
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($appointment) && $appointment->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span id="category_id_error" class="error-message text-danger"></span>
                        </div>
                
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="no_application">No of Applicants</label>
                            <input type="number" name="no_application" id="no_application" class="form-control" value="{{ isset($appointment) ? $appointment->no_application : '' }}" placeholder="Enter No of Applicants">
                            <span id="no_application_error" class="error-message text-danger"></span>
                        </div>
                
    
                
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="Inprocess" {{ isset($appointment) && $appointment->status == 'Inprocess' ? 'selected' : '' }}>Inprocess</option>
                                <option value="Done" {{ isset($appointment) && $appointment->status == 'Done' ? 'selected' : '' }}>Done</option>
                            </select>
                            <span id="status_error" class="error-message text-danger"></span>
                        </div>
                
                        
                    </div>
                
                    <div class="mt-3">
                        <div class="row justify-content-end mt-2">
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-3 mb-lg-4">
                                <a href="/appointment/pending" id="btn_cancel_appointment" class="btn btn-block btn-warning text-white" style="border-radius: 8px;">
                                    <span>Cancel</span>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                                <button type="submit" id="btn_save_appointment" class="btn btn-block text-white" style="border-radius: 8px;">
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
<script>
$(document).ready(function () {
    $('#formData').on('submit', function (e) {
        e.preventDefault(); // Prevent form submission
        let isValid = true;

        // Clear previous error messages
        $('.error-message').text('');

        // Check each required field
        if ($('#application_id').val() === null || $('#application_id').val() === '') {
            $('#application_id_error').text('This field is required');
            isValid = false;
        }

        if ($('#country_id').val() === null || $('#country_id').val() === '') {
            $('#country_id_error').text('This field is required');
            isValid = false;
        }

        if ($('#vfs_embassy_id').val() === null || $('#vfs_embassy_id').val() === '') {
            $('#vfs_embassy_id_error').text('This field is required');
            isValid = false;
        }

        if ($('#category_id').val() === null || $('#category_id').val() === '') {
            $('#category_id_error').text('This field is required');
            isValid = false;
        }

        if ($('#no_application').val().trim() === '') {
            $('#no_application_error').text('This field is required');
            isValid = false;
        }

       

        if ($('#status').val() === null || $('#status').val() === '') {
            $('#status_error').text('This field is required');
            isValid = false;
        }

       
     
        // Submit the form if all fields are valid
        if (isValid) {
            this.submit();
        }
    });
});
</script>
@endPushOnce