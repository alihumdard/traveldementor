<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travel De Mentor</title>
  <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet" /> -->
  <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css" />
  <!-- <script src="https://kit.fontawesome.com/c35c4a5799.js" crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="assets/font-web/css/all.css" />

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <style>
    /*
        *
        * ==========================================
        * CUSTOM UTIL CLASSES
        * ==========================================
        *
        */
    .navbar-brand {
      font-family: "Poppins", sans-serif;
      font-style: normal !important;
      font-weight: 700 !important;
      font-size: 45px !important;
      line-height: 68px !important;
      color: #3a0ca3 !important;
    }

    .border-md {
      border-width: 2px;
    }

    .sign_up {
      box-shadow: 0px 4px 26px rgba(0, 0, 0, 0.25) !important;
      border-radius: 32px !important;
    }

    /*
        *
        * ==========================================
        * FOR DEMO PURPOSES
        * ==========================================
        *
        */
    input,
    .input-group-text {
      /*border-top: 0px !important;*/
      /*border-left: 0px !important;*/
      /*border-right: 0px !important;*/
      outline: 0px !important;
    }

    .form-control:not(select) {
      padding: 1.2rem 0.5rem;
    }

    select.form-control {
      height: 42px;
      padding-left: 0.5rem;
    }

    option,
    .form-control::placeholder {
      color: #ccc;
      font-weight: bold;
      font-size: 0.9rem;
    }

    option {
      color: #000000;
      font-weight: bold;
      font-size: 1rem;
    }

    .form-control:focus {
      box-shadow: none;
    }
    .contact {
    color:#212B60!important;
  }
  .text-warning.contact:hover {
    color: #184A45 !important;
  }
  #btn_user_login {
    background-color: #212B60; /* Initial color */
    transition: background-color 0.3s ease; /* Smooth transition */
  }

  #btn_user_login:hover {
    background-color:rgb(15, 26, 76); /* Change to a darker blue on hover */
  }
  </style>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">  -->
</head>

