@extends('layouts.main')
@section('title', 'Application')
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

  #btn_save_application {
    background-color: #452c88;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  #btn_save_application:hover {
    background-color: #331f66;
    transform: scale(1.05);
  }

  #btn_cancel_application {
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  #btn_cancel_application:hover {
    transform: scale(1.05);
  }

  label {
    margin-bottom: 0px !important;
  }

  #qoutedetail {
    backdrop-filter: blur(5px);
    background-color: #01223770;
  }

  .dataTables_filter {
    margin-bottom: 8px;
  }

  #filter_country,
  #filter_staff {
    border: 2px solid #452C88;
    border-radius: 8px;
    padding-left: 15px;
    height: 45px;
    font-size: 14px;
    transition: 0.3s ease;
  }

  #filter_country:focus,
  #filter_staff:focus {
    border-color: #331F66;
    box-shadow: 0 0 5px rgba(69, 44, 136, 0.6);
  }
</style>
@section('content')
@include('pages.application.detail_page_modal')

<div class="content-wrapper py-0 my-0">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title d-flex align-items-center">
          <span
            class="page-title-icon bg-gradient-primary text-white me-2 py-2 d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" width="24" height="24">
              <path
                d="M0 64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zM470.6 96H41.4L256 281.4 470.6 96zM464 144.6 273.9 306.7c-10.7 9.2-26.1 9.2-36.8 0L48 144.6V432H464V144.6z" />
            </svg>
          </span>
          <span>Application</span>
        </h3>

        <!-- <div class="col-lg-4"></div> -->
        <div class="row my-1 g-2 justify-content-start justify-content-md-end">
          <!-- Add Appointment Button -->
          <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-md-end justify-content-start ">
            <a href="{{ route('application.add') }}">
              <button class="btn add-btn text-white"
                style="background-color: #452C88; width: fit-content; padding-left: 10px; padding-right: 10px;">
                <span><i class="fa fa-plus me-2"></i>Add Application</span>
              </button>
            </a>
          </div>
          <!-- Search Input -->
          <div class="col-lg-6 col-md-6 col-sm-12">
            <input type="text" id="search_input" class="form-control w-100"
              placeholder="Search Applicant Name or Country Name" style="height: 45px;" />
          </div>
        </div>
        <hr>
        <div class="px-2">
          <div class="table-responsive">
            @if (Session::has('message'))
              <div class="alert alert-success col-lg-8 col-md-12 col-sm-12 ">
                <button type="button" class="close ml-2" data-dismiss="alert">&times;</button>
                <strong>{{ session('message') }}</strong>
              </div>
            @endif


            <table id="qoute-table" class="display" style="width:100%">


              <thead class="table-dark" style="background-color:rgba(69, 44, 136, 0.85);">
                <tr style="font-size: small;">
                  <th>#</th>
                  <th style="display:none;">Staff ID</th>
                  <th>Applicant Name</th>
                  <th>Country</th>
                  <th>Contact No</th>
                  <th>Submission Date</th>
                  <th>Visa Status</th>
                  <th>Internal Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody id="tableData">
                @foreach ($applications as $application)
                  <tr style="font-size: small;">
                    <td>{{ $loop->iteration ?? ''}} </td>
                    <td style="display:none;">{{ $application->client->staff_id ?? '' }}</td>

                    <td>
                      {{ $application->client ? $application->client->name . '~' . $application->client->sur_name : '' }}
                    </td>
                    <td>{{ $application->country->name ?? ''}}</td>
                    <td>{{ $application->client->contact_no ?? ''}}</td>
                    <td>{{ $application->submission_date }}</td>
                    <td>{{ $application->visa_status ?? ''}}</td>
                    <td>{{ $application->status ?? '' }}</td>

                    <td class="">
                      <div class="d-flex my-auto">
                        <!-- Edit Button -->
                        <a href="{{route('application.add', ['id' => $application->id])}}" class="btn p-0">
                          <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z"
                              fill="#233A85" />
                          </svg>
                        </a>

                        <!-- Delete Button -->
                        <a href="{{ route('application.delete', ['id' => $application->id]) }}" class="btn p-0">
                          <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                            <path d="M10 2L9 3H3V5H21V3H15L14 2H10ZM4.36523 7L6.06836 22H17.9316L19.6348 7H4.36523Z"
                              fill="#452C88" transform="translate(6, 6)" />
                          </svg>
                        </a>
                        <button data-id="{{ $application->id }}" id="quoteDetail_btn" class="btn p-0 quoteDetail_view"
                          data-toggle="modal" data-target="#qoutedetail">
                          <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                            <path
                              d="M17.7167 13C13.5 13 11 18 11 18C11 18 13.5 23 17.7167 23C21.8333 23 24.3333 18 24.3333 18C24.3333 18 21.8333 13 17.7167 13ZM17.6667 14.6667C19.5167 14.6667 21 16.1667 21 18C21 19.85 19.5167 21.3333 17.6667 21.3333C15.8333 21.3333 14.3333 19.85 14.3333 18C14.3333 16.1667 15.8333 14.6667 17.6667 14.6667ZM17.6667 16.3333C16.75 16.3333 16 17.0833 16 18C16 18.9167 16.75 19.6667 17.6667 19.6667C18.5833 19.6667 19.3333 18.9167 19.3333 18C19.3333 17.8333 19.2667 17.6833 19.2333 17.5333C19.1 17.8 18.8333 18 18.5 18C18.0333 18 17.6667 17.6333 17.6667 17.1667C17.6667 16.8333 17.8667 16.5667 18.1333 16.4333C17.9833 16.3833 17.8333 16.3333 17.6667 16.3333Z"
                              fill="#452c88" />
                          </svg>
                        </button>

                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

  @stop
