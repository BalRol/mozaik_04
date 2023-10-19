$(document).ready(function() {


    function handlePageChanges() {
        document.querySelector('.startDatePreview').textContent =$('#startDateInput').val();
        if($('#endDateInput').val() !== ""){
            document.querySelector('.endDatePreview').textContent = " - " + $('#endDateInput').val();
        }else{
            document.querySelector('.endDatePreview').textContent = "";
        }
        document.querySelector('.locationPreview').textContent =$('#locationInput').val();
        document.querySelector('.visibilityPreview').textContent =$('#visibilitySelect').val();
        document.querySelector('.categoryPreview').textContent =$('#categorySelect').val();
        document.querySelector('.cardTitlePreview').textContent =$('#cardTitleInput').val();
        document.querySelector('.descriptionPreview').textContent =$('#descriptionTextArea').val();
    }
    const observerConfig = { attributes: true, childList: true, subtree: true, characterData: true };
    const pageObserver = new MutationObserver(handlePageChanges);
    pageObserver.observe(document.body, observerConfig);
    document.addEventListener('input', function(event) {
        handlePageChanges();
    });


    $('#event_image').click(function() {
        document.getElementById("event_input").click();
    })
    $('#event_input').on('change', function() {
        const input = document.getElementById("event_input");
        const image = document.getElementById("event_image");
        const imagePreview = document.getElementById("event_image_preview");

        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                image.src = e.target.result;
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    })

    $('#visibilitySelect').on('change', function(){
        if ($('#visibilitySelect').val() === 'Limited') {
            $.ajax({
                type: 'GET',
                url: '/allUserAjax',
                dataType: 'json',
                success: function (users) {
                    $('#limitedUsers').append(`<hr><div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0">Select users</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                      <select class="form-control" id="selectLimitedUsers" multiple data-mdb-filter="true"> </select>
                                                    </div>
                                                </div>
                                            </div>`);
                    $.each(users.users, function(index, users) {
                        const option = document.createElement('option');
                        option.value = users.username;
                        option.text = users.username;
                        document.getElementById('selectLimitedUsers').appendChild(option);
                    });
                },
                error: function () {
                    swal("Something went wrong", "Please try again later.", "error");
                }
            });
        }else{
            const limitedUsersElement = document.getElementById('limitedUsers');
            while (limitedUsersElement.firstChild) {
                limitedUsersElement.removeChild(limitedUsersElement.firstChild);
            }
        }
    });

    let firstSelectedDate = null;
    $("#startDateInput").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        onSelect: function(dateText, inst) {
            firstSelectedDate = new Date(dateText);
            if (new Date() > new Date(firstSelectedDate)) {
                $("#startDateInput").val("");
                swal("Something went wrong", "Choosen date is in past.", "error");
            }
        }
    });

    $("#endDateInput").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        onSelect: function (dateText, inst) {
            if (firstSelectedDate === null) {
                $("#endDateInput").val("");
                swal("Something went wrong", "Choose the start date first.", "error");
            } else if (new Date(dateText) < firstSelectedDate) {
                $("#endDateInput").val("");
                swal("Something went wrong", "The start date must be earlier or on the same day as the end date.", "error");
            }
        }
    });

    $('#create').click(function(){
        $go = true;
        let formData = new FormData();
        if($('#startDateInput').val() === ""){swal("Something went wrong", "The start date can't be empty.", "error"); $go = false;}
        else{formData.append('start_date', $('#startDateInput').val());}
        if($('#endDateInput').val() === $('#startDateInput').val()){formData.append('end_date', "");}
        else{formData.append('end_date', $('#endDateInput').val());}
        if($('#cardTitleInput').val() === ""){swal("Something went wrong", "The event name can't be empty.", "error"); $go = false;}
        else{formData.append('nameInput', $('#cardTitleInput').val());}
        if($('#locationInput').val() === ""){swal("Something went wrong", "The location can't be empty.", "error"); $go = false;}
        else{formData.append('location', $('#locationInput').val());}
        let imageInput = $('#event_input')[0];
        if (imageInput.files.length > 0) {
            formData.append('image', imageInput.files[0]);
        }
        if($('#categorySelect').val() === null){swal("Something went wrong", "The category can't be empty.", "error"); $go = false;}
        else{formData.append('type', $('#categorySelect').val());}
        if($('#visibilitySelect').val() === null){swal("Something went wrong", "The visibility can't be empty.", "error"); $go = false;}
        else{formData.append('visibility', $('#visibilitySelect').val());}

        if($('#descriptionTextArea').val() === ""){swal("Something went wrong", "The description can't be empty.", "error"); $go = false;}
        else{formData.append('description', $('#descriptionTextArea').val());}
        const selectElement = document.getElementById('selectLimitedUsers');
        if(selectElement) {
            formData.append('allowed_users', Array.from(selectElement.selectedOptions).map(option => option.value));
        }
        if($go) {
            $.ajax({
                type: 'POST',
                url: '/createEvent',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (message) {
                    if (message.message === 10) {
                        swal("Event created", "", "success");
                    }
                },
                error: function () {
                    swal("Something went wrong", "Please try again later.", "error");
                }
            });
        }
    });


    $.ajax({
        type: 'GET',
        url: '/categoryAjax',
        dataType: 'json',
        success: function (categories) {
            $.each(categories.category, function(index, category) {
                const option = document.createElement('option');
                option.value = category.name;
                option.text = category.name;
                document.getElementById('categorySelect').appendChild(option);
            });
        },
        error: function () {
            swal("Something went wrong", "Please try again later.", "error");
        }
    });


    $.ajax({
        type: 'GET',
        url: '/profileShowAjax',
        success: function (user) {
            document.querySelector('.name').textContent = user.user.username;
            $('#profile-image').attr('src', 'data:image/png;base64,' + user.user.image);
            document.querySelector('.name_preview').textContent = user.user.username;
            $('#profile_image_preview').attr('src', 'data:image/png;base64,' + user.user.image);
        },
        error: function () {
            swal("Something went wrong", "Please try again later.", "error");
        }
    });
})
