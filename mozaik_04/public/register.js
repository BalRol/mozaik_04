$(document).ready(function() {
    $('#register').click(function() {
        let $pwd = $('#registerPassword').val();
        let $pwd_again = $('#registerPasswordAgain').val();
        let $go = true;
        if($pwd !== $pwd_again){
            swal("Registration failed!", "The two passwords do not match", "error");
            $go = false;
        }else if($pwd === ""){
            swal("Registration failed!", "Password empty", "error");
            $go = false;
        }else if($pwd_again === ""){
            swal("Registration failed!", "Password confirmation empty", "error");
            $go = false;
        }

        var registerAddParams = {
            name: $('#registerUsername').val(),
            email: $('#registerEmail').val(),
            pwd: CryptoJS.SHA256($pwd).toString(),
        };
        if($go){
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
                        swal("Registration failed!", "Username empty.", "error");
                    }else if(response.message === 2){
                        swal("Registration failed!", "Email empty.", "error");
                    }else if(response.message === 6){
                        swal("Registration failed!", "The email format not correct.\nCorrect format: test@example.com", "error");
                    }else if(response.message === 7){
                        swal("Registration failed!", "Username is alredy taken.", "error");
                    }else if(response.message === 8){
                        swal("Registration failed!", "Email is alredy taken.", "error");
                    }
                },
                error: function () {
                    swal("Something went wrong", "Please try again later.", "error");
                }
            });
        }
    })
})
