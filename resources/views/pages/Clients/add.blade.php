@extends('layouts.main')
@section('title', 'Application')
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

    .custom-button {
        width: 100%;
        height: 36px;
        display: inline-block;
        background-color: #00a962;
        color: white;
        cursor: pointer;
        border: none;
        text-align: center;
        text-decoration: none;
        border-radius: 3px;
        padding: 6px;
    }

    .custom-button:hover {
        background-color: #00824b;
    }

    .custom-button:active {
        background-color: #00a962;
    }

    #addAddressModal .modal-header {
        padding: 0.5rem 1rem;
    }

    #addAddressModal .modal-title {
        font-size: 1rem;
        margin-bottom: 0;
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
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" />
                            <span id="name_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="sur_name">Surname</label>
                            <input type="text" name="sur_name" id="sur_name" class="form-control" placeholder="Enter your surname" />
                            <span id="sur_name_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="contact_no">Contact Number</label>
                            <input type="tel" name="contact_no" id="contact_no" class="form-control" placeholder="Enter your contact number" />
                            <span id="contact_no_error" class="error-message text-danger"></span>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control" />
                            <span id="dob_error" class="error-message text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
                            <label for="refer_person">Refer person</label>
                            <input type="text" name="refer_person" id="refer_person" class="form-control" />
                            <span id="refer_person_error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="row justify-content-end mt-2  ">
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-3 mb-lg-4 ">
                                <a href="/quotations" id="btn_cancel_quotation"
                                    class="btn btn-block btn-warning text-white" style="border-radius: 8px;">
                                    <span>Cancel</span>
                                </a>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                                <button type="submit" id="btn_save_quotation" class="btn btn-block  text-white"
                                    style="background-color: #184A45FF; border-radius: 8px;">
                                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">Save</span>
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
<script>
    var newRow = `
            <div class="row mt-md-3 mt-sm-3 mt-3">
                <div class="col-lg-1 col-md-12 col-sm-12 order-lg-last">
                    <label class="d-none d-lg-block">Remove</label>
                    <span class="fw-bold btn_removeRow btn btn-danger btn-block" > - </span>
                </div>
                <div class="col-lg-3 col-md-6  col-sm-12">
                    <label for="service_id">@lang('Service')</label>
                    <select required name="service_id[]"  class="form-select service_id">
                        <option disabled selected> Select @lang('quote service')</option>
                        @forelse($services as $key => $value)
                        <option value="" >
                            
                        </option>
                    
                    </select>
                    <span  class="error-message text-danger service_id_error"></span>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="q_amount">@lang('Service Aamount')</label>
                    <input required type="number" min="1" name="s_amount[]"  value="" placeholder="@lang('service amount')" class="form-control s_amount">
                    <span  class="error-message text-danger s_amount_error"></span>
                </div>

            </div>
            `;

    $(document).ready(function()

    $('#q_file').change(function() {
        var fileUploadedParagraph = $('.file-uploaded');
        if ($(this).prop('files').length > 0) {
            fileUploadedParagraph.removeClass('d-none');
            $('.previous-file').addClass('d-none');
        } else {
            fileUploadedParagraph.addClass('d-none');
        }
    });

    $('#btn_addNewRow').on('click', function() {
        $('#new_rowdata').append(newRow);
    });

    $(document).on('click', '.btn_removeRow', function() {
        $(this).closest('.row').fadeOut('slow', function() {
            $(this).remove();
        });
    });

    const maxLength = 250;
    const textarea = $('#q_desc');
    const charCountElement = $('#charCount');
    const charCountContainer = $('#charCountContainer');
    const submitButton = $('#btn_save_quotation'); textarea.on('input', function() {
        const currentLength = textarea.val().length;
        const charCount = Math.max(maxLength - currentLength);
        charCountElement.text(charCount);

        if (currentLength > 0) {
            charCountContainer.show();
        } else {
            charCountContainer.hide();
        }

        if (currentLength > maxLength) {
            const exceededCount = currentLength - maxLength;
            charCountElement.css('color', 'red');
            charCountElement.text(`Your limit exceeded by ${exceededCount} characters`);
            submitButton.prop('disabled', true);
        } else if (currentLength === maxLength) {
            charCountElement.css('color', ''); // Reset text color
            charCountElement.text(''); // Clear the message
            submitButton.prop('disabled', false);
        } else {
            charCountElement.css('color', ''); // Reset text color
            charCountElement.text(`${maxLength - currentLength}`);
            submitButton.prop('disabled', false);
        }
    });

    $('#btn_save_quotation').click(function(event) {
        var qDate = $('#q_date').val();
        var adminId = $('#admin_id').val();
        var userId = $('#user_id').val();
        var client_name = $('#client_name').val();
        var q_desc = $('#q_desc').val();
        var q_amount = $('#q_amount').val();
        var currency_code = $('#currency_code').val();
        var location = $('#location').val();
        var q_file = $('#q_file').val();
        var file_exists = $('#q_file').attr('data-file_exists');

        // Reset error messages
        $('.error-message text-danger').text('');
        var hasEmptyDropdown = false;
        var hasEmptyservice = false;

        $('.service_id_error').each(function() {
            var selectedValue = $(this).prev('.service_id').val();
            if (selectedValue === null || selectedValue === '') {
                $(this).text('*Please select a service.');
                hasEmptyDropdown = true;
            } else {
                $(this).text('');
            }
        });

        $('.s_amount_error').each(function() {
            var s_amount = $(this).prev('.s_amount').val();
            if (s_amount == null || s_amount == '') {
                $(this).text('*Please select a quote amount.');
                hasEmptyservice = true;
            } else {
                $(this).text('');
            }
        });

        if (hasEmptyDropdown) {
            event.preventDefault();
        }

        if (hasEmptyservice) {
            event.preventDefault();
        }

        if (qDate === '') {
            $('#q_date_error').text('*Please enter a quatation date.');
            event.preventDefault();
        }

        if (adminId === null) {
            $('#admin_id_error').text('*Please select a admin.');
            event.preventDefault();
        }

        if (userId === null) {
            $('#user_id_error').text('*Please select a user.');
            event.preventDefault();
        }

        if (client_name == '') {
            $('#client_name_error').text('*Please enter client name.');
            event.preventDefault();
        }

        if (q_desc == '') {
            $('#q_desc_error').text('*Please enter client description.');
            event.preventDefault();
        }

        if (q_amount == '') {
            $('#q_amount_error').text('*Please enter quoted ammount.');
            event.preventDefault();
        }

        if (currency_code === null) {
            $('#currency_code_error').text('*Please select a currency.');
            event.preventDefault();
        }

        if (location === null) {
            $('#location_error').text('*Please select a location.');
            event.preventDefault();
        }

        if (q_file == '' && file_exists == 'no') {
            $('#q_file_error').text('*Please select a qoute file.');
            event.preventDefault();
        }
    });


    $('.s_amount').on('input', function() {
        $('.s_amount_error').each(function() {
            var s_amount = $(this).prev('.s_amount').val();
            if (s_amount == null || s_amount == '') {
                $(this).text('*Please enter a quote amount.');
            } else {
                $(this).text('');
            }
        });
    });

    $('#q_date').on('input', function() {
        $('#q_date_error').text('');
    });

    $('#admin_id').on('input', function() {
        $('#admin_id_error').text('');
    });

    $('#user_id').on('change', function() {
        $('#user_id_error').text('');
    });

    $('#currency_code').on('change', function() {
        $('#currency_code_error').text('');
    });

    $('#q_file').on('change', function() {
        $('#q_file_error').text('');
        $('.previous-file').addClass('d-none');
    });

    $('#service_id').on('change', function() {
        $('#service_id_error').text('');
    });

    $('#q_amount').on('input', function() {
        $('#q_amount_error').text('');
    });

    $('#client_name').on('input', function() {
        $('#client_name_error').text('');
    });

    $('#q_desc').on('input', function() {
        $('#q_desc_error').text('');
    });

    $('#location').on('change', function() {
        $('#location_error').text('');
    });

    });

    function getUsers(adminId) {
        $.ajax({
            url: '/get_users/' + adminId,
            type: 'GET',
            success: function(response) {
                var users = response;
                var options = '';
                users.forEach(function(user) {
                    options += '<option value="' + user.id + '">' + user.name + '</option>';
                });
                if (options) {
                    $('#user_id_error').text('');
                    $('#user_id').html(options);
                } else {
                    $('#user_id_error').text('*admin do not have any user.');
                    $('#user_id').html('');
                }
            },
            error: function(xhr, status, error) {
                // Handle the error
            }
        });
    }
</script>
@endPushOnce