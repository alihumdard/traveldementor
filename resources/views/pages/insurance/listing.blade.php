@extends('layouts.main')
@section('title', 'Travel Health Insurance')
<style>
  table th,
  table td {
    text-transform: capitalize;
  }
</style>
@section('content')
@include('pages.insurance.detail_page_modal')

<div class="content-wrapper py-0 my-0">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title d-flex align-items-center">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2 d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" width="24" height="24">
              <path d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1l32 0 0 160.4c0 35.3 28.7 64 64 64l102.3 0-31.3-52.2c-4.1-6.8-2.6-15.5 3.5-20.5L288 368l-60.2-82.8c-10.9-15 8.2-33.5 22.8-22l117.9 92.6c8 6.3 8.2 18.4 .4 24.9L288 448l38.4 64 122.1 0c35.5 0 64.2-28.8 64-64.3l-.7-160.2 32 0z" />
            </svg>
          </span>
          <span> Insurance</span>
        </h3>
        <div class="row my-1 g-2 justify-content-start justify-content-md-end">
            <!-- Add Appointment Button -->
            <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-md-end justify-content-start ">
              <a href="{{ route('insurance.add') }}">
                <button class="btn add-btn text-white" style="background-color: #452C88; width: fit-content; padding-left: 10px; padding-right: 10px;">
                  <span><i class="fa fa-plus me-2"></i>Add Insurance</span>
                </button>
              </a>
            </div>
            <!-- Search Input -->
            <div class="col-lg-6 col-md-6 col-sm-12">
              <input
                type="text" id="search_input" class="form-control w-100" placeholder="Search Applicant, Country Name or Policy Number" style="height: 45px;" />
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
            <table id="qoute-table" class="display" style="width:100%; table-layout:auto;">
              <thead class="table-dark" style="background-color:rgba(69, 44, 136, 0.85);">
                <tr style="font-size: small;">
                  <th>#</th>
                  <th>Applicant Name</th>
                  <th>Country</th>
                  <th>Insurance Plan</th>
                  <th>Policy No</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tableData">
                @foreach ($insurances as $insurance)
                <tr style="font-size: small;">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $insurance->client ? $insurance->client->name .'~'. $insurance->client->sur_name : ''}}</td>
                  <td>{{ $insurance->country->name ?? ''}}</td>
                  <td>{{ $insurance->plan_type ?? ''}}</td>
                  <td>{{ $insurance->policy_no ?? ''}}</td>
                  <td>{{ $insurance->amount ?? '' }}</td>

                  <td class="">
                    <div class="d-flex my-auto">
                      <!-- Edit Button -->
                      <a href="{{route('insurance.add',['id'=>$insurance])}}" class="btn p-0">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z"
                            fill="#233A85" />
                        </svg>
                      </a>

                      <!-- Delete Button -->
                      <a href="{{ route('insurance.delete', ['id' => $insurance->id])  }}" class="btn p-0">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                          <path d="M10 2L9 3H3V5H21V3H15L14 2H10ZM4.36523 7L6.06836 22H17.9316L19.6348 7H4.36523Z"
                            fill="#452C88" transform="translate(6, 6)" />
                        </svg>
                      </a>

                      <!-- Quote Detail Button -->
                      <button data-id="{{$insurance->id }}" id="insurance_btn" class="btn p-0 quoteDetail_view"
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
  // Create a custom filter
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
    var searchValue = $('#search_input').val().toLowerCase(); 

    var column1 = data[1] ? data[1].toLowerCase() : ""; 
    var column3 = data[2] ? data[2].toLowerCase() : ""; 
    var column5 = data[4] ? data[4].toLowerCase() : ""; 

    return column1.includes(searchValue) || column3.includes(searchValue) || column5.includes(searchValue) ;
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
  $(document).on('click', '#insurance_btn', function() {
    var insuranceId = $(this).data('id'); // Get the ID associated with the clicked button
    console.log('Clicked application ID:', insuranceId); // Check the application ID

    $.ajax({
      url: '/insurance/' + insuranceId, // Your route to fetch application details
      method: 'GET',
      success: function(response) {
        $("#name").val(response.detail_page.client.name + '~' + response.detail_page.client.sur_name);
        $("#country").text(response.detail_page.country.name);
        $("#plan_type").text(response.detail_page.plan_type);
        $("#s_date").text(response.detail_page.s_date);
        $("#e_date").text(response.detail_page.e_date);
        $("#policy_no").text(response.detail_page.policy_no);
        $("#payment_mode").text(response.detail_page.payment_mode);
        $("#sale_date").text(response.detail_page.sale_date);
        $("#amount").text(response.detail_page.amount);
        $("#payable_after_40_per").text(response.detail_page.payable_after_40_per);
        $("#net_payable").text(response.detail_page.net_payable);
        $("#refund_applied").text(response.detail_page.refund_applied);
        $('#qoutedetail').modal('show'); // Show the modal with updated details
      },
      error: function(error) {
        console.error('Error fetching application details:', error);
      }
    });
  });
</script>
@endPushOnce