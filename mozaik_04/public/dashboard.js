$(document).ready(function() {
    function eventInterest() {
        $('.interest').click(function () {
            var eventId = $(this).closest('div').find('#event_id').val();
            $.ajax({
                type: 'POST',
                url: '/interestEvent',
                dataType: 'json',
                data: {eventId: eventId},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    eventsLoad();
                },
                error: function () {
                    swal("Something went wrong", "Please try again later.", "error");
                }
            });
        });
    }

    function eventsLoad() {
        $.ajax({
            url: '/dashboardAjax',
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (events) {
                $('#dashboard_insert').html("");
                $.each(events.event, function (index, event) {
                    if (event.image === '') {
                        event.image = "login_form.jpg"
                    } else {
                        event.image = "data:image/png;base64," + event.image;
                    }
                    if (event.userImage === null) {
                        event.userImage = "https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                    } else {
                        event.userImage = "data:image/png;base64," + event.userImage;
                    }
                    if (event.end_date === null) {
                        event.end_date = ""
                    } else {
                        event.end_date = " - " + event.end_date
                    }
                    if (event.is_interested === 1) {
                        $color = "danger";
                        $text = "Not interest"
                    } else {
                        $color = "dark";
                        $text = "Interest"
                    }
                    $('#dashboard_insert').append(`
                    <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; " >
                        <div class="card-body">
                            <h5 class="card-title"><img src="${event.userImage}" alt="avatar" class="rounded-circle img-fluid m-1" style="width: 50px; height: 50px;"><span>${event.username}</span></h5>
                        <p class="card-text"><small><span>${event.start_date}</span><span>${event.end_date}</span> | <span>${event.location}</span> | <span>${event.visibility}</span> | <span>${event.type}</span></small></p>
                        </div>
                        <img class="card-img-top" src="${event.image}" alt="Card image cap" style="max-height: 350px; max-width: 100%; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><span>${event.name}</span></h5>
                            <p class="card-text"><span>${event.description}</span></p>
                            <div class="pt-1"> <button class="btn btn-${$color} btn-lg btn-block interest" class="" type="button">${$text}</button>
                            <input type="hidden" id="event_id" value="${event.id}"></div>
                        </div>
                    </div>
                    `)
                })
                eventInterest();
            },
            error: function () {
                swal("Something went wrong", "Please try again later.", "error");
            }
        });
    }
    eventsLoad();
})
