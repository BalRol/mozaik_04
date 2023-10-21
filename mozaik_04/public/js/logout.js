$('#logout').click(function(){
    $.ajax({
        type: 'GET',
        url: '/logout', // A sütik törlését kezelő útvonal
        success: function (data) {
            if (data.success) {
                // Sütik sikeresen törölve
                swal("Logout success", "", "success");
                // Esetleges további műveletek, például átirányítás.
                window.location.href = '/'; // Átirányítás az alapértelmezett oldalra
            } else {
                // Sikertelen kijelentkezés
                swal("Something went wrong", "Please try again later.", "error");
            }
        },
        error: function () {
            swal("Something went wrong", "Please try again later.", "error");
        }
    });
})
