@extends('layouts.main')
@section('title', 'Hotel Booking')
<style>
  table th,
  table td {
    text-transform: capitalize;
  }
</style>
@section('content')
@include('pages.hotelbooking.detail_page_modal')
<div class="content-wrapper py-0 my-0">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" width="24" height="24">
              <path d="M0 32C0 14.3 14.3 0 32 0L480 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l0 384c17.7 0 32 14.3 32 32s-14.3 32-32 32l-176 0 0-48c0-26.5-21.5-48-48-48s-48 21.5-48 48l0 48L32 512c-17.7 0-32-14.3-32-32s14.3-32 32-32L32 64C14.3 64 0 49.7 0 32zm96 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zM240 96c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zM112 192c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM328 384c13.3 0 24.3-10.9 21-23.8c-10.6-41.5-48.2-72.2-93-72.2s-82.5 30.7-93 72.2c-3.3 12.8 7.8 23.8 21 23.8l144 0z" />
            </svg>
          </span>
          <span>Hotel Booking</span>
        </h3>
        <div class="row mb-2">
          <!-- <div class="col-lg-4"></div> -->
          <div class="col-lg-12">
            <div class="row mx-1">
              <div class="col-lg-6 col-md-12 col-sm-12 my-2 pr-0" style="text-align: right;">
                <a href="{{ route('hotel.add') }}">
                  <button class="btn add-btn text-white" style="background-color: #452C88;"><span><i
                        class="fa fa-plus"></i>Add Booking</span></button>
                </a>
              </div>
              <div class="col-lg-3  col-md-6 col-sm-12 pr-0 my-2">
                <div class="input-group">
                  <div class="input-group-prepend d-none d-md-block d-sm-block d-lg-block">
                    <div class="input-group-text bg-white" style="border-right: none; border: 1px solid #DDDDDD;">
                      <svg width="11" height="15" viewBox="0 0 11 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.56221 14.0648C7.58971 14.3147 7.52097 14.5814 7.36287 14.7563C7.29927 14.8336 7.22373 14.8949 7.14058 14.9367C7.05742 14.9785 6.96827 15 6.87825 15C6.78822 15 6.69907 14.9785 6.61592 14.9367C6.53276 14.8949 6.45722 14.8336 6.39363 14.7563L3.63713 11.4151C3.56216 11.3263 3.50516 11.2176 3.47057 11.0977C3.43599 10.9777 3.42477 10.8496 3.43779 10.7235V6.45746L0.145116 1.34982C0.0334875 1.17612 -0.0168817 0.955919 0.005015 0.737342C0.0269117 0.518764 0.119294 0.319579 0.261975 0.183308C0.392582 0.0666576 0.536937 0 0.688166 0H10.3118C10.4631 0 10.6074 0.0666576 10.738 0.183308C10.8807 0.319579 10.9731 0.518764 10.995 0.737342C11.0169 0.955919 10.9665 1.17612 10.8549 1.34982L7.56221 6.45746V14.0648ZM2.09047 1.66644L4.81259 5.88254V10.4819L6.1874 12.1484V5.8742L8.90953 1.66644H2.09047Z"
                          fill="#323C47" />
                      </svg>
                    </div>
                  </div>
                  <select name="filter_by_loc" id="filter_by_loc" class="form-select select-group">
                    <option value="">
                      Filter By Location
                    </option>

                    <option value="">jjj</option>

                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 pr-0 my-2">
                <div class="input-group">
                  <div class="input-group-prepend d-none d-md-block d-sm-block d-lg-block">
                    <div class="input-group-text bg-white" style="border-right: none; border: 1px solid #DDDDDD;">
                      <svg width="11" height="15" viewBox="0 0 11 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.56221 14.0648C7.58971 14.3147 7.52097 14.5814 7.36287 14.7563C7.29927 14.8336 7.22373 14.8949 7.14058 14.9367C7.05742 14.9785 6.96827 15 6.87825 15C6.78822 15 6.69907 14.9785 6.61592 14.9367C6.53276 14.8949 6.45722 14.8336 6.39363 14.7563L3.63713 11.4151C3.56216 11.3263 3.50516 11.2176 3.47057 11.0977C3.43599 10.9777 3.42477 10.8496 3.43779 10.7235V6.45746L0.145116 1.34982C0.0334875 1.17612 -0.0168817 0.955919 0.005015 0.737342C0.0269117 0.518764 0.119294 0.319579 0.261975 0.183308C0.392582 0.0666576 0.536937 0 0.688166 0H10.3118C10.4631 0 10.6074 0.0666576 10.738 0.183308C10.8807 0.319579 10.9731 0.518764 10.995 0.737342C11.0169 0.955919 10.9665 1.17612 10.8549 1.34982L7.56221 6.45746V14.0648ZM2.09047 1.66644L4.81259 5.88254V10.4819L6.1874 12.1484V5.8742L8.90953 1.66644H2.09047Z"
                          fill="#323C47" />
                      </svg>
                    </div>
                  </div>
                  <select name="filter_by_sts" id="filter_by_sts_qoute" class="form-select select-group">
                    <option value="">
                      Filter By Status
                    </option>

                    <option value="">iiii</option>

                  </select>
                </div>
              </div>
            </div>
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
              <thead class="table-dark" style="background-color: #5F4A99;">
                <tr style="font-size: small;">
                  <th>#</th>
                  <th>Name of Applicant</th>
                  <th>Country</th>
                  <th>Hotel Name</th>
                  <th>Start Date</th>
                  <th>Status</th>
                  <th>actions</th>
                </tr>
              </thead>
              <tbody id="tableData">
                @foreach ($hotel_bookings as $booking )
                <tr style="font-size: small;">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $booking->client->name}}</td>
                  <td>{{ $booking->country->name }}</td>
                  <td>{{ $booking->name }}</td>
                  <td>{{ $booking->s_date }}</td>
                  @if($booking->status == 'active')
                  <td>
                    <button class="btn btn_status">
                      <span>
                        <div
                          style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 19px; padding-right: 20px; background: rgba(48.62, 165.75, 19.34, 0.18); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="color: #31A613; font-size: 14px; font-weight: 500; word-wrap: break-word">
                            Active
                          </div>
                        </div>
                      </span>
                    </button>
                  </td>
                  @elseif($booking->status == 'paid')
                  <td>
                    <button class="btn btn_status">
                      <span>
                        <div
                          style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 19px; padding-right: 20px; background: rgba(34, 139, 34, 0.18); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="color: #511cb9; font-size: 14px; font-weight: 500; word-wrap: break-word">
                            Paid
                          </div>
                        </div>
                      </span>
                    </button>
                  </td>
                  @else
                  <td>
                    <button class="btn btn_status">
                      <span>
                        <div
                          style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 19px; padding-right: 20px; background: rgba(255, 0, 0, 0.18); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                          <div style="color: #FF0000; font-size: 14px; font-weight: 500; word-wrap: break-word">
                            Cancelled
                          </div>
                        </div>
                      </span>
                    </button>
                  </td>
                  @endif

                  <td>
                    <div class="d-flex my-auto">
                      <!-- Edit Button -->
                      <a href="{{route('hotel.add',['id'=>$booking->id])}}" class="btn p-0">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z"
                            fill="#233A85" />
                        </svg>
                      </a>

                      <!-- Delete Button -->
                      <a href="{{route('hotel.delete',['id'=>$booking->id])}}" class="btn p-0">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                          <path d="M10 2L9 3H3V5H21V3H15L14 2H10ZM4.36523 7L6.06836 22H17.9316L19.6348 7H4.36523Z"
                            fill="#452C88" transform="translate(6, 6)" />
                        </svg>
                      </a>

                      <!-- Quote Detail Button -->
                      <button data-id="{{$booking->id }}" id="booking_btn" class="btn p-0 quoteDetail_view"
                        data-toggle="modal" data-target="#qoutedetail">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
