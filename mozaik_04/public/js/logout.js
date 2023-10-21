$('#logout').click(function() {
    $.ajax({
        type: 'GET',
        url: '/logout',
        success: function(data) {
            if (data.success) {
                swal("Logout success", "", "success");
                window.location.href = '/';
            } else {
                swal("Something went wrong", "Please try again later.", "error");
            }
        },
        error: function() {
            swal("Something went wrong", "Please try again later.", "error");
        }
    });
})
