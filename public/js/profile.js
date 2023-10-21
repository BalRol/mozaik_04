$(document).ready(function() {
    $('#profile-image').click(function() {
        document.getElementById("image-input").click();
    })
    $('#image-input').on('change', function() {
        const input = document.getElementById("image-input");
        const image = document.getElementById("profile-image");

        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    })
    $.ajax({
        url: '/profileShowAjax',
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(user) {
            document.querySelector('.name').textContent = user.user.username;
            document.querySelector('.email').textContent = user.user.email;
            $('#nameInput').val(user.user.username);
            $('#emailInput').val(user.user.email);
            $('#profile-image').attr('src', 'data:image/png;base64,' + user.user.image);
        },
        error: function() {
            swal("Something went wrong", "Please try again later.", "error");
        }
    });
    $('#save').click(function() {
        let $go = true;
        let $pwd = $('#newPassword').val();
        let $pwd_again = $('#newPasswordConfirmation').val();
        let formData = new FormData();

        if ($pwd !== $pwd_again) {
            swal("Something went wrong", "Passwords don't match", "error");
            $go = false;
        } else {
            formData.append('email', $('#emailInput').val());
            formData.append('name', $('#nameInput').val());
            formData.append('newPassword', CryptoJS.SHA256($pwd).toString());
            formData.append('oldPassword', CryptoJS.SHA256($('#oldPassword').val()).toString());

            // Ellenőrizd, hogy a fájlt feltöltötték-e, és ha igen, mentsd le
            let imageInput = $('#image-input')[0];
            if (imageInput.files.length > 0) {
                formData.append('image', imageInput.files[0]);
            }
        }
        if ($go) {
            $.ajax({
                url: '/profileAjax',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.message === 10) {
                        swal("Change successful", "The data has been successfully changed", "success");
                    }
                },
                error: function() {
                    swal("Something went wrong", "Please try again later.", "error");
                }
            });
        }
    });

    var change = 0;
    $('#changePassword').click(function() {
        if (change === 0) {
            change = 1;
            $('#profileForm').append(
                `<div class="card mb-4" id="changePasswordDiv" style="background-color: #111111; color:white;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Old password</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                  <input type="password" id="oldPassword" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">New password</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                  <input type="password" id="newPassword" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">New password confirmation</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                  <input type="password" id="newPasswordConfirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
            );
        } else if (change === 1) {
            change = 0;
            $('#changePasswordDiv').remove();
        }
    })
})
