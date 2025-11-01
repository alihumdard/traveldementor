@extends('layouts.main')
@section('title', 'Country')
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
          <h3 class="page-title d-flex align-items-center">
            <span class="page-title-icon bg-gradient-primary text-white me-2 py-2 d-flex justify-content-center align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" width="24" height="24">
                <path d="M352 256c0 22.2-1.2 43.6-3.3 64l-185.3 0c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64l185.3 0c2.2 20.4 3.3 41.8 3.3 64zm28.8-64l123.1 0c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64l-123.1 0c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32l-116.7 0c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0l-176.6 0c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0L18.6 160C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192l123.1 0c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64L8.1 320C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6l176.6 0c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352l116.7 0zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6l116.7 0z" />
              </svg>
            </span>
            <span>Countries</span>
          </h3>

          <form method="POST" action="{{ route('countries') }}">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $country['id'] ?? '' }}">
            <input type="hidden" name="action" id="action" value="save">
            <div class="row mt-1 mb-5">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <label for="title" class="mb-0 mt-1">Country Name</label>
                <input type="text" maxlength="60" name="name" id="country_name" class="form-control"
                  value="{{ old('name', $country['name'] ?? '') }}" placeholder="Country Name" required>
                <span id="country_name_error" class="error-message text-danger"></span>
                <div class="text-danger error-message" id="name-error">
                  @if ($errors->has('name'))
                  <p>{{ $errors->first('name') }}</p>
                  @endif
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <label for="title" class="mb-0 mt-1">Country code</label>
                <input type="text" maxlength="60" name="code" id="country_code" class="form-control"
                  value="{{ old('code', $country['code'] ?? '') }}" placeholder="Country Code like Pk,Au" required>
                <span id="country_code_error" class="error-message text-danger"></span>
                <div class="text-danger error-message" id="code-error"></div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-end  justify-content-center">
                <input type="submit" id="btn_save_" class="btn form-control w-50 text-white mt-2" name="submit"
                  value="{{ ($country['id'] ?? '') !== '' ? 'Update' : 'Add' }}" style="background-color: #452C88;" />
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
              <table id="country-table" class="display" style="width:100%">
                <thead class="table-dark" style="background-color: #5F4A99;">
                  <tr style="font-size: small;">
                    <th>#</th>
                    <th> Name </th>
                    <th> Code </th>
                    <th> Status </th>
                    <th> @lang('lang.actions')</th>
                  </tr>
                </thead>
                <tbody id="tableData">
                  @foreach($data as $key => $value)
                  <tr style="font-size: small;">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value['name'] ?? '' }}</td>
                    <td>{{ $value['code'] ?? '' }}</td>

                    @if($value['status'] == 1)
                    <td>
                      <button class="btn btn_status">
                        <span data-user_id="{{$value['id']}}">
                          <div
                            style="width: 100%; height: 100%; padding-top: 5px; padding-bottom: 5px; padding-left: 19px; padding-right: 20px; background: rgba(48.62, 165.75, 19.34, 0.18); border-radius: 3px; justify-content: center; align-items: center; display: inline-flex">
                            <div style="color: #31A613; font-size: 14px; font-weight: 500; word-wrap: break-word">
                              Active</div>
                          </div>
                        </span>
                      </button>
                    </td>
                    @endif

                    <td style="width: 80px;">
                      <div class="row">
                        <div class="col-6 p-0">
                          <form method="POST" action="{{ route('countries') }}">
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
                          <form method="POST" action="{{ route('countries') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$value['id']}}">
                            <input type="hidden" name="action" value="dell">
                            <button id="btn_dell_country" class="btn btn_dell_country p-0" data-toggle="modal"
                              data-target="#deleteclient">
                              <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.1" cx="18" cy="18" r="18" fill="#ACADAE" />
                                <path d="M10 2L9 3H3V5H21V3H15L14 2H10ZM4.36523 7L6.06836 22H17.9316L19.6348 7H4.36523Z" fill="#452C88" transform="translate(6, 6)" />
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
      let country_name = $('#country_name').val();
      let country_code = $('#country_code').val();
      let category_type = $('#category_type').val();

      if (country_name === '') {
        $('#country_name_error').text('*Please enter a country name.');
        event.preventDefault();
      }
      if (country_code === '') {
        $('#country_code_error').text('*Please enter a country code.');
        event.preventDefault();
      }

    });

    $('#country_name').on('input', function() {
      let country_name = $('#country_name').val();
      if (country_name === '') {
        $('#country_name_error').text('*Please enter a country name.');
        event.preventDefault();
      } else {
        $('#country_name_error').text('');
      }
    });


    var service_table = $('#country-table').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            text: '<i class="fa-solid fa-file-excel"></i> Export Excel',
            className: 'btn-excel'
        },
        {
            extend: 'pdfHtml5',
            text: '<i class="fa-solid fa-file-pdf"></i> Export PDF',
            className: 'btn-pdf'
        },
    ],
    initComplete: function () {
        // Excel button
        $('.btn-excel').css({
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
        })

        // PDF button
        $('.btn-pdf').css({
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
        })
    }
});


  </script>
  @endPushOnce