@extends('layouts.main')
@section('title', 'Software Status')
@section('content')
<style>
  #category_type {
    appearance: none;
    border: 1px solid #ccc;
    background-color: #fff;
    color: #333;
    padding: 5px;
    width: 100%;
    font-size: 16px;
  }

  #category_type::-ms-expand {
    display: none;
  }

  .table-responsive {
    overflow-x: hidden !important;
  }

  #category_type:hover,
  select:focus {
    border-color: #007bff;
  }
</style>
<!-- partial -->
<div class="content-wrapper py-0 my-2">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title pb-3">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
            <svg width="25" height="25" viewBox="0 0 576 512" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z"
                fill="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
          <span>Software Status</span>
        </h3>
        <form method="POST" action="{{ route('software.status') }}">
          @csrf
          <input type="hidden" name="id" id="id" value="{{ $software_status['id'] ?? '' }}">
          <input type="hidden" name="action" id="action" value="save">
          <div class="row mt-1 mb-5">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <label for="title" class="mb-0 mt-1">Status Name</label>
              <input type="text" maxlength="60" name="name" id="status_name" class="form-control"
                value="{{ old('name', $software_status['name'] ?? '') }}" placeholder="Category name" required>
              <span id="status_name_error" class="error-message text-danger"></span>

              <div class="text-danger error-message" id="name-error">
                @if ($errors->has('name'))
                <p>{{ $errors->first('name') }}</p>
                @endif
              </div>
            </div>
            
            <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 10px;">
              <label for="status_type">Status Type</label>
              <select name="status_type" id="status_type" class="form-select">
                @foreach($app_status_type as $key => $value)
                <option value="{{ $key }}"
                  {{ old('status_type', $software_status['type'] ?? '') == $key ? 'selected' : '' }}>
                  {{ $value }}
                </option>
                @endforeach
              </select>
              <span id="status_type_error" class="error-message text-danger"></span>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-end  justify-content-center">
              <input type="submit" id="btn_save_" class="btn form-control w-50 text-white mt-2" name="submit"
                value="{{ ($software_status['id'] ?? '') !== '' ? 'Update' : 'Add' }}"
                style="background-color: #452C88;" />
              <div class="text-danger error-message mt-1" id="submitBtn-error"></div>
            </div>
          </div>
        </form>

        @if (Session::has('msg'))
        <div class="alert alert-success col-lg-8 col-md-12 col-sm-12 ">
          <button type="button" class="close ml-2" data-dismiss="alert">&times;</button>
          <strong>{{ session('msg') }}</strong>
        </div>
        @endif


        <hr class="mt-3 mb-2">
        <div class="px-2">
          <div class="table-responsive">
            <table id="category-table" class="display" style="width: 100%; table-layout: auto;">
              <thead class="table-dark" style="background-color:#5F4A99;">
                <tr style="font-size: small;">
                  <th>#</th>
                  <th> Name </th>
                  <th> Type </th>
                  <th> @lang('lang.actions')</th>
                </tr>
              </thead>
              <tbody id="tableData">

                @foreach($data as $key => $value)
                <tr style="font-size: small;">
                  <td>{{ $key + 1 }}</td>

                  <td>{{ $value['name'] ?? '' }}</td>

                  <td>
                    @if (isset($value['type']))
                    @if ($value['type'] == 1)
                    Application
                    @elseif ($value['type'] == 3)
                    Pending Appointment
                    @elseif ($value['type'] == 4)
                    Scheduled Appointment
                    @elseif ($value['type'] == 5)
                    Hotel Booking
                    @endif
                    @else
                    Not Set
                    @endif
                  </td>


                  <td style="width: 80px;">
                    <div class="row">
                      <div class="col-6 p-0">
                        <form method="POST" action="{{ route('software.status') }}">
                          @csrf
                          <input type="hidden" name="id" value="{{$value['id']}}">
                          <input type="hidden" name="action" value="edit">
                          <button id="btn_edit_announcement" class="btn p-0">
                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <circle opacity="0.1" cx="18" cy="18" r="18" fill="#233A85" />
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.1634 23.6195L22.3139 15.6658C22.6482 15.2368 22.767 14.741 22.6556 14.236C22.559 13.777 22.2768 13.3406 21.8534 13.0095L20.8208 12.1893C19.922 11.4744 18.8078 11.5497 18.169 12.3699L17.4782 13.2661C17.3891 13.3782 17.4114 13.5438 17.5228 13.6341C17.5228 13.6341 19.2684 15.0337 19.3055 15.0638C19.4244 15.1766 19.5135 15.3271 19.5358 15.5077C19.5729 15.8614 19.3278 16.1925 18.9638 16.2376C18.793 16.2602 18.6296 16.2075 18.5107 16.1097L16.676 14.6499C16.5868 14.5829 16.4531 14.5972 16.3788 14.6875L12.0185 20.3311C11.7363 20.6848 11.6397 21.1438 11.7363 21.5878L12.2934 24.0032C12.3231 24.1312 12.4345 24.2215 12.5682 24.2215L15.0195 24.1914C15.4652 24.1838 15.8812 23.9807 16.1634 23.6195ZM19.5955 22.8673H23.5925C23.9825 22.8673 24.2997 23.1886 24.2997 23.5837C24.2997 23.9795 23.9825 24.3 23.5925 24.3H19.5955C19.2055 24.3 18.8883 23.9795 18.8883 23.5837C18.8883 23.1886 19.2055 22.8673 19.5955 22.8673Z"
                                fill="#233A85" />
                            </svg>
                          </button>
                        </form>
                      </div>
                      <div class="col-6 p-0">
                        <form method="POST" action="{{ route('software.status') }}">
                          @csrf
                          <input type="hidden" name="id" value="{{$value['id']}}">
                          <input type="hidden" name="action" value="dell">
                          <button id="btn_dell_category" class="btn btn_dell_category p-0" data-toggle="modal"
                            data-target="#deleteclient">
                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                              <path d="M10 2L9 3H3V5H21V3H15L14 2H10ZM4.36523 7L6.06836 22H17.9316L19.6348 7H4.36523Z"
                                fill="#452C88" transform="translate(6, 6)" />
                            </svg>
                          </button>
                        </form>
                      </div>
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
    $('#btn_save_').click(function(event) {
      let status_name = $('#status_name').val();
      let status_type = $('#status_type').val();

      if (status_name === '') {
        $('#status_name_error').text('*Please enter a status name.');
        event.preventDefault();
      }

      if (status_type === '') {
        $('#status_type_error').text('*Please select a status type.');
        event.preventDefault();
      }

    });

    $('#category_name').on('input', function() {
      let category_name = $('#category_name').val();
      if (category_name === '') {
        $('#category_name_error').text('*Please enter a category name.');
        event.preventDefault();
      } else {
        $('#category_name_error').text('');
      }
    });



    $('#category_type').on('change', function() {
      let category_type = $('#category_type').val();
      if (category_type === null) {
        $('#category_type_error').text('*Please select a category type.');
        event.preventDefault();
      } else {
        $('#category_type_error').text('');
      }
    });

    let service_table = $('#category-table').DataTable();
  </script>
  @endPushOnce