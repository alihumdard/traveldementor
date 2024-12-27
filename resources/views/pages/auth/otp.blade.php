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
            color: #212B60 !important;
        }

        .text-warning.contact:hover {
            color: #184A45 !important;
        }

        #btn_user_login {
            background-color: #212B60;
            /* Initial color */
            transition: background-color 0.3s ease;
            /* Smooth transition */
        }

        #btn_user_login:hover {
            background-color: rgb(15, 26, 76);
            /* Change to a darker blue on hover */
        }

        #resend-otp button {
            color: #212B60;
        }
    </style>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">  -->
</head>

<body style="overflow-x: hidden;">
    <div class="container-fluid mx-2" style="margin-top: 20px !important;">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-6 ml-auto" style="height: 90vh !important; width: 100%;">
                <div>
                    <!-- Navbar Brand -->
                    <a class="navbar-brand">
                        <img src="{{asset('assets/images/traveldementor.jpeg')}}" width="350px" height="100px" alt="">
                    </a>
                </div>
                <div class="row mt-4">
                    <form action="login" method="post" class="w-100">
                        @csrf
                        <div class="row">
                            <div class="w-100" style="padding-left: 15px;">
                                <p style="font-weight: 500; font-size: 30px; line-height: 45px; color: #000000 !important;">
                                    Change your Password
                                </p>
                            </div>
                            <!-- Email Address -->
                            <div class="w-100" style="padding-left: 15px;">
                                <p style="font-weight: 400; font-size: 16px; line-height: 24px; color: #000000; margin-bottom: 0px !important;">
                                    Provide us your email if you want to change your password<br>
                                </p>
                                <br>
                            </div>
                            <div class="input-group col-lg-12 mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                </div>
                                <input id="email" type="email" name="email" placeholder="Enter your Email Address" class="border-top-0 border-right-0 border-dark form-control bg-white border-left-0 border-md" style="border-radius: 0px !important;" value="{{ old('email') ?? ''}}" />
                                <div class="col-lg-12">
                                    <div class="validation-error-email"></div>
                                </div>
                            </div>
                            <!-- OTP -->
                            <div class="input-group col-lg-12 mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white px-4 border-md border-right-0 border-left-0 border-top-0 border-dark" style="border-radius: 0px !important;">
                                        <i class="fa-solid fa-code"></i>
                                    </span>
                                </div>
                                <input id="otp" type="text" name="otp" placeholder="Enter your OTP" class="border-top-0 border-right-0 form-control bg-white border-left-0 border-md border-dark" style="border-radius: 0px !important;" />
                            </div>
                            <div class="col-lg-12">
                                <div class="validation-error-otp"></div>
                            </div>
                            <!-- Submit Button -->
                            <div class="form-group col-lg-12 mx-auto mb-0 d-flex justify-content-between mt-3">
                                <!-- Resend OTP Button -->
                                <button type="button" id="btn_resend_otp" class="font-weight-bold btn btn-light py-2 text-dark" name="resend">
                                    Resend OTP
                                </button>
                                <!-- Next Button -->
                                <button type="submit" id="btn_user_login" class="font-weight-bold sign_up btn btn-primary py-2 text-white flex-grow-1 ms-3" name="submit" style="max-width: 200px;">
                                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                                    <span id="text">Next</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Image Section (Visible only on large screens) -->
            <div class="col-md-5 col-lg-5 pr-lg-5 d-none d-lg-block mb-5 mb-md-0">
                <div class="p-2 d-flex align-items-center justify-content-center" style="height: 90vh !important; border-radius: 15px;">
                    <img class="img-fluid" src="{{ asset('assets/images/otp.png') }}" alt="banner image">
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

<!-- <script>
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
</script> -->