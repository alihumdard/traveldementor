<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Travel DeMentor</title>
  <style>
    /* Global styles */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f7f7f7;
      color: #333;
    }

    /* Container for the whole email */
    .container {
      width: 100%;
      max-width: 650px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
    }

    /* Header section */
    .header {
      display: flex;
      align-items: center;
      justify-content: start;
      margin-bottom: 20px;
    }

    .logo img {
      max-width: 250px;
      max-height: 200px;
      margin-right: 15px;
    }

    .company-name {
      font-size: 26px;
      font-weight: bold;
      color: #003366;
    }

    /* Message section */
    .message {
      padding: 25px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .message p {
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 20px;
      color: #444;
    }

    .message p strong {
      font-weight: 600;
      color: #003366;
    }

    /* Footer section */
    .footer {
      text-align: center;
      margin-top: 25px;
      font-size: 14px;
      color: #888;
    }

    .footer a {
      color: #003366;
      text-decoration: none;
    }

    /* Button style for footer */
    .footer a.button {
      display: inline-block;
      background-color: #003366;
      color: #ffffff;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Header with logo and company name -->
    <div class="header">
      <div class="logo">
        <!-- Replace with your logo URL -->
        <img src="{{ asset('assets/images/traveldementor.jpeg') }}" alt="Travel DeMentor Logo">
      </div>

    </div>

    <!-- Main message section -->
    <div class="message">
      <p><strong>{{ $maildata['title'] }}</strong>,</p>
      <p>
        @if(is_array($maildata['body']))
        @foreach($maildata['body'] as $line)
        {{ $line }}<br>
        @endforeach
        @else
        {{ $maildata['body'] }}
        @endif
      </p>
      <p>{{ $maildata['message'] }}</p>
      <p>Thank you for being part of our community. We are excited to have you with us!</p>
    </div>


    {{--
    <!-- Footer with company link and a button -->
    <div class="footer">
      <p>For more information, visit <a href="https://www.travelmentor.com" target="_blank">Travel DeMentor</a></p>
      <p><a href="https://www.travelmentor.com" class="button" target="_blank">Visit Our Website</a></p>
    </div> --}}
  </div>
</body>

</html>