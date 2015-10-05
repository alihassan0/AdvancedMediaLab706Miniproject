var alertMsg = '<div class="alert alert-danger" role="alert"> either your email or password are incorrect .. please try again</div>'
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
	  });
  });
});

function loadProducts() {
	  var ajaxurl = 'ajax.php',
	  data =  {'action': 'load_products'};
	  $.post(ajaxurl, data, function (response) {
		var products = JSON.parse(response);
		for (var i = 0; i < products.length; i++) {
			var product = $(".template");
			$(".template > .thumbnail > .productImage").attr("src",products[i].thumbnail);
			$(".template > .thumbnail > .caption > .productName").html(products[i].name);
			$(".template > .productDescription").html(products[i].description);
			product.clone().removeClass("template").addClass(products[i].id).prependTo( ".row" );
		};
		//$(".template").remove();
	  });
  };


