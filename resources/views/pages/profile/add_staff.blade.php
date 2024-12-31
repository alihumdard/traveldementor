@extends('layouts.main')
@section('title', 'Category')
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
  .table-responsive{
  overflow-x: hidden !important;
}
  #category_type:hover,
  select:focus {
    border-color: #007bff;
  }
  table th, table td {
    text-transform: capitalize;
  }
</style>
<!-- partial -->
<div class="content-wrapper py-0 my-2">
    <div>
        <form action="#" id="formData" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="id" name="id">

            <div class="row">

              <div class="col-lg-6 mb-2">
                <label for="user_pic">@lang('lang.upload_image')</label>
                <div class="row">
                  <div class="col-lg-10 col-10 col-sm-10 col-xl-10">
                    <input type="file" name="user_pic" id="user_pic" class="form-control" require>
                  </div>
                  <div class="col-lg-2 col-2 col-sm-2 col-xl-2">
                    <img src="" width="45px" height="45px" style="border-radius: 50%;" id="user_pic" class="d-none">
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mb-2">
                <label for="com_pic">Staff</label>
                <select name="admin_id" id="admin_id" class="form-select">
                  <option disabled selected>@lang('select admins') </option>
                  <option value="{{ $value['id'] }}" {{ isset($data['admin_id']) && $data['admin_id'] == $value['id'] ? 'selected' : '' }}>
                    {{ $value['name'] }}
                  </option>
                  @endforeach
                </select>
                <div id="adminError" class="text-danger d-none">*@lang('select an admin')</div>
              </div>
              @endif

              @if($add_as_user == user_roles('1'))
              <div class="col-lg-6 mb-2">
                <label for="com_pic">@lang('lang.company_logo')</label>
                <div class="row">
                  <div class="col-lg-10 col-10 col-sm-10 col-xl-10">
                    <input type="file" name="com_pic" id="com_pic" class="form-control" require>
                  </div>
                  <div class="col-lg-2 col-2 col-sm-2 col-xl-2">
                    <img src="" width="45px" height="45px" style="border-radius: 50%;" id="com_pic" class="d-none">
                  </div>
                </div>
              </div>
              @endif

              <div class="col-lg-6 mt-2">
                <label for="name">@lang('lang.name')</label>
                <input type="text" name="name" id="name" class="form-control">
                <div id="nameError" class="text-danger d-none">@lang('lang.name_error')</div>
              </div>

              <div class="col-lg-6 mt-2">
                <label for="email">@lang('lang.email')</label>
                <input type="email" name="email" id="email" class="form-control">
                <div id="emailError" class="text-danger d-none">@lang('lang.email_error')</div>
              </div>

              <div class="col-lg-6 mt-2">
                <label for="phone">@lang('lang.phone')</label>
                <input type="tel" name="phone" id="phone" class="form-control" maxlength="15">
              </div>
              @if($add_as_user == user_roles('1'))
              <div class="col-lg-6 mt-2">
                <label for="com_name">@lang('lang.company_name')</label>
                <input type="text" name="com_name" id="com_name" class="form-control">
              </div>
              @endif

              <div class="col-lg-6 mt-2">
                <label for="address">@lang('lang.address')</label>
                <input type="text" name="address" id="address" class="form-control">
                <p id="charCountContainer" class="text-secondary text-right" style="display: none;"><span id="charCount">150</span> /150</p>
              </div>

              <div class="col-lg-6 mt-3">
                <div class="row py-4 justify-content-end">
                  <div class="col-lg-12">
                    <button type="submit" id="btn_save" class="btn btn-md text-white px-5 " data-target="#add" style="background-color: #452C88; width: 100%;">
                      <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                      <span id="add_btn">@lang('lang.add')</span>
                    </button>
                  </div>
                </div>
              </div>

            </div>
        </form>
      </div>
</div>

  @stop

  @pushOnce('scripts')
  <script>
    $('#btn_save_').click(function(event) {
      let category_name = $('#category_name').val();
      let category_type = $('#category_type').val();

      if (category_name === '') {
        $('#category_name_error').text('*Please enter a category name.');
        event.preventDefault();
      }

      if (category_type === null) {
        $('#category_type_error').text('*Please select a category type.');
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