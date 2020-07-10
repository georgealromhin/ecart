<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order completed successfully</title>
    <link rel="icon" type="image/ico" href="{{url('favicon.ico') }}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="text-center mt-5">
        <img src="{{asset('images/success_tick.png')}}" alt="success_tick">
        <h3>Order completed successfully</h3>
        <h4>Order Number: {{$order_number}}</h4>
        <h4>An automated email was sent to {{$email}}</h4>
        <a class="btn btn-primary" href="{{url('/')}}">Go To Home Page</a>
    </div>
</body>
</html>

