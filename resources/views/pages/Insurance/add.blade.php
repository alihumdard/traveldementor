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

    #btn_save_insurance {
        background-color: #452c88;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    #btn_save_insurance:hover {
        background-color: #331f66;
        transform: scale(1.05);
    }

    #btn_cancel_insurance{
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    #btn_cancel_insurance:hover {
        transform: scale(1.05);
    }

    label {
        margin-bottom: 0px ;
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
                                <option value="xyz"> Select application</option>
                                <option value="">xyz</option>
                            </select>
                            <span id="application_id_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="country_id">Country</label>
                            <select required name="country_id" id="country_id" class="form-select">
                                <option value="xyz"> Select country</option>
                                <option value="xyz"> Pakistan</option>
                            </select>
                            <span id="country_id_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 " style="margin-bottom: 10px;">
                            <label for="plan_type">Plan type</label>
                            <select required name="plan_type" id="plan_type" class="form-select">
                                <option value="xyz">Select plan type</option>
                                <option value="xyz">xyz</option>
                            </select>
                            <span id="plan_type_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="s_date">Start date</label>
                            <input required type="date" name="s_date" id="s_date" class="form-control">
                            <span id="s_date_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="e_date">End date</label>
                            <input required type="date" name="e_date" id="e_date" class="form-control">
                            <span id="e_date_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="policy_no">Policy no</label>
                            <input required type="number" name="policy_no" id="policy_no" class="form-control">
                            <span id="policy_no_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="sale_date">Sale date</label>
                            <input required type="date" name="sale_date" id="sale_date" class="form-control">
                            <span id="sale_date_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="amount">Amount</label>
                            <input required type="number" name="amount" id="amount" class="form-control">
                            <span id="amount_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="payable_after_40_per">Payable after 40%</label>
                            <input required type="number" name="payable_after_40_per" id="payable_after_40_per" class="form-control">
                            <span id="payable_after_40_per_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="net_payable">Net payable</label>
                            <input required type="number" name="net_payable" id="net_payable" class="form-control">
                            <span id="net_payable_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="refund_applied" style="margin-bottom:10px;">Refund Applied</label>
                            <div>
                                <input required type="radio" name="refund_applied" id="refund_applied_yes" value="yes">
                                <label for="refund_applied_yes">Yes</label>
                                <input required type="radio" name="refund_applied" id="refund_applied_no" value="no" style="margin-left: 10px;">
                                <label for="refund_applied_no">No</label>
                            </div>
                            <span id="refund_applied_error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="row justify-content-end mt-2  ">
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-3 mb-lg-4 ">
                                <a href="/insurance" id="btn_cancel_insurance"
                                    class="btn btn-block btn-warning text-white" style="border-radius: 8px;">
                                    <span>@lang('Cancel')</span>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                                <button type="submit" id="btn_save_insurance" class="btn btn-block  text-white"
                                    style="border-radius: 8px;">
                                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">@lang('Save')</span>
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