@extends('layouts.main')
@section('title', 'Add DS160')
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
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.6667 0H3.33333C2.44928 0 1.60143 0.35119 0.976311 0.976311C0.35119 1.60143 0 2.44928 0 3.33333V16.6667C0 17.5507 0.35119 18.3986 0.976311 19.0237C1.60143 19.6488 2.44928 20 3.33333 20H16.6667C17.5507 20 18.3986 19.6488 19.0237 19.0237C19.6488 18.3986 20 17.5507 20 16.6667V3.33333C20 2.44928 19.6488 1.60143 19.0237 0.976311C18.3986 0.35119 17.5507 0 16.6667 0ZM17.7778 16.6667C17.7778 16.9614 17.6607 17.244 17.4523 17.4523C17.244 17.6607 16.9614 17.7778 16.6667 17.7778H3.33333C3.03865 17.7778 2.75603 17.6607 2.54766 17.4523C2.33929 17.244 2.22222 16.9614 2.22222 16.6667V3.33333C2.22222 3.03865 2.33929 2.75603 2.54766 2.54766C2.75603 2.33929 3.03865 2.22222 3.33333 2.22222H16.6667C16.9614 2.22222 17.244 2.33929 17.4523 2.54766C17.6607 2.75603 17.7778 3.03865 17.7778 3.33333V16.6667Z"
                                fill="white" />
                            <path
                                d="M13.3333 8.88888H11.1111V6.66665C11.1111 6.37197 10.994 6.08935 10.7857 5.88098C10.5773 5.67261 10.2947 5.55554 9.99999 5.55554C9.7053 5.55554 9.42269 5.67261 9.21431 5.88098C9.00594 6.08935 8.88888 6.37197 8.88888 6.66665V8.88888H6.66665C6.37197 8.88888 6.08935 9.00594 5.88098 9.21431C5.67261 9.42269 5.55554 9.7053 5.55554 9.99999C5.55554 10.2947 5.67261 10.5773 5.88098 10.7857C6.08935 10.994 6.37197 11.1111 6.66665 11.1111H8.88888V13.3333C8.88888 13.628 9.00594 13.9106 9.21431 14.119C9.42269 14.3274 9.7053 14.4444 9.99999 14.4444C10.2947 14.4444 10.5773 14.3274 10.7857 14.119C10.994 13.9106 11.1111 13.628 11.1111 13.3333V11.1111H13.3333C13.628 11.1111 13.9106 10.994 14.119 10.7857C14.3274 10.5773 14.4444 10.2947 14.4444 9.99999C14.4444 9.7053 14.3274 9.42269 14.119 9.21431C13.9106 9.00594 13.628 8.88888 13.3333 8.88888Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>DS160</span>
                </h3>
            </div>
            <div class="container" id="home">
                <form action="{{ route('ds.store') }}" id="formData" method="post">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset($ds160) ? $ds160->id : '' }}">
                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="application_id">Applicant Name</label>
                            <select name="application_id" id="application_id" class="form-select">
                                <option disabled> Select Application</option>
                                @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ isset($ds160) && $ds160->application_id ==
                                    $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <span id="application_id_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option disabled> Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($ds160) && $ds160->category_id ==
                                    $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span id="category_id_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="ds_160_create_date">DS160 Creation Date</label>
                            <input type="date" name="ds_160_create_date" id="ds_160_create_date" class="form-control"
                                value="{{ isset($ds160) ? $ds160->ds_160_create_date : '' }}">
                            <span id="ds_160_create_date_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="ds160">DS160</label>
                            <input type="text" name="ds160" id="ds160" class="form-control"
                                value="{{ isset($ds160) ? $ds160->ds160 : '' }}" placeholder="Enter the DS160">
                            <span id="ds160_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="revised_ds160">Revised DS160</label>
                            <input type="text" name="revised_ds160" id="revised_ds160" class="form-control"
                                value="{{ isset($ds160) ? $ds160->revised_ds160 : '' }}" placeholder="Enter the Revised DS160 ">
                            <span id="revised_ds160_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="surname">Surname</label>
                            <input type="text" name="surname" id="surname" class="form-control"
                                value="{{ isset($ds160) ? $ds160->surname : '' }}" placeholder="Enter the Surname ">
                            <span id="surname_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="year_of_birth">Year of Birth</label>
                            <input type="date" name="year_of_birth" id="year_of_birth" class="form-control"
                                value="{{ isset($ds160) ? $ds160->year_of_birth : '' }}">
                            <span id="year_of_birth_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="sec_question">Security Question</label>
                            <input type="text" name="sec_question" id="sec_question" class="form-control"
                                value="{{ isset($ds160) ? $ds160->sec_question : '' }}" placeholder="Enter the Security Question ">
                            <span id="sec_question_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="sec_answer">Security Answer</label>
                            <input type="text" name="sec_answer" id="sec_answer" class="form-control"
                                value="{{ isset($ds160) ? $ds160->sec_answer : '' }}" placeholder="Enter the Security Answer ">
                            <span id="sec_answer_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="us_travel_doc_email">Us Travel Doc Email</label>
                            <input type="email" name="us_travel_doc_email" id="us_travel_doc_email" class="form-control"
                                value="{{ isset($ds160) ? $ds160->us_travel_doc_email : '' }}" placeholder="Enter the Us Travel Doc Email ">
                            <span id="us_travel_doc_email_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="us_travel_doc_password">Us Travel Doc Password</label>
                            <input type="password" name="us_travel_doc_password" id="us_travel_doc_password"
                                class="form-control" value="{{ isset($ds160) ? $ds160->us_travel_doc_password : '' }}" placeholder="Enter the Us Travel Doc Password ">
                            <span id="us_travel_doc_password_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="us_travel_doc_updated_password">Us Travel Doc Updated Password</label>
                            <input type="password" name="us_travel_doc_updated_password"
                                id="us_travel_doc_updated_password" class="form-control"
                                value="{{ isset($ds160) ? $ds160->us_travel_doc_updated_password : '' }}" placeholder="Enter the Us Travel Doc Updated Password ">
                            <span id="us_travel_doc_updated_password_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="challan_created">Challan Created</label>
                            <select name="challan_created" id="challan_created" class="form-select">
                                <option value="yes" {{ isset($ds160) && $ds160->challan_created == 'yes' ? 'selected' :
                                    '' }}>Yes</option>
                                <option value="no" {{ isset($ds160) && $ds160->challan_created == 'no' ? 'selected' : ''
                                    }}>No</option>
                            </select>
                            <span id="challan_created_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="challan_submitted">Challan Submitted</label>
                            <select name="challan_submitted" id="challan_submitted" class="form-select">
                                <option value="yes" {{ isset($ds160) && $ds160->challan_submitted == 'yes' ? 'selected'
                                    : '' }}>Yes</option>
                                <option value="no" {{ isset($ds160) && $ds160->challan_submitted == 'no' ? 'selected' :
                                    '' }}>No</option>
                            </select>
                            <span id="challan_submitted_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="payment_mode">Payment Mode</label>
                            <select name="payment_mode" id="payment_mode" class="form-select">
                                <option value="online" {{ isset($ds160) && $ds160->payment_mode == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="cash" {{ isset($ds160) && $ds160->payment_mode == 'cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                            <span id="payment_mode_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="transaction_date">Transcation Date</label>
                            <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                                value="{{ isset($ds160) ? $ds160->transaction_date : '' }}">
                            <span id="transaction_date_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="appoint_date">Appointment Date</label>
                            <input type="date" name="appoint_date" id="appoint_date" class="form-control"
                                value="{{ isset($ds160) ? $ds160->appoint_date : '' }}">
                            <span id="appoint_date_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="appoint_reschedule">Appointment Reschedule</label>
                            <input type="date" name="appoint_reschedule" id="appoint_reschedule" class="form-control"
                                value="{{ isset($ds160) ? $ds160->appoint_reschedule : '' }}">
                            <span id="appoint_reschedule_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="pick_up_location">Pick up Location</label>
                            <select name="pick_up_location" id="pick_up_location" class="form-select">
                                <option disabled>Pick location</option>
                                <option value="islamabad" {{ isset($ds160) && $ds160->pick_up_location == 'islamabad' ?
                                    'selected' : '' }}>Islamabad</option>
                                <option value="lahore" {{ isset($ds160) && $ds160->pick_up_location == 'lahore' ?
                                    'selected' : '' }}>Lahore</option>
                                <option value="karachi" {{ isset($ds160) && $ds160->pick_up_location == 'karachi' ?
                                    'selected' : '' }}>Karachi</option>
                            </select>
                            <span id="pick_up_location_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="premium_delivery">Premium Delivery</label>
                            <select name="premium_delivery" id="premium_delivery" class="form-select">
                                <option value="yes" {{ isset($ds160) && $ds160->premium_delivery == 'yes' ? 'selected' :
                                    '' }}>Yes</option>
                                <option value="no" {{ isset($ds160) && $ds160->premium_delivery == 'no' ? 'selected' :
                                    '' }}>No</option>
                            </select>
                            <span id="premium_delivery_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12" style="margin-bottom: 10px;">
                            <label for="delivery_address">Delivery Address</label>
                            <textarea name="delivery_address" id="delivery_address" class="form-control" placeholder="Enter the Delivery Address ">{{  $ds160->delivery_address ?? ''}}</textarea>
                            <span id="delivery_address_error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="row justify-content-end mt-2  ">
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-3 mb-lg-4 ">
                                <a href="/ds" id="btn_cancel_hotel" class="btn btn-block btn-warning text-white"
                                    style="border-radius: 8px;">
                                    <span>Cancel</span>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                                <button type="submit" id="btn_save_hotel" class="btn btn-block  text-white"
                                    style="border-radius: 8px;">
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

@stop
@pushOnce('scripts')
<script>
 $(document).ready(function() {
    $("#formData").submit(function(e) {
        let isValid = true;
        
        // Clear previous error messages
        $(".error-message").text("");
        
        // Check each required field
        $("#formData input:not([type='hidden']), #formData select, #formData textarea").each(function() {
            if (!$(this).val()) {
                isValid = false;
                let fieldName = $(this).attr("id");
                $(`#${fieldName}_error`).text("This field is required");
            }
        });
        
        if(!isValid) {
            e.preventDefault();
        } else {
            $('#spinner').removeClass('d-none');
            $('#text').addClass('d-none');
            this.submit();
        }
    });
});
</script>
@endPushOnce