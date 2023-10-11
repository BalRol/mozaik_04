<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Events</title>
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
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
                            <div class="col-md-6 col-lg-5 d-none d-md-block"> <img src="login_form.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height:100%;" /> </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <div class="d-flex align-items-center mb-1 pb-1"> <img alt="logo" class="img-fluid" src="bird.png"></img> <span class="h1 fw-bold mb-0">Events</span> </div>
                                    <h5 class="fw-normal " style="letter-spacing: 1px;">Register your account</h5>
                                    <div class="form-outline"> <input type="username" id="registerUsername" name="name" class="form-control form-control-lg" /> <label class="form-label" for="registerUsername">Username</label> </div>
                                    <div class="form-outline"> <input type="email" id="registerEmail" name="email" class="form-control form-control-lg" /> <label class="form-label" for="registerEmail">Email address</label> </div>
                                    <div class="form-outline"> <input type="password" id="registerPassword" name="password" class="form-control form-control-lg" /> <label class="form-label" for="registerPassword">Password</label> </div>
                                    <div class="form-outline"> <input type="password" id="registerPasswordAgain" name="password_confirmation" class="form-control form-control-lg" /> <label class="form-label" for="registerPasswordAgain">Password confirmation</label> </div>
                                    <div class="pt-1 mb-4"> <button id="register" class="btn btn-dark btn-lg btn-block" type="button">Register</button> </div>
                                    <p style="color: #393f81;">You have an account? <a href="/" style="color: #393f81;">Login here</a></p>
                                    <div id="message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="register.js"></script>
</body>
</html>
