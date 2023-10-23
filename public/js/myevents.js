$(document).ready(function() {
    function eventEdit() {
        $('.editEvent').click(function() {
            var eventId = $(this).closest('div').find('#event_id').val();
            $.ajax({
                type: 'GET',
                url: '/editEvent',
                dataType: 'json',
                data: {
                    eventId: eventId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    window.location.href = "/editor";
                },
                error: function() {
                    swal("Something went wrong", "Please try again later.", "error");
                }
            });
        });
        $('.deleteEvent').click(function() {
            var eventId = $(this).closest('div').find('#event_id').val();
            $.ajax({
                type: 'DELETE',
                url: '/deleteEvent',
                dataType: 'json',
                data: {
                    eventId: eventId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    myEvents();
                    interestEvents();
                    swal("Event deleted", "", "success");
                },
                error: function() {
                    swal("Something went wrong", "Please try again later.", "error");
                }
            });
        });
    }

    function myEvents() {
        $.ajax({
            type: 'GET',
            url: '/myEventsAjax',
            success: function(events) {
                $('#myEvents').html("");
                if (events.userEvents.length === 0) {
                    $('#myEvents').append(`
                        <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; ">
                            <div class="card-body">
                                <h5 class="card-title">This is where events you've created appear.</h5>
                            </div>
                        </div>
                    `);
                }
                $.each(events.userEvents, function(index, event) {
                    if (event.image === '') {
                        event.image = "img/login_form.jpg"
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
                    $('#myEvents').append(`
                        <div class="card my-3 p-0" style="background-color: #111111; color: white; max-width: 80%;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <img src="${event.userImage}" alt="avatar" class="rounded-circle img-fluid m-1" style="width: 50px; height: 50px;">
                                    <span>${event.username}</span>
                                </h5>
                                <p class="card-text">
                                    <small>
                                        <span>${event.start_date}</span>
                                        <span>${event.end_date}</span> |
                                        <span>${event.location}</span> |
                                        <span>${event.visibility}</span> |
                                        <span>${event.type}</span>
                                    </small>
                                </p>
                            </div>
                            <img class="card-img-top" src="${event.image}" alt="Card image cap" style="max-height: 350px; max-width: 100%; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><span>${event.name}</span></h5>
                                <p class="card-text"><span>${event.description}</span></p>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-dark btn-lg btn-block editEvent" type="button">Edit</button>
                                    <button class="btn btn-danger btn-lg btn-block deleteEvent" type="button">Delete</button>
                                    <input type="hidden" id="event_id" value="${event.id}">
                                </div>
                            </div>
                        </div>
                    `)
                });
                $('#myEvents').append(`
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button id="createEvent" type="button" class="btn btn-primary mx-auto d-block"
                                    style="display: block;">New event
                            </button>
                        </li>
                    </ul>
                `);
                eventEdit();
                $('#createEvent').click(function() {
                    $.ajax({
                        type: 'GET',
                        url: '/delCookieEvent',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            window.location.href = '/editor';
                        },
                        error: function() {
                            swal("Something went wrong", "Please try again later.", "error");
                        }
                    });
                });
            },
            error: function() {
                swal("Something went wrong", "Please try again later.", "error");
            }
        });
    }

    function eventInterest() {
        $('#interest').click(function() {
            var eventId = $(this).closest('div').find('#event_id').val();
            $.ajax({
                type: 'POST',
                url: '/_event',
                dataType: 'json',
                data: {
                    eventId: eventId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    interestEvents();
                },
                error: function() {
                    swal("Something went wrong", "Please try again later.", "error");
                }
            });
        });
    }

    function interestEvents() {
        $.ajax({
            type: 'GET',
            url: '/interestEventsAjax',
            success: function(events) {
                $('#interestEvents').html("");
                if (events.interestedEvents.length === 0) {
                    $('#interestEvents').append(`
                        <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%; ">
                            <div class="card-body">
                                <h5 class="card-title">This is where events you've interested appear.</h5>
                            </div>
                        </div>
                    `);
                }
                $.each(events.interestedEvents, function(index, event) {
                    if (event.image === '' || event.image === null) {
                        event.image = "img/login_form.jpg"
                    } else {
                        event.image = "data:image/png;base64," + event.image;
                    }
                    if (event.userImage === null || event.userImage === '') {
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
                        $text = "Uninterest"
                    } else {
                        $color = "dark";
                        $text = "Interest"
                    }
                    $('#interestEvents').append(`
                        <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%;">
                            <div class="card-body">
                                <h5 class="card-title"><img src="${event.userImage}" alt="avatar" class="rounded-circle img-fluid m-1" style="width: 50px; height: 50px;"><span>${event.username}</span></h5>
                            <p class="card-text"><small><span>${event.start_date}</span><span>${event.end_date}</span> | <span>${event.location}</span> | <span>${event.visibility}</span> | <span>${event.type}</span></small></p>
                            </div>
                            <img class="card-img-top" src="${event.image}" alt="Card image cap" style="max-height: 350px; max-width: 100%; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><span>${event.name}</span></h5>
                                <p class="card-text"><span>${event.description}</span></p>
                                <div class="pt-1"> <button class="btn btn-${$color} btn-lg btn-block" id="interest" type="button">${$text}</button>
                                <input type="hidden" id="event_id" value="${event.id}"></div>
                            </div>
                        </div>
                    `)
                });
                $('#interestEvents').append(`
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button id="searchEvent" type="button" class="btn btn-primary mx-auto d-block" style="display: block;">Search event</button>
                        </li>
                    </ul>
                `);
                eventInterest();
                $('#searchEvent').click(function() {
                    window.location.href = '/';
                });
            },
            error: function() {
                swal("Something went wrong", "Please try again later.", "error");
            }
        });
    }

    myEvents();
    interestEvents();

})
