<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fix Your Funnel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{ asset('/js/login.js') }}"></script>
    </head>
    <body>
        <div id="login" class="container">
            <form id="login_form" class="form-horizontal" role="form" method="POST">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}"/>
                <div class="col-12 col-md-4 offset-md-4">
                    <div class="form-group">
                        <input id="email" class="form-control" name="email" type="email" placeholder="email"/>
                    </div>
                    <div class="form-group">
                        <input id="passowrd" class="form-control" name="password" type="password" placeholder="password"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block">Sign In</button>
                    </div>
                    <div id="error_message" class="collapse alert alert-danger">
                        There was a problem logging you in
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