<body style="overflow-x: hidden;">
  <div class="container-fluid mx-2" style="margin-top: 20px !important;">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-6 ml-auto" style="height: 90vh !important; width: 100%;">
        <div class="">
          <!-- Navbar Brand -->
          <a class="navbar-brand">
            <img src="{{asset('assets/images/traveldementor.jpeg')}}" width="350px" height="100px" alt="">          </a>
        </div>
        <div class="row mt-4">
          <form action="login"  method="post" style="width: 500px !important;">
            @csrf
            <div class="row">
              <div class="w-100" style="padding-left: 15px;">
                <p style=" font-style: normal; font-weight: 500; font-size: 30px; line-height: 45px; color: #000000 !important;">
                  @lang('lang.login')
                </p>
              </div>
              <!-- Email Address -->
              <div class="w-100" style="padding-left: 15px;">
                <p style=" font-style: normal; font-weight: 400; font-size: 16px; line-height: 24px; color: #000000; margin-bottom: 0px !important;">
                  @lang('lang.If_you_dont_have_an_account')
                </p>
                <p>
                  @lang('lang.you_can')
                  <a  class="text-warning contact ml-2" >Contact Admin!</a>
                </p>
              </div>
              <div class="input-group col-lg-12 mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                    <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1.49414 0H15.5059C16.3297 0 17 0.670272 17 1.49414V10.1529C17 10.9768 16.3297 11.6471 15.5059 11.6471H1.49414C0.670271 11.6471 0 10.9768 0 10.1529V1.49414C0 0.670272 0.670271 0 1.49414 0ZM1.68914 0.996094L1.88856 1.16214L7.90719 6.17386C8.25071 6.45987 8.74936 6.45987 9.09281 6.17386L15.1114 1.16214L15.3109 0.996094H1.68914ZM16.0039 1.71521L11.1001 5.79863L16.0039 9.06226V1.71521ZM1.49414 10.651H15.5059C15.7465 10.651 15.9478 10.4794 15.9939 10.2522L10.3014 6.46365L9.73018 6.93932C9.37377 7.23609 8.93685 7.38447 8.49997 7.38447C8.06308 7.38447 7.62619 7.23609 7.26976 6.93932L6.69853 6.46365L1.00605 10.2521C1.05221 10.4794 1.25348 10.651 1.49414 10.651ZM0.996094 9.06226L5.89993 5.79866L0.996094 1.71521V9.06226Z" fill="#000842" />
                    </svg>
                  </span>
                </div>
                <input id="email" type="email" name="email" placeholder="@lang('lang.enter_your_email_address')" class="border-top-0 border-right-0 border-dark form-control bg-white border-left-0 border-md" style="border-radius: 0px !important;" value="{{ old('email') ?? ''}}" />
                <div class="col-lg-12">
                  <div class="validation-error-email"></div>
                </div>
              </div>
              <!-- password -->
              <div class="input-group col-lg-12 mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                    <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M10.6318 7.2296V4.53742C10.639 3.31927 10.1524 2.14798 9.28387 1.29383C8.44414 0.457706 7.34492 0 6.18084 0C6.16282 0 6.14119 0 6.12317 0C3.64003 0.00360399 1.62179 2.03625 1.62179 4.53742V7.2296C0.684757 7.34132 0 8.12699 0 9.07844V15.1259C0 16.1531 0.821709 17 1.84884 17H10.4083C11.4354 17 12.2572 16.1531 12.2572 15.1259V9.07844C12.2535 8.13059 11.5688 7.34132 10.6318 7.2296ZM2.33899 4.53742H2.34259C2.34259 2.43269 4.04007 0.709985 6.12678 0.709985H6.13038C7.12148 0.706381 8.07293 1.09922 8.7757 1.79839C9.50731 2.52279 9.91457 3.51028 9.90736 4.53742V7.2332H9.11448V4.53742C9.12169 3.71931 8.79733 2.93364 8.21709 2.35701C7.66928 1.8092 6.92686 1.49926 6.152 1.49926H6.13038C4.47255 1.49926 3.13186 2.86156 3.13186 4.53381V7.2332H2.33899V4.53742ZM8.39729 4.53742V7.2332H3.85626V4.53742C3.85626 3.26161 4.87259 2.22366 6.13398 2.22366H6.15561C6.73945 2.22366 7.30167 2.45792 7.71613 2.87238C8.15582 3.31206 8.40449 3.91393 8.39729 4.53742ZM11.5688 15.1367C11.5688 15.7674 11.057 16.2792 10.4263 16.2792H1.86326C1.23256 16.2792 0.720797 15.7674 0.720797 15.1367V9.09646C0.720797 8.46576 1.23256 7.954 1.86326 7.954H10.4263C11.057 7.954 11.5688 8.46576 11.5688 9.09646V15.1367Z" fill="#000842" />
                    </svg>

                  </span>
                </div>
                <input id="password" type="password" name="password" placeholder="@lang('lang.enter_your_password')" class="border-top-0 border-right-0 form-control bg-white border-left-0 border-md border-dark" style="border-radius: 0px !important;" />
                <div class="input-group-append">
                  <span class="input-group-text bg-white border-md border-top-0 border-right-0 border-left-0 border-dark" style="border-radius: 0px !important;">
                    <button style="border: none; background: none; cursor: pointer;" type="button" id="eye">
                      <i class="fa fa-eye text-muted"></i>
                    </button>
                  </span>
                </div>
                <div class="col-lg-12">
                  <div class="validation-error-password"></div>
                </div>
              </div>
              <div class="input-group-append col-lg-12 mb-4 d-flex justify-content-between">
                <div class="input-group-text bg-white border-0">
                  <input type="checkbox" id="remember-me" name="remember_me" />
                  <label for="remember-me" class="m-0 ml-1">@lang('lang.remember_me')</label>
                </div>
                <div>
                  <a href="/forgot_password" class="btn btn-link ml-2" style="color: #212B60;">@lang('Change Password')?</a>
                </div>
              </div>
              @if (Session::has('password_changed'))
              <div class="alert alert-success">
                <button type="button" class="close ml-2" data-dismiss="alert">&times;</button>
                <strong>{{ session('password_changed') }}</strong>
              </div>
              @endif
              @if (Session::has('success'))
              <div class="alert alert-success">
                <button type="button" class="close ml-2" data-dismiss="alert">&times;</button>
                <strong>{{ session('success') }}</strong>
              </div>
              @elseif (Session::has('error'))
              <div class="alert alert-warning">
                <button type="button" class="close ml-2" data-dismiss="alert">&times;</button>
                <strong>{{ session('error') }}</strong>
              </div>
              @endif
              <!-- Submit Button -->
              <div class="form-group col-lg-12 mx-auto mb-0">
                <button type="submit" id="btn_user_login" class="font-weight-bold sign_up btn btn-block py-2 text-white" name="submit">
                  <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                  <span id="text">@lang('lang.signin')</span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- For Demo Purpose -->
      <div class="col-md-5 col-lg-5 pr-lg-5 d-none d-lg-block mb-5 mb-md-0">
        <div class="p-2 d-flex align-items-center justify-content-center" style="
          height: 90vh !important;
          border-radius: 15px;
        ">
          <!-- Make the image responsive -->
          <img class="img-fluid" src="{{ asset('assets/images/login-banner.png') }}" alt="banner image">
        </div>
      </div>
    </div>
  </div>

