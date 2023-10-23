$(document).ready(function() {
    $('#login').click(function() {
        var loginAddParams = {
            email: $('#email').val(),
            password: CryptoJS.SHA256($('#password').val()).toString(),

        };
        $.ajax({
            url: '/login',
            type: 'GET',
            dataType: 'json',
            data: loginAddParams,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.message === 10) {
                    swal("Login success", "", "success");
                    window.location.href = "/dashboard";
                }
            },
            error: function() {
                swal("Something went wrong", "Please try again later.", "error");
            }
        });
    })
})
