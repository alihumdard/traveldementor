@extends('layouts.main')
@section('title', 'Appointment Appointment')
@section('content')
@include('pages.appointment.pending.detail_page_modal')
<div class="content-wrapper py-0 my-0">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title d-flex align-items-center">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2 d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300" fill="white" width="24" height="24">
              <path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z" />
            </svg>
          </span>
          <span>Appointment</span>
        </h3>
        <div class="row mb-2 g-2 justify-content-start justify-content-md-end">
          <!-- Add Appointment Button -->
          <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-md-end justify-content-start ">
            <a href="{{ route('pending.appointment.add') }}">
              <button class="btn add-btn text-white" style="background-color: #452C88; width: fit-content; padding-left: 10px; padding-right: 10px;">
                <span><i class="fa fa-plus me-2"></i>Add Appointment</span>
              </button>
            </a>
          </div>
          <!-- Search Input -->
          <div class="col-lg-6 col-md-6 col-sm-12">
            <input
              type="text" id="search_input" class="form-control w-100" placeholder="Search Applicant Name or Country Name" style="height: 45px;" />
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
              <thead class="table-dark" style="background-color:rgba(69, 44, 136, 0.86);">
                <tr style="font-size: small;">
                  <th>#</th>
                  <th>Applicant Name</th>
                  <th>Country</th>
                  <th>No of application</th>
                  <th>Category</th>
                  <th>VFS Embassy</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody id="tableData">
                @foreach ($appointments as $appointment)
                <tr style="font-size: small;">
                  <td>{{ $loop->iteration ??'N/A' }}</td>
                  <td>{{ $appointment->client ? $appointment->client->name .'~'. $appointment->client->sur_name : 'N/A' }}</td>
                  <td>{{ $appointment->country->name ??'N/A'}} </td>
                  <td>{{ $appointment->no_application ??'N/A' }}</td>
                  <td>{{ $appointment->category->name ??'N/A'}}</td>
                  <td>{{ $appointment->vfsembassy->name ??'N/A'}}</td>
                  <td class="">
                    <div class="d-flex my-auto">
                      <!-- Edit Button -->
                      <a href="{{route('pending.appointment.add',['id' => $appointment->id])}}" class="btn p-0">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z" fill="#233A85" />
                        </svg>
                      </a>

                      <!-- Delete Button -->
                      <a href="{{ route('pending.appointment.delete',['id' => $appointment->id]) }}" class="btn p-0">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                          <path d="M10 2L9 3H3V5H21V3H15L14 2H10ZM4.36523 7L6.06836 22H17.9316L19.6348 7H4.36523Z" fill="#452C88" transform="translate(6, 6)" />
                        </svg>
                      </a>

                      <!-- Quote Detail Button -->
                      <button data-id="{{ $appointment->id }}" id="pending_btn" class="btn p-0 quoteDetail_view" data-toggle="modal" data-target="#qoutedetail">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                          <path d="M17.7167 13C13.5 13 11 18 11 18C11 18 13.5 23 17.7167 23C21.8333 23 24.3333 18 24.3333 18C24.3333 18 21.8333 13 17.7167 13ZM17.6667 14.6667C19.5167 14.6667 21 16.1667 21 18C21 19.85 19.5167 21.3333 17.6667 21.3333C15.8333 21.3333 14.3333 19.85 14.3333 18C14.3333 16.1667 15.8333 14.6667 17.6667 14.6667ZM17.6667 16.3333C16.75 16.3333 16 17.0833 16 18C16 18.9167 16.75 19.6667 17.6667 19.6667C18.5833 19.6667 19.3333 18.9167 19.3333 18C19.3333 17.8333 19.2667 17.6833 19.2333 17.5333C19.1 17.8 18.8333 18 18.5 18C18.0333 18 17.6667 17.6333 17.6667 17.1667C17.6667 16.8333 17.8667 16.5667 18.1333 16.4333C17.9833 16.3833 17.8333 16.3333 17.6667 16.3333Z" fill="#452c88" />
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
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
    var searchValue = $('#search_input').val().toLowerCase();
    var column1 = data[1] ? data[1].toLowerCase() : "";
    var column5 = data[2] ? data[2].toLowerCase() : "";
    return column1.includes(searchValue) || column5.includes(searchValue);
  });
  $('#search_input').on('keyup', function() {
    users_table.draw();
  });
  // Initialize DataTable
  var users_table = $('#qoute-table').DataTable({});
</script>
<script>
  var users_table = $('#qoute-table').DataTable();
  $('#filter_by_sts_qoute').on('change', function() {
    var selectedStatus = $(this).val();
    users_table.column(6).search(selectedStatus).draw();
  });
  $('#filter_by_loc').on('change', function() {
    var selectedLocation = $(this).val();
    users_table.column(4).search(selectedLocation).draw();
  });
</script>

<script>
  var users_table = $('#qoute-table').DataTable();
  $('#filter_by_sts_qoute').on('change', function() {
    var selectedStatus = $(this).val();
    users_table.column(5).search(selectedStatus).draw();
  });
  $('#filter_by_loc').on('change', function() {
    var selectedLocation = $(this).val();
    users_table.column(3).search(selectedLocation).draw();
  });
</script>

<script>
  $(document).on('click', '#pending_btn', function() {
    var appointmentId = $(this).data('id');
    // console.log('Clicked application ID:', appointmentId); 
    $.ajax({
      url: '/appointment/pending/' + appointmentId,
      method: 'GET',
      success: function(response) {
        console.log(response);
        $("#name").val(response.detail_page.client.name + '~' + response.detail_page.client.sur_name);
        $("#country").text(response.detail_page.country.name);
        $("#category").text(response.detail_page.category.name);
        $("#vfs_emb").text(response.detail_page.vfsembassy.name);
        $("#no_application").text(response.detail_page.no_application);
        $("#pay_mod").text(response.detail_page.payment_mode);
        $("#status").text(response.detail_page.status);
        $('#qoutedetail').modal('show'); // Show the modal with updated details
      },
      error: function(error) {
        console.error('Error fetching application details:', error);
      }
    });
  });
</script>
@endPushOnce