</html>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  // For Demo Purpose [Changing input group text on focus]
  $(document).ready(function() {
    $("#eye").on("click", function() {
      var passwordField = $("#password");
      var passwordFieldType = passwordField.attr("type");
      if (passwordFieldType == "password") {
        passwordField.attr("type", "text");
        $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
      } else {
        passwordField.attr("type", "password");
        $(this).find("i").removeClass("fa-eye-slash").addClass("fa-eye");
      }
    });

    //login user through API .... 
    $('#login-form').on('submit', function(e) {
      e.preventDefault();

      var email = $('#email').val();
      var password = $('#password').val();

      if (email === '' || password === '') {
        (email === '') ? $('.validation-error-email').empty().append('<label class="text-danger">* email is required</label>'): $('.validation-error-email').empty();
        (password === '') ? $('.validation-error-password').empty().append('<label class="text-danger">* password  is required</label>'): $('.validation-error-password').empty();
      } else {
        $('.validation-error-email').empty();
        $('.validation-error-password').empty();
        $('#btn_user_login').prop('disabled', true);

        var apiurl = $(this).attr('action');
        var csrfToken = '{{ csrf_token() }}';
        var formData = {
          email: $('#email').val(),
          password: $('#password').val(),
          _token: csrfToken
        };

        $.ajax({

          url: "/" + apiurl,
          type: 'POST',
          data: formData,
          beforeSend: function() {
            $('#spinner').removeClass('d-none');
            $('#text').addClass('d-none');
            showlogin('Wait', 'User Login...');
          },
          success: function(response) {

            $('#btn_user_login').prop('disabled', false);;
            var responseArray = JSON.parse(response);
            console.log(responseArray);
            $('#text').removeClass('d-none');
            $('#spinner').addClass('d-none');
            if (responseArray.status === 'success') {
              showAlert("Success", "Login Successfully", "success");

              setTimeout(function() {
                window.location.replace('/');
              }, 1200);
            } else if (responseArray.status === 'error') {
              // console.log(response.message);
              $('.error-label').remove();
              $.each(responseArray.message, function(field, errorMessages) {
                $.each(errorMessages, function(index, errorMessage) {
                  (field == 'email') ? $('.validation-error-email').empty().append('<label class="text-danger">*' + errorMessage + '</label>'): $('.validation-error-email').empty();
                  (field == 'password') ? $('.validation-error-password').empty().append('<label class="text-danger">*' + errorMessage + '</label>'): $('.validation-error-password').empty();
                });
              });

            } else {
              showAlert(responseArray.status, responseArray.message, "warning");
            }
          },

          error: function(xhr, status, error) {
            $('#btn_user_login').prop('disabled', false);
            $('#spinner').addClass('d-none');
            $('#text').removeClass('d-none');
            // console.error(xhr.responseText);
            showAlert("Error", "Please contact your admin", "warning");
          }

        });
      }
    });

    function showlogin(title, message) {
      login_alert = swal({
        title: title,
        content: {
          element: "div",
          attributes: {
            class: "custom-spinner"
          }
        },
        text: message,
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        onOpen: function() {
          $('.custom-spinner').addClass('spinner-border spinner-border-sm text-primary');
        },
        onClose: function() {
          $('.custom-spinner').removeClass('spinner-border spinner-border-sm text-primary');
        }
      });

      return login_alert;
    }

    function showAlert(title, message, type) {
      swal({
        title: title,
        text: message,
        icon: type,
        showClass: {
          popup: 'swal2-show',
          backdrop: 'swal2-backdrop-show',
          icon: 'swal2-icon-show'
        },
        hideClass: {
          popup: 'swal2-hide',
          backdrop: 'swal2-backdrop-hide',
          icon: 'swal2-icon-hide'
        },
        onOpen: function() {
          $('.swal2-popup').css('animation', 'swal2-show 0.5s');
        },
        onClose: function() {
          $('.swal2-popup').css('animation', 'swal2-hide 0.5s');
        }
      });

    }
    $('input').on('input', function() {
      $(this).removeClass('error');
      $(this).next('.error-label').remove();
    });


    var passwordInputs = $("input[type='password']");
    passwordInputs.each(function() {
      var passwordInput = $(this);
      var eyeButton = passwordInput.next(".input-group-append").find("#eye");

      eyeButton.on("keydown", function(event) {
        if (event.key === "Tab" && !event.shiftKey) {
          event.preventDefault();
          passwordInput.focus();
        }
      });

      passwordInput.on("keydown", function(event) {
        if (event.key === "Tab" && !event.shiftKey) {
          event.preventDefault();
          var formInputs = $("input");
          var currentIndex = formInputs.index(this);

          var nextInput = formInputs.eq(currentIndex + 1);
          while (nextInput.length && !nextInput.is(":visible")) {
            nextInput = formInputs.eq(currentIndex + 2);
            currentIndex++;
          }

          if (nextInput.length) {
            nextInput.focus();
          } else {
            formInputs.eq(0).focus();
          }
        }
      });
    });

  });
</script>