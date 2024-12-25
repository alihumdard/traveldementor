@extends('layouts.main')
@section('title', 'Appoinment')
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
                    <span></span>
                </h3>
            </div>
            <div class="container" id="home">
                <form action="quotationStore" id="formData" method="post">
                    <div class="row">
                        @csrf
                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="application_id">Application</label>
                            <select required name="application_id" id="application_id" class="form-select">
                                <option disabled selected> Select application</option>
                                <option value="">xyz</option>
                            </select>
                            <span id="application_id_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="country_id">Country</label>
                            <select required name="country_id" id="country_id" class="form-select">
                                <option disabled selected> Select country</option>
                                <option value=""> Pakistan</option>
                            </select>
                            <span id="country_id_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="vfs_embassy_id">Vfs embassy</label>
                            <select required name="vfs_embassy_id" id="vfs_embassy_id" class="form-select">
                                <option disabled selected>Select vfs embassy id</option>
                                <option value="">Pakistan</option>
                            </select>
                            <span id="vfs_embassy_id_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 "style="margin-bottom: 10px;">
                            <label for="category_id">Category</label>
                            <select required name="category_id" id="category_id" class="form-select">
                                <option disabled selected>Select category</option>
                                <option value="">Pakistan</option>
                            </select>
                            <span id="category_id_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="no_application">Application Number</label>
                            <input required type="number" name="no_application" id="no_application" class="form-control">
                            <span id="no_application_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="appointment_type">Appointment type</label>
                            <select required name="appointment_type" id="appointment_type" class="form-select">
                                <option disabled selected>Pending</option>
                                <option value="">Scheduled</option>
                            </select>
                            <span id="appointment_type_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="applicant_contact">Applicant contact</label>
                            <input required type="tel" name="applicant_contact" id="applicant_contact" class="form-control"
                                placeholder="Enter phone number">
                            <span id="applicant_contact_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="appointment_email">Appointment email</label>
                            <input required type="email" name="appointment_email" id="appointment_email" class="form-control"
                                placeholder="Enter your email">
                            <span id="appointment_email_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="appointment_contact_no">Appointment contact</label>
                            <input required type="tel" name="appointment_contact_no" id="appointment_contact_no" class="form-control"
                                placeholder="Enter phone number">
                            <span id="appointment_contact_no_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="vfs_appointment_refers">Vfs appointment refers</label>
                            <input required type="text" name="vfs_appointment_refers" id="vfs_appointment_refers" class="form-control"
                                placeholder="Enter vfs appointment refers">
                            <span id="vfs_appointment_refers_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="payment_mode">Payment mode</label>
                            <select required name="payment_mode" id="payment_mode" class="form-select">
                                <option disabled selected>Debit card</option>
                                <option value="">Credit card</option>
                            </select>
                            <span id="payment_mode_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="transcation_date">Transcation date</label>
                            <input required type="date" name="transcation_date" id="transcation_date" class="form-control">
                            <span id="transcation_date_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="bio_metric_appointment_date">Biometeric appointment date</label>
                            <input required type="date" name="bio_metric_appointment_date" id="bio_metric_appointment_date" class="form-control">
                            <span id="bio_metric_appointment_date_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="appointment_reschedule">Appointment reschedule</label>
                            <input required type="date" name="appointment_reschedule" id="appointment_reschedule" class="form-control">
                            <span id="appointment_reschedule_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="appointment-refer-no">Appointment refer no</label>
                            <input required type="number" name="appointment-refer-no" id="appointment-refer-no" class="form-control">
                            <span id="appointment-refer-no_error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="row justify-content-end mt-2  ">
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-3 mb-lg-4 ">
                                <a href="/quotations" id="btn_cancel_appointment"
                                    class="btn btn-block btn-warning text-white" style="border-radius: 8px;">
                                    <span>@lang('Cancel')</span>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                                <button type="submit" id="btn_save_appointment" class="btn btn-block  text-white"
                                    style="border-radius: 8px;">
                                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('Save Appointment')</span>
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
@pushOnce('script')

@endPushOnce