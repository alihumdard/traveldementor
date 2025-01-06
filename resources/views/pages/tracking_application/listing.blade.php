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
</style>
@section('content')
@include('pages.tracking_application.detail_page_modal')

<div class="content-wrapper py-0 my-0">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M5.46997 9C7.40297 9 8.96997 7.433 8.96997 5.5C8.96997 3.567 7.40297 2 5.46997 2C3.53697 2 1.96997 3.567 1.96997 5.5C1.96997 7.433 3.53697 9 5.46997 9Z"
                stroke="white" stroke-width="1.5" />
              <path
                d="M16.97 15H19.97C21.07 15 21.97 15.9 21.97 17V20C21.97 21.1 21.07 22 19.97 22H16.97C15.87 22 14.97 21.1 14.97 20V17C14.97 15.9 15.87 15 16.97 15Z"
                stroke="white" stroke-width="1.5" />
              <path
                d="M11.9999 5H14.6799C16.5299 5 17.3899 7.29 15.9999 8.51L8.00995 15.5C6.61995 16.71 7.47994 19 9.31994 19H11.9999"
                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M5.48622 5.5H5.49777" stroke="white" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M18.4862 18.5H18.4978" stroke="white" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </span>
          <span>Tracking Application</span>
        </h3>
        <div class="row mb-2 justify-content-end">
          <!-- Add Appointment Button -->
          <div class="col-lg-3 col-md-4 col-sm-12 my-2 text-md-right text-sm-center">
            <a href="{{ route('tracking.application.add') }}">
              <button class="btn add-btn text-white w-100" style="background-color: #452C88;">
                <span><i class="fa fa-plus mr-2"></i>Add Application</span>
              </button>
            </a>
          </div>

          <!-- Search Input -->
          <div class="col-lg-6 col-md-8 col-sm-12 my-2">
            <input type="text" id="search_input" class="form-control " placeholder="Search Name of Applicant/Country" style="height: 45px;" />
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
                  <th>Apply Date</th>
                  <th>Country Name</th>
                  <th>Applicant Name</th>
                  <th>Visa Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tableData">
                @foreach ($applications as $application )
                <tr style="font-size: small;">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ table_date($application->created_at) }}</td>
                  <td>{{ $application->country->name }}</td>
                  <td>{{ $application->client->name }}</td>
                  <td>{{ $application->visa_status }}</td>

                  <td class="">
                    <div class="d-flex my-auto">
                      <!-- Edit Button -->
                      <a href="{{route('tracking.application.add', ['id' => $application->id])}}" class="btn p-0">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z"
                            fill="#233A85" />
                        </svg>
                      </a>

                      <!-- Delete Button -->
                      <a href="{{ route('tracking.application.delete',['id' => $application->id]) }}" class="btn p-0">
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
</div>

@stop
@pushOnce('scripts')

<script>
   $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
    var searchValue = $('#search_input').val().toLowerCase(); 
    var column1 = data[2] ? data[2].toLowerCase() : ""; 
    var column5 = data[3] ? data[3].toLowerCase() : ""; 
    return column1.includes(searchValue) || column5.includes(searchValue);
});

$('#search_input').on('keyup', function () {
    users_table.draw(); 
});

// Initialize DataTable
var users_table = $('#qoute-table').DataTable({});


  $(document).on('click', '#quoteDetail_btn', function() {
    var applicationId = $(this).data('id');  // Get the ID associated with the clicked button
    console.log('Clicked tracking application ID:', applicationId); // Check the application ID

    $.ajax({
        url: '/tracking/application/' + applicationId,  // Your route to fetch application details
        method: 'GET',
        success: function(response) {
          console.log(response);
            $("#name").val(response.detail_page.client.name);
            $("#contact_no").text(response.detail_page.client.contact_no);
            $("#dob").text(response.detail_page.client.dob);
            $("#country").text(response.detail_page.country.name);
            $("#pass_no").text(response.detail_page.passport_no);
            $("#pass_exp_date").text(response.detail_page.passport_expiry);
            $("#visa_status").text(response.detail_page.visa_status);
            $("#visa_exp_date").text(response.detail_page.visa_expiry_date);
            $("#vsf_ref_no").text(response.detail_page.visa_refer_tracking_id);
            $("#ds_160").text(response.detail_page.ds_160);
            $('#qoutedetail').modal('show'); 
        },
        error: function(error) {
            console.error('Error fetching application details:', error);
        }
    });
});
</script>
@endPushOnce