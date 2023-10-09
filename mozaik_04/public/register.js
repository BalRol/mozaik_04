$(document).ready(function() {
    $('#register').click(function() {
        var registerAddParams = {
            name: $('#registerUsername').val(),
            email: $('#registerEmail').val(),
            pwd: $('#registerPassword').val(),
            pwd_again: $('#registerPasswordAgain').val()
        };
        $.ajax({
            url: '/registerAjax',
            type: 'POST',
            dataType: 'json',
            data: registerAddParams,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if(response.message === 0) {
                    swal("Registration success!", "", "success");
                    $('#registerUsername').val('');
                    $('#registerEmail').val('');
                    $('#registerPassword').val('');
                    $('#registerPasswordAgain').val('');
                }else if(response.message === 1){
                    swal("Registration failed!", "Username empty", "error");
                }else if(response.message === 2){
                    swal("Registration failed!", "Email empty", "error");
                }else if(response.message === 3){
                    swal("Registration failed!", "Password empty", "error");
                }else if(response.message === 4){
                    swal("Registration failed!", "Password confirmation empty", "error");
                }else if(response.message === 5){
                    swal("Registration failed!", "The two passwords do not match", "error");
                }else if(response.message === 6){
                    swal("Registration failed!", "The email format not correct.\nCorrect format: test@example.com", "error");
                }
            },
            error: function () {
                swal("Something went wrong", "Please try again later.", "error");
            }
        });
    })
})
