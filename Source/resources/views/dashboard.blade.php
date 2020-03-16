@php
    $user = Session::get('user');
@endphp
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('/css/app.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('/js/image_upload.js') }}"></script>

@include('header')
<div id="dashboard" class="container">
    <div class="col-12 col-md-4 offset-md-4">
        <h1>Welcome, {{$user}}</h1>
        <h3>Upload Image</h3>
        <form id="image_upload" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}"/>
            <input type="file" name="file" id="file" accept="image/*" class="form-control">
            <button type="submit" name="submit" class="btn btn-info btn-block">UPLOAD</button>
        </form>
        <div id="success_message" class="collapse alert alert-success">
            Image upload successful!
        </div>
        <div id="error_message" class="collapse alert alert-danger">
        </div>
    </div>
</div>