<<<<<<< HEAD
                          <<<<<<< HEAD
                            <path
                            d="M17.7167 13C13.5 13 11 18 11 18C11 18 13.5 23 17.7167 23C21.8333 23 24.3333 18 24.3333 18C24.3333 18 21.8333 13 17.7167 13ZM17.6667 14.6667C19.5167 14.6667 21 16.1667 21 18C21 19.85 19.5167 21.3333 17.6667 21.3333C15.8333 21.3333 14.3333 19.85 14.3333 18C14.3333 16.1667 15.8333 14.6667 17.6667 14.6667ZM17.6667 16.3333C16.75 16.3333 16 17.0833 16 18C16 18.9167 16.75 19.6667 17.6667 19.6667C18.5833 19.6667 19.3333 18.9167 19.3333 18C19.3333 17.8333 19.2667 17.6833 19.2333 17.5333C19.1 17.8 18.8333 18 18.5 18C18.0333 18 17.6667 17.6333 17.6667 17.1667C17.6667 16.8333 17.8667 16.5667 18.1333 16.4333C17.9833 16.3833 17.8333 16.3333 17.6667 16.3333Z"
                            fill="#452C88" />
                          =======
                          <path d="M17.7167 13C13.5 13 11 18 11 18C11 18 13.5 23 17.7167 23C21.8333 23 24.3333 18 24.3333 18C24.3333 18 21.8333 13 17.7167 13ZM17.6667 14.6667C19.5167 14.6667 21 16.1667 21 18C21 19.85 19.5167 21.3333 17.6667 21.3333C15.8333 21.3333 14.3333 19.85 14.3333 18C14.3333 16.1667 15.8333 14.6667 17.6667 14.6667ZM17.6667 16.3333C16.75 16.3333 16 17.0833 16 18C16 18.9167 16.75 19.6667 17.6667 19.6667C18.5833 19.6667 19.3333 18.9167 19.3333 18C19.3333 17.8333 19.2667 17.6833 19.2333 17.5333C19.1 17.8 18.8333 18 18.5 18C18.0333 18 17.6667 17.6333 17.6667 17.1667C17.6667 16.8333 17.8667 16.5667 18.1333 16.4333C17.9833 16.3833 17.8333 16.3333 17.6667 16.3333Z" fill="black" />
                          >>>>>>> 28a10e396eb602c685c632a937ae3157df3727c1
