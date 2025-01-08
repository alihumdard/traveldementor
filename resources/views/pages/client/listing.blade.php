@extends('layouts.main')
@section('title', 'Client')
@section('content')
@include('pages.client.client_modal')
<div class="content-wrapper py-0 my-0">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
    <div class="p-3">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
            <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M18.8576 5.98446C19.3853 5.98446 19.8684 5.71825 20.2227 5.28788C20.5987 4.83115 20.8314 4.1931 20.8314 3.48206C20.8314 2.73797 20.7572 2.07559 20.468 1.63218C20.205 1.22902 19.7172 0.979618 18.8576 0.979618C17.9981 0.979618 17.5102 1.22902 17.2473 1.63218C16.9581 2.07557 16.8839 2.73797 16.8839 3.48206C16.8839 4.19315 17.1165 4.83118 17.4926 5.28792C17.8469 5.71827 18.3299 5.98446 18.8576 5.98446ZM20.9765 5.90778C20.4392 6.5604 19.6904 6.96408 18.8576 6.96408C18.0248 6.96408 17.276 6.56041 16.7387 5.90781C16.2232 5.28162 15.9043 4.42355 15.9043 3.48206C15.9043 2.57365 16.0112 1.73985 16.4284 1.10029C16.8718 0.420497 17.6158 0 18.8576 0C20.0994 0 20.8434 0.420497 21.2868 1.10029C21.704 1.73984 21.811 2.57365 21.811 3.48206C21.811 4.42354 21.4921 5.28162 20.9765 5.90778Z"
                fill="white" />
              <path
                d="M23.0174 11.7404C22.9962 10.4001 22.9069 9.5513 22.5236 9.02564C22.1733 8.5453 21.5146 8.26609 20.3554 8.03867C20.0918 8.24402 19.5995 8.52014 18.8576 8.52014C18.1156 8.52014 17.6233 8.244 17.3597 8.03865C16.6132 8.18514 16.0743 8.35323 15.6915 8.58278C15.8194 8.20153 15.902 7.80454 15.9393 7.40337C16.353 7.25757 16.8421 7.13877 17.4224 7.03403L17.7077 6.98254L17.8892 7.20814C17.89 7.20908 18.1491 7.54052 18.8576 7.54052C19.566 7.54052 19.8251 7.20908 19.8259 7.20814L20.0075 6.98254L20.2927 7.03403C21.8634 7.31755 22.7665 7.70391 23.3119 8.45166C23.8472 9.18565 23.9688 10.1865 23.9932 11.7251L23.9942 11.7924C23.9971 11.9705 24 12.1469 24 12.1559L23.9426 12.3836C23.9401 12.3883 23.1231 14.0266 18.8576 14.0266C18.7048 14.0266 18.5568 14.0243 18.4126 14.0202C18.3449 13.6778 18.2519 13.3442 18.1236 13.0309C18.3533 13.0413 18.5975 13.047 18.8576 13.047C21.9203 13.047 22.809 12.2702 23.0202 12.0112C23.0199 11.8958 23.0192 11.8524 23.0185 11.8077L23.0174 11.7404Z"
                fill="white" />
              <path
                d="M12.0007 9.68808C12.6715 9.68808 13.2843 9.35136 13.7325 8.80697C14.2024 8.23625 14.493 7.44074 14.493 6.5557C14.493 5.63766 14.3998 4.81782 14.0362 4.26041C13.6989 3.74324 13.0814 3.42333 12.0007 3.42333C10.9199 3.42333 10.3024 3.74324 9.96507 4.26041C9.6015 4.8178 9.50831 5.63764 9.50831 6.5557C9.50831 7.44075 9.79897 8.2363 10.2689 8.80702C10.717 9.35137 11.3297 9.68808 12.0007 9.68808ZM14.4863 9.42687C13.8551 10.1935 12.9766 10.6677 12.0007 10.6677C11.0246 10.6677 10.1462 10.1935 9.51503 9.42692C8.90565 8.68673 8.52869 7.67116 8.52869 6.55571C8.52869 5.47336 8.65467 4.4821 9.1462 3.72854C9.66394 2.93473 10.5376 2.44373 12.0006 2.44373C13.4636 2.44373 14.3372 2.93473 14.8551 3.72854C15.3466 4.48208 15.4726 5.47336 15.4726 6.55571C15.4726 7.67117 15.0957 8.6867 14.4863 9.42687Z"
                fill="white" />
              <path
                d="M17.1387 16.4788C17.1127 14.8356 17.0013 13.792 16.5213 13.1338C16.0751 12.5221 15.2464 12.1721 13.7873 11.8897C13.4934 12.1291 12.9085 12.4792 12.0005 12.4792C11.0924 12.4792 10.5075 12.1291 10.2136 11.8897C8.77045 12.169 7.94372 12.5148 7.49424 13.1148C7.01302 13.7571 6.89407 14.7715 6.86427 16.3656L6.86315 16.4248C6.86097 16.5402 6.859 16.6444 6.85836 16.8421C7.09453 17.1482 8.16716 18.1653 12.0005 18.1653C15.8339 18.1653 16.9065 17.1481 17.1426 16.842C17.1422 16.6944 17.1411 16.629 17.1401 16.5635L17.1387 16.4788L17.1387 16.4788ZM17.3095 12.5598C17.9415 13.4264 18.0854 14.6219 18.1145 16.4635L18.1159 16.5482C18.1192 16.7505 18.1224 16.9483 18.1224 16.9834L18.065 17.2111C18.0621 17.2166 17.1008 19.1449 12.0005 19.1449C6.90013 19.1449 5.93886 17.2166 5.93596 17.2111L5.87854 16.9834C5.87854 16.8746 5.88268 16.6571 5.88738 16.4095L5.8885 16.3503C5.92211 14.5513 6.0764 13.3799 6.71364 12.5293C7.35823 11.6689 8.42912 11.2188 10.2813 10.8844L10.5659 10.833L10.7481 11.0585C10.7491 11.0598 11.0931 11.4995 12.0005 11.4995C12.9078 11.4995 13.2518 11.0598 13.2528 11.0585L13.435 10.833L13.7196 10.8844C15.5932 11.2226 16.6675 11.6794 17.3095 12.5598Z"
                fill="white" />
              <path
                d="M5.14237 5.98446C4.61469 5.98446 4.13162 5.71825 3.77729 5.28788C3.40127 4.83115 3.16864 4.1931 3.16864 3.48206C3.16864 2.73797 3.24281 2.07559 3.53204 1.63218C3.79503 1.22902 4.28284 0.979618 5.14237 0.979618C6.00195 0.979618 6.48977 1.22902 6.75274 1.63218C7.04193 2.07557 7.11607 2.73797 7.11607 3.48206C7.11607 4.19315 6.88346 4.83118 6.50744 5.28792C6.15313 5.71827 5.67009 5.98446 5.14237 5.98446ZM3.02347 5.90778C3.56079 6.5604 4.3096 6.96408 5.14237 6.96408C5.97517 6.96408 6.72396 6.56041 7.26127 5.90781C7.7768 5.28162 8.0957 4.42355 8.0957 3.48206C8.0957 2.57365 7.98877 1.73985 7.57162 1.10029C7.1282 0.420497 6.38419 0 5.14237 0C3.90062 0 3.15662 0.420497 2.71318 1.10029C2.29599 1.73984 2.18903 2.57365 2.18903 3.48206C2.18903 4.42354 2.50793 5.28162 3.02347 5.90778Z"
                fill="white" />
              <path
                d="M0.982648 11.7404C1.00385 10.4001 1.09307 9.5513 1.47643 9.02564C1.82673 8.5453 2.48539 8.26609 3.64459 8.03867C3.90819 8.24402 4.40047 8.52014 5.14238 8.52014C5.88438 8.52014 6.37671 8.244 6.64031 8.03865C7.38683 8.18514 7.92575 8.35323 8.30848 8.58278C8.18059 8.20153 8.09799 7.80454 8.06068 7.40337C7.64704 7.25757 7.15791 7.13877 6.57761 7.03403L6.29235 6.98254L6.11076 7.20814C6.11 7.20908 5.85092 7.54052 5.14237 7.54052C4.43396 7.54052 4.17487 7.20908 4.17411 7.20814L3.99253 6.98254L3.70726 7.03403C2.13658 7.31755 1.23347 7.70391 0.688143 8.45166C0.15285 9.18565 0.0311854 10.1865 0.00685173 11.7251L0.00576688 11.7924C0.00287438 11.9705 0 12.1469 0 12.1559L0.0574159 12.3836C0.0598745 12.3883 0.876932 14.0266 5.14236 14.0266C5.29525 14.0266 5.4432 14.0243 5.58736 14.0202C5.65512 13.6778 5.74807 13.3442 5.87641 13.0309C5.64669 13.0413 5.40255 13.047 5.14237 13.047C2.07971 13.047 1.19102 12.2702 0.979779 12.0112C0.980104 11.8958 0.980827 11.8524 0.98155 11.8077L0.982648 11.7404Z"
                fill="white" />
            </svg>
          </span>
          <span>Client</span>
        </h3>
        <div class="row mb-2">
          <!-- <div class="col-lg-4"></div> -->
          <div class="col-lg-12">
            <div class="row mx-1">
              <div class="col-lg-12 col-md-12 col-sm-12 my-2 pr-0" style="text-align: right;">
                <a href="{{ route('client.add') }}">
                  <button class="btn add-btn text-white" style="background-color: #452C88;"><span><i
                        class="fa fa-plus mr-2"></i>Add Client</span></button>
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
            <thead class="table-dark" style="background-color:rgba(69, 44, 136, 0.85);">
              <tr style="font-size: small;">
                <th>#</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Contact no</th>
                <th>Date of birth</th>
                <th>Refer Person</th>
                <th>Action</th>
              </tr>
            </thead>
            @foreach($clients as $client)
            <tbody id="tableData">
              <tr style="font-size: small;">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->sur_name}}</td>
                <td>{{ $client->contact_no }}</td>
                <td>{{ $client->dob }}</td>
                <td>{{ $client->refer_person }}</td>
                <td class="">
                  <div class="d-flex my-auto">
                    <!-- Edit Button -->
                    <a href="{{ route('client.add', ['id' => $client->id]) }}" class="btn p-0">
                      <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z"
                          fill="#233A85" />
                      </svg>
                    </a>
                    <!-- Delete Button -->
                    <a href="{{ route('client.delete', ['id' => $client->id]) }}" class="btn p-0">
                      <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                        <path d="M10 2L9 3H3V5H21V3H15L14 2H10ZM4.36523 7L6.06836 22H17.9316L19.6348 7H4.36523Z"
                          fill="#452C88" transform="translate(6, 6)" />
                      </svg>
                    </a>

                    <!-- Quote Detail Button -->
                    <button data-id="{{  $client->id }}" id="client_btn" class="btn p-0 quoteDetail_view"
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
            </tbody>
            @endforeach
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
  $(document).on('click', '#client_btn', function() {
    var insuranceId = $(this).data('id');
    $.ajax({
      url: '/client/' + insuranceId,
      method: 'GET',
      success: function(response) {
        console.log(response);
        $("#name").val(response.detail_page.name);
        $("#sur_name").text(response.detail_page.sur_name);
        $("#contact_no").text(response.detail_page.contact_no);
        $("#dob").text(response.detail_page.dob);
        $("#refer_person").text(response.detail_page.refer_person);
        $('#qoutedetail').modal('show'); // Show the modal with updated details
      },
      error: function(error) {
        console.error('Error fetching application details:', error);
      }
    });
  });
</script>

@endPushOnce