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
        <script src="{{ asset('/js/images.js') }}"></script>
    </head>
    <body>
        @include('header')
        <div id="images" class="container">
                <div class="row button_sort">
                    <div class="col-12">
                        <h3>Sort</h3>
                        <button id="name_asc" type="button" class="btn btn-info">Name Asc</button>
                        <button id="name_desc" type="button" class="btn btn-info">Name Desc</button>
                        <button id="date_asc" type="button" class="btn btn-info">Date Asc</button>
                        <button id="date_desc" type="button" class="btn btn-info">Date Desc</button>
                    </div>
                </div>
                <div class="row">
                    <form id="search_images_form">
                        <div class="col-12">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}"/>
                            <div class="form-control">
                                <input id="search" class="form-control" name="search" type="text" placeholder="Search"/>
                            </div>
                            <button class="btn btn-info search_images btn-block" type="button">Search</button>
                            <button class="btn btn-primary clear_search btn-block" type="button">Clear Search</button>
                        </div>
                    </form>
                </div>
            <div class="row">
                @if (isset($data['images'], $data['comments']))
                    @foreach ($data['images'] as $image)
                        @if (isset($image->image_id, $image->thumbnail, $image->path, $image->date_uploaded, $image->username, $image->user_id))
                            <div class="col-12 col-md-6">
                                <h3 id="{{$image->image_id}}">{{$image->name}}</h3>
                                @if (Session::get('user-id') == $image->user_id)
                                    <button class="btn btn-info edit_name btn-block" type="button">Edit</button>
                                @endif
                                <img data-imageid="{{$image->image_id}}" class="images img-fluid" src="{{$image->thumbnail}}" data-thumbnail="{{$image->thumbnail}}" data-path="{{$image->path}}"/>
                                <p>Uploaded by {{$image->username}}</p>
                                <p>Uploaded {{$image->date_uploaded}}</p>
                                <h4>Comments:</h4>
                                @foreach ($data['comments'] as $comment)
                                    @if (isset($comment->image_id, $comment->comment, $comment->username))
                                        @if ($image->image_id == $comment->image_id)
                                            <p>{{$comment->comment}}</p>
                                            <p>Posted by {{$comment->username}}</p>
                                        @endif
                                    @endif
                                @endforeach
                                <button class="btn btn-secondary add_comment btn-block" type="button">Add Comment</button>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="image_modal modal row" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-body">
                        <img id="modal_image"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <div id="edit_name" class="modal row" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-body">
                        <form id="edit_name_form" class="form-horizontal" role="form" method="POST">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" id="image_id" name="id" value=""/>
                            <div class="form-control">
                                <input id="name" class="form-control" name="name" type="text" placeholder="image name"/>
                            </div>
                            <div id="#error_message"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="save_name" type="button" class="btn btn-success">Save</button>
                        <button id="cancel" type="button" class="btn btn-secondary">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <div id="add_comment" class="modal row" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-body">
                        <form id="add_comment_form" class="form-horizontal" role="form" method="POST">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" id="comment_image_id" name="image_id" value=""/>
                            <div class="form-control">
                                <input id="comment" class="form-control" name="comment" type="textarea" placeholder=""/>
                            </div>
                            <div id="#error_message"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="save_comment" type="button" class="btn btn-success">Save</button>
                        <button id="cancel_comment" type="button" class="btn btn-secondary">Close</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
