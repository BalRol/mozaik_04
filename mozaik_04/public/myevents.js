$(document).ready(function() {
    $('#createEvent').click(function(){
        window.location.href = '/event';
    });


    $.ajax({
        type: 'GET',
        url: '/profileShowAjax',
        success: function (user) {
            document.querySelector('.name').textContent = user.user.username;
            $('#profile-image').attr('src', 'data:image/png;base64,' + user.user.image);
        },
        error: function () {
            swal("Something went wrong", "Please try again later.", "error");
        }
    });
})
