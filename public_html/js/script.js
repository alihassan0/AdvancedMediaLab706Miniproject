$(document).ready(function() {
  $(".login").click(function () {
  	  var ajaxurl = 'ajax.php',
	  data =  {'action': 'login','eMail': $("#userName").val(), 'password': $("#password").val()};
	  $.post(ajaxurl, data, function (response) {
	  	if(response == 0)
	  		window.location = "home.php";
	    else
	  		window.location = "signup.php";
	    alert(response);
	  });
  });

});