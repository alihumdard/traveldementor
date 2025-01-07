@extends('layouts.main')
@section('title', 'DS160')
<style>
  table th,
  table td {
    text-transform: capitalize;
  }
</style>
@section('content')
@include('pages.ds160.detail_page_modal')
<div class="content-wrapper py-0 my-0">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title d-flex align-items-center">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2 d-flex justify-content-center align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" width="24" height="24">
              <path d="M0 64C0 28.7 28.7 0 64 0L384 0c35.3 0 64 28.7 64 64l0 384c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zM183 278.8c-27.9-13.2-48.4-39.4-53.7-70.8l39.1 0c1.6 30.4 7.7 53.8 14.6 70.8zm41.3 9.2l-.3 0-.3 0c-2.4-3.5-5.7-8.9-9.1-16.5c-6-13.6-12.4-34.3-14.2-63.5l47.1 0c-1.8 29.2-8.1 49.9-14.2 63.5c-3.4 7.6-6.7 13-9.1 16.5zm40.7-9.2c6.8-17.1 12.9-40.4 14.6-70.8l39.1 0c-5.3 31.4-25.8 57.6-53.7 70.8zM279.6 176c-1.6-30.4-7.7-53.8-14.6-70.8c27.9 13.2 48.4 39.4 53.7 70.8l-39.1 0zM223.7 96l.3 0 .3 0c2.4 3.5 5.7 8.9 9.1 16.5c6 13.6 12.4 34.3 14.2 63.5l-47.1 0c1.8-29.2 8.1-49.9 14.2-63.5c3.4-7.6 6.7-13 9.1-16.5zM183 105.2c-6.8 17.1-12.9 40.4-14.6 70.8l-39.1 0c5.3-31.4 25.8-57.6 53.7-70.8zM352 192A128 128 0 1 0 96 192a128 128 0 1 0 256 0zM112 384c-8.8 0-16 7.2-16 16s7.2 16 16 16l224 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-224 0z" />
            </svg>
          </span>
          <span>DS160</span>
        </h3>
        <div class="row mb-2">
          <div class="col-lg-12">
            <div class="row mx-1 justify-content-end">
              <!-- Add DS160 button -->
              <div class="col-lg-3 col-md-4 col-sm-12 my-2 pr-0">
                <a href="{{ route('ds.add') }}">
                  <button class="btn add-btn text-white" style="background-color: #452C88;">
                    <span><i class="fa fa-plus mr-2"></i> Add DS160</span>
                  </button>
                </a>
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
                  <th>Applicant Name</th>
                  <th>Category</th>
                  <th>DS160</th>
                  <th>Revised DS160</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="tableData">
                @foreach ($ds160 as $ds)

                <tr style="font-size: small;">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $ds->client->name ?? 'N/A' }}</td>
                  <td>{{ $ds->category->name ?? 'N/A' }}</td>
                  <td>{{ $ds->ds160 }}</td>
                  <td>{{ $ds->revised_ds160 }}</td>
                  <td>
                    <div class="d-flex my-auto">
                      <!-- Edit Button -->
                      <a href="{{ route('ds.add', ['id' => $ds->id]) }}" class="btn p-0">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z"
                            fill="#233A85" />
                        </svg>
                      </a>

                      <!-- Delete Button -->
                      <a href="{{ route('ds.delete', ['id' => $ds->id]) }}" class="btn p-0">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                          <path d="M10 2L9 3H3V5H21V3H15L14 2H10ZM4.36523 7L6.06836 22H17.9316L19.6348 7H4.36523Z"
                            fill="#452C88" transform="translate(6, 6)" />
                        </svg>
                      </a>

                      <!-- Quote Detail Button -->
                      <button data-id="{{  $ds->id }}" id="ds160_detail" class="btn p-0 quoteDetail_view"
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
  $(document).on('click', '#ds160_detail', function() {
    var ds160Id = $(this).data('id');
    $.ajax({
      url: '/ds/' + ds160Id,
      method: 'GET',
      success: function(response) {
        console.log(response);
        $("#category").text(response.detail_page.category.name); // Assuming category is an object
        $("#ds_160_create_date").text(response.detail_page.ds_160_create_date);
        $("#ds160").text(response.detail_page.ds160);
        $("#revised_ds160").text(response.detail_page.revised_ds160);
        $("#surname").text(response.detail_page.surname); // Use text() instead of val() for non-input fields
        $("#name").val(response.detail_page.client.name); // Use text() instead of val() for non-input fields
        $("#year_of_birth").text(response.detail_page.year_of_birth);
        $("#sec_question").text(response.detail_page.sec_question);
        $("#sec_answer").text(response.detail_page.sec_answer);
        $("#us_travel_doc_email").text(response.detail_page.us_travel_doc_email);
        $("#us_travel_doc_password").text(response.detail_page.us_travel_doc_password);
        $("#us_travel_doc_updated_password").text(response.detail_page.us_travel_doc_updated_password);
        $("#challan_created").text(response.detail_page.challan_created);
        $("#challan_submitted").text(response.detail_page.challan_submitted);
        $("#payment_mode").text(response.detail_page.payment_mode);
        $("#transaction_date").text(response.detail_page.transaction_date);
        $("#appoint_date").text(response.detail_page.appoint_date);
        $("#appoint_reschedule").text(response.detail_page.appoint_reschedule);
        $("#pick_up_location").text(response.detail_page.pick_up_location);
        $("#premium_delivery").text(response.detail_page.premium_delivery);
        $("#delivery_address").text(response.detail_page.delivery_address);

        // Show the modal with updated details
        $('#qoutedetail').modal('show');
      },
      error: function(error) {
          console.error('Error fetching application details:', error);
        }
      
    });
  });
</script>


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
</script>

@endPushOnce