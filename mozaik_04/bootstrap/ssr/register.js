var myButton = document.getElementById("myButton");
var message = document.getElementById("message");
myButton.addEventListener("click", function() {
  var registerAddParams = {
    name: $("#registerUsername").val(),
    email: $("#registerEmail").val(),
    pwd: $("#registerPassword").val(),
    pwd_again: $("#registerPasswordAgain").val()
  };
  $.ajax({
    url: "/registerAjax",
    type: "POST",
    dataType: "json",
    data: registerAddParams,
    success: function() {
      message.append(`<?php swal("Sikeres regisztráció!", "", "success"); ?>`);
    },
    error: function() {
      message.append(`swal("Sikertelen regisztráció!", "", "error");`);
    }
  });
});
