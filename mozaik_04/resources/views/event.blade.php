<?php
    if (!isset($_COOKIE['user'])) {
        header("Location: /");
        exit;
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Dashboard - Events</title>
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet">


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


        <script src="event.js"></script>
    </head>
    <body style="background-color: #2C2C2C;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myevents">My events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile">Profile</a>
                </li>
            </ul>
            <ul class="navbar-nav mx-3">
                <li class="nav-item">
                    <button id="logout" type="button" class="btn btn-danger" style="display: block;">Logout</button>
                </li>
            </ul>
          </div>
        </nav>
        <section id="myevents">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center" style="color:white;">
                    <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; " >
                        <div class="card-body">
                            <h5 class="card-title"><img id="profile-image" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid m-1" style="width: 50px; height: 50px;"><span class="name">Username</span></h5>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Date</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" id="startDateInput" class="form-control" placeholder="Start date">
                                        <input type="text" id="endDateInput" class="form-control" placeholder="End date">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Location</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" id="locationInput" class="form-control" placeholder="Location">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Visibility</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select id="visibilitySelect" class="selectpicker form-control" data-live-search="true">
                                            <option value="" selected="selected" disabled>-- Select one visibility --</option>
                                            <option value="Public">Public</option>
                                            <option value="Only me">Only me</option>
                                            <option value="Limited">Limited</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="limitedUsers"></div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Category</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select id="categorySelect" class="selectpicker form-control" data-live-search="true">
                                            <option value="" selected="selected" disabled>-- Select one category --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <img id="event_image" class="card-img-top" src="login_form.jpg" alt="Card image cap" style="max-height: 350px; max-width: 100%; object-fit: cover;">
                        <input type="file" id="event_input" accept="image/*" style="display: none" name="event_input">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Card Title</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" id="cardTitleInput" class="form-control" placeholder="Card title">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Description</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                          <textarea class="form-control" id="descriptionTextArea" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="pt-1 d-flex justify-content-between" id="buttons">
                                <button class="btn btn-success btn-lg" id="create" type="button">Create</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h1 class="mt-3" >Preview</h1>
                    <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; " >
                        <div class="card-body">
                            <h5 class="card-title"><img id="profile_image_preview" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid m-1" style="width: 50px; height: 50px;"><span class="name_preview">Username</span></h5>
                        <p class="card-text"><small><span class="startDatePreview">Date</span><span class="endDatePreview"></span> | <span class="locationPreview"></span> | <span class="visibilityPreview"></span> | <span class="categoryPreview"></span></small></p>
                        </div>
                      <img class="card-img-top" id="event_image_preview" src="login_form.jpg" alt="Card image cap" style="max-height: 350px; max-width: 100%; object-fit: cover;">
                      <div class="card-body">
                        <h5 class="card-title"><span class="cardTitlePreview"></span></h5>
                        <p class="card-text"><span class="descriptionPreview"></span></p>
                        <div class="pt-1"> <button class="btn btn-dark btn-lg btn-block" id="login" type="button" disabled>Interest</button> </div>
                      </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <script src="logout.js"></script>
</html>