@pushOnce('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#qoute-table').DataTable({
        dom: 'Bfrtip',
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100, 200],
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> Export Excel',
                className: 'btn-excel'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa-solid fa-file-pdf"></i> Export PDF',
                className: 'btn-pdf',
                orientation: 'landscape',
                exportOptions: { columns: [0, 2, 3, 4, 5, 6] } // Adjust columns if needed
            }
        ],
        initComplete: function () {
            // Add Country Filter
            $(".dt-buttons").append(`
                <select id="filter_country" class="form-control ms-2" style="height:38px; width:300px; display:inline-block;">
                    <option value="">Filter by Country</option>
                    @foreach($applications->pluck('country.name')->unique()->sort() as $countryName)
                        <option value="{{ strtolower($countryName) }}">{{ $countryName }}</option>
                    @endforeach
                </select>
            `);

            // Add Staff Filter if Super Admin
            @if(auth()->user()->role === 'Super Admin')
            $(".dt-buttons").append(`
                <select id="filter_staff" class="form-control ms-2" style="height:38px; width:200px; display:inline-block;">
                    <option value="">Filter by Staff</option>
                    @foreach(\App\Models\User::where('role', 'Staff')->get() as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                    @endforeach
                </select>
            `);
            @endif

            // Style buttons
            $('.btn-excel, .btn-pdf').css({
                'background': 'linear-gradient(135deg, #452C88, #452C88)',
                'color': '#fff',
                'border': 'none',
                'padding': '8px 14px',
                'border-radius': '6px',
                'font-weight': '600',
                'margin-right': '8px',
                'cursor': 'pointer',
                'box-shadow': '0 3px 6px rgba(0,0,0,0.1)',
                'transition': 'all 0.3s ease',
                'display': 'inline-flex',
                'align-items': 'center',
                'gap': '6px',
                'font-size': '14px'
            });
        }
    });

    // Custom filter: Country & Staff
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var selectedCountry = $('#filter_country').val();
        var selectedStaff = $('#filter_staff').val();

        var rowCountry = data[3] ? data[3].toLowerCase() : ''; // Column index for Country
        var rowStaffId = data[1]; // Column index for Staff ID (hidden)

        if (selectedCountry && rowCountry !== selectedCountry.toLowerCase()) {
            return false;
        }

        if (selectedStaff && rowStaffId != selectedStaff) {
            return false;
        }

        return true;
    });

    // Trigger redraw when filter changes
    $(document).on('change', '#filter_country, #filter_staff', function() {
        table.draw();
    });

    // Search input
    $('#search_input').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Quote Detail Modal
    $(document).on('click', '#quoteDetail_btn', function() {
        var applicationId = $(this).data('id');

        $.ajax({
            url: '/application/' + applicationId,
            method: 'GET',
            success: function(response) {
                $("#dob").text(response.detail_page.client.dob);
                $("#submission_date").text(response.detail_page.submission_date);
                $("#country").text(response.detail_page.country.name);
                $("#category").text(response.detail_page.category.name);
                $("#pass_no").text(response.detail_page.passport_no);
                $("#pass_exp_date").text(response.detail_page.passport_expiry);
                $("#visa_status").text(response.detail_page.visa_status);
                $("#visa_exp_date").text(response.detail_page.visa_expiry_date);
                $("#vsf_ref_no").text(response.detail_page.visa_refer_tracking_id);
                $("#ds_160").text(response.detail_page.ds_160);
                $("#quoteDetail_user").val(response.detail_page.client.name + '~' + response.detail_page.client.sur_name);

                $('#qoutedetail').modal('show');
            },
            error: function(error) {
                console.error('Error fetching application details:', error);
            }
        });
    });
});
</script>
@endPushOnce
