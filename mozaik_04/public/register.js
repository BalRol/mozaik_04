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
            success: function () {
                $('#message').append(`<?php swal("Sikeres regisztráció!", "", "success"); ?>`);
            },
            error: function () {
                $('#message').append(`<?php swal("Sikertelen regisztráció!", "", "error"); ?>`);
            }
        });
    })
})
