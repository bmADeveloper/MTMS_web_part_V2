$(document).ready(function(){

	$(".navbar-burger").click(function() {
      $(".navbar-burger").toggleClass("is-active");
      $(".navbar-menu").toggleClass("is-active");
  	});
  
  $("#lnkCancel").click(function () {
      $("#user_name").val('');
      $("#user_password").val('');
  });

  $('#loginForm').hide();

  $('#loginFormButton').click(function(){

    $('#loginForm').show();
    $('#intialDisplay').hide();

  });

  $('#formCancelButton').click(function(){

    $('#loginForm').hide();
    $('#intialDisplay').show();
    
  });

  



});

// var myIndex = 0;
// carousel();

// function carousel() {
//     var i;
//     var x = document.getElementsByClassName("mySlides");
//     for (i = 0; i < x.length; i++) {
//        x[i].style.display = "none";  
//     }
//     myIndex++;
//     if (myIndex > x.length) {myIndex = 1}    
//     x[myIndex-1].style.display = "block";  
//     setTimeout(carousel, 3000); // Change image every 2 seconds
// }