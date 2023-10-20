$(document).ready(function() {
    $('#createEvent').click(function(){
        window.location.href = '/event';
    });
    $('#searchEvent').click(function(){
        window.location.href = '/dashboard';
    });



    function myEvents(){
        $.ajax({
            type: 'GET',
            url: '/myEventsAjax',
            success: function (events) {
                if(events.userEvents.length !== 0){$('#myEvents').html("");}
                $.each(events.userEvents, function (index, event) {
                    if (event.image === '') {
                        event.image = "login_form.jpg"
                    } else {
                        event.image = "data:image/png;base64," + event.image;
                    }
                    if (event.userImage === '') {
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
                        <div class="card my-3 p-0" style=" background-color: #111111; color:white; max-width: 80%;">
                            <div class="card-body">
                                <h5 class="card-title"><img src="${event.userImage}" alt="avatar" class="rounded-circle img-fluid m-1" style="width: 50px; height: 50px;"><span>${event.username}</span></h5>
                            <p class="card-text"><small><span>${event.start_date}</span><span>${event.end_date}</span> | <span>${event.location}</span> | <span>${event.visibility}</span> | <span>${event.type}</span></small></p>
                            </div>
                            <img class="card-img-top" src="${event.image}" alt="Card image cap" style="max-height: 350px; max-width: 100%; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><span>${event.name}</span></h5>
                                <p class="card-text"><span>${event.description}</span></p>
                                <div class="pt-1"> <button class="btn btn-dark btn-lg btn-block" id="editEvent" type="button">Edit</button> </div>
                                <input type="hidden" id="event_id" value="${event.id}">
                            </div>
                        </div>
                    `)
                });
                if(events.userEvents.length !== 0) {
                    $('#myEvents').append(`
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button id="createEvent" type="button" class="btn btn-primary mx-auto d-block"
                                        style="display: block;">New event
                                </button>
                            </li>
                        </ul>
                    `);
                }
            },
            error: function () {
                swal("Something went wrong", "Please try again later.", "error");
            }
        });
    }

    function interestEvents(){
        $.ajax({
            type: 'GET',
            url: '/interestEventsAjax',
            success: function (events) {
                if(events.interestedEvents.length !== 0){$('#interestEvents').html("");}
                $.each(events.interestedEvents, function (index, event) {
                    if (event.image === '') {
                        event.image = "login_form.jpg"
                    } else {
                        event.image = "data:image/png;base64," + event.image;
                    }
                    if (event.userImage === '') {
                        event.userImage = "https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                    } else {
                        event.userImage = "data:image/png;base64," + event.userImage;
                    }
                    if (event.end_date === null) {
                        event.end_date = ""
                    } else {
                        event.end_date = " - " + event.end_date
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
                                <div class="pt-1"> <button class="btn btn-dark btn-lg btn-block" id="editEvent" type="button">Edit</button> </div>
                                <input type="hidden" id="event_id" value="${event.id}">
                            </div>
                        </div>
                    `)
                });
                if(events.interestedEvents.length !== 0) {
                    $('#interestEvents').append(`
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button id="searchEvent" type="button" class="btn btn-primary mx-auto d-block" style="display: block;">Search event</button>
                            </li>
                        </ul>
                    `);
                }
            },
            error: function () {
                swal("Something went wrong", "Please try again later.", "error");
            }
        });
    }

    myEvents();
    interestEvents();
})
