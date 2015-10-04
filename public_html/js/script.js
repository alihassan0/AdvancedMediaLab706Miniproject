$(document).ready(function() {
  $(".login").click(function () {
  	  var ajaxurl = 'ajax.php',
	  data =  {'action': 'login','eMail': $("#userName").val(), 'password': $("#password").val()};
	  $.post(ajaxurl, data, function (response) {
	  	if(response == 0)
	  	{
	  		window.location = "home.php";
	  	}	
	    else
	    {
	  		$(".error").empty();
            $(".error").append(alertMsg);
	    }
	    alert("nmr");
	  });
  });
});
var alertMsg = '<div class="alert alert-danger" role="alert"> either your email or password are incorrect .. please try again</div>'


$(document).ready(function() {
  $(".signup").click(function () {
  	  var ajaxurl = 'ajax.php',
	  data =  {'action': 'signup','eMail': $("#eMail").val(), 'password': $("#password").val() , 'firstname': $("#fName").val() , 'lastname': $("#lName").val()};
	  $.post(ajaxurl, data, function (response) {
	  	if(response == 0)
	  	{
	  		window.location = "home.php";
	  	}	
	    else
	    {
	  		$(".error").empty();
            $(".error").append(alertMsg);
	    }
	    alert("asd");
	  });
  });
}); 

$(document).ready(function() {
  $(".editprofile").click(function () {
  	  var ajaxurl = 'ajax.php',
	  data =  {'action': 'editprofilr','eMail': $("#eMail").val(), 'password': $("#password").val() , 'firstname': $("#fName").val() , 'lastname': $("#lName").val() 
	                                  ,'avatar': $("#avatar").val() , 'newpassword' : ("#newpassword")};
	  $.post(ajaxurl, data, function (response) {
	  	if(response == 0)
	  	{
	  		window.location = "home.php";
	  	}	
	    else
	    {
	  		$(".error").empty();
            $(".error").append(alertMsg);
	    }
	    alert("asd");
	  });
  });
}); 