=======

                          <path
                            d="M17.7167 13C13.5 13 11 18 11 18C11 18 13.5 23 17.7167 23C21.8333 23 24.3333 18 24.3333 18C24.3333 18 21.8333 13 17.7167 13ZM17.6667 14.6667C19.5167 14.6667 21 16.1667 21 18C21 19.85 19.5167 21.3333 17.6667 21.3333C15.8333 21.3333 14.3333 19.85 14.3333 18C14.3333 16.1667 15.8333 14.6667 17.6667 14.6667ZM17.6667 16.3333C16.75 16.3333 16 17.0833 16 18C16 18.9167 16.75 19.6667 17.6667 19.6667C18.5833 19.6667 19.3333 18.9167 19.3333 18C19.3333 17.8333 19.2667 17.6833 19.2333 17.5333C19.1 17.8 18.8333 18 18.5 18C18.0333 18 17.6667 17.6333 17.6667 17.1667C17.6667 16.8333 17.8667 16.5667 18.1333 16.4333C17.9833 16.3833 17.8333 16.3333 17.6667 16.3333Z"
                            fill="#452C88" />
                          <path
                            d="M17.7167 13C13.5 13 11 18 11 18C11 18 13.5 23 17.7167 23C21.8333 23 24.3333 18 24.3333 18C24.3333 18 21.8333 13 17.7167 13ZM17.6667 14.6667C19.5167 14.6667 21 16.1667 21 18C21 19.85 19.5167 21.3333 17.6667 21.3333C15.8333 21.3333 14.3333 19.85 14.3333 18C14.3333 16.1667 15.8333 14.6667 17.6667 14.6667ZM17.6667 16.3333C16.75 16.3333 16 17.0833 16 18C16 18.9167 16.75 19.6667 17.6667 19.6667C18.5833 19.6667 19.3333 18.9167 19.3333 18C19.3333 17.8333 19.2667 17.6833 19.2333 17.5333C19.1 17.8 18.8333 18 18.5 18C18.0333 18 17.6667 17.6333 17.6667 17.1667C17.6667 16.8333 17.8667 16.5667 18.1333 16.4333C17.9833 16.3833 17.8333 16.3333 17.6667 16.3333Z"
                            fill="black" />
>>>>>>> e8b8d93e7d475284131b0bfa50b3560c4f099f66
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
  var users_table = $('#qoute-table').DataTable({});

  $('#filter_by_sts_qoute').on('change', function() {
    var selectedStatus = $(this).val();
    users_table.column(7).search(selectedStatus).draw();
  });

  $('#filter_by_loc').on('change', function() {
    var selectedLocation = $(this).val();
    users_table.column(5).search(selectedLocation).draw();
  });
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
  $(document).on('click', '#booking_btn', function() {
    var bookingId = $(this).data('id');  // Get the ID associated with the clicked button
    console.log('Clicked application ID:', bookingId); // Check the application ID

    $.ajax({
        url: '/hotel/booking/' + bookingId,  // Your route to fetch application details
        method: 'GET',
            success: function(response) {
              $("#name").val(response.detail_page.client.name);
              $("#country").text(response.detail_page.country.name);
              $("#s_date").text(response.detail_page.s_date);
              $("#e_date").text(response.detail_page.e_date);
              $("#hotel_cancel_date").text(response.detail_page.hotel_cancel_due_date);
              $("#hotel_name").text(response.detail_page.name);
              $("#reservation_id").text(response.detail_page.reservation_id);
              $("#reservation_email").text(response.detail_page.reservation_email);
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