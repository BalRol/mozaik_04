<?php
    if (isset($_COOKIE['user'])) {
        header("Location: /");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Events</title>
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
</head>

<body>
    <section class="vh-100" style="background-color: #2C2C2C;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block"> <img src="img/login_form.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height:100%;" /> </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form>
                                        <div class="d-flex align-items-center mb-3 pb-1"> <img alt="logo" class="img-fluid" src="img/bird.png"></img> <span class="h1 fw-bold mb-0">Events</span> </div>
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                                        <div class="form-outline mb-4"> <label class="form-label" for="email">Email address</label> <input type="email" id="email" name="email" class="form-control form-control-lg" /> </div>
                                        <div class="form-outline mb-4"> <label class="form-label" for="password">Password</label><input type="password" id="password" name="password" class="form-control form-control-lg" />  </div>
                                        <div class="pt-1 mb-4"> <button class="btn btn-dark btn-lg btn-block" id="login" type="button">Login</button> </div>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register" style="color: #393f81;">Register here</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/login.js"></script>
</body>

</html>
