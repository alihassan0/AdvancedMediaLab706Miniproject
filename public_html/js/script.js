var alertMsg = '<div class="alert alert-danger" role="alert"> either your email or password are incorrect .. please try again</div>'
$(document).ready(function() {
  $(".login").click(function () {
  	  var ajaxurl = 'ajax.php',
	  data =  {'action': 'login','eMail': $("#userName").val(), 'password': $("#password").val()};
	  $.post(ajaxurl, data, function (response) {
	  	alert(response);
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
  $(".signup").click(function () {
  	  var ajaxurl = 'ajax.php',
	  data =  {'action': 'signup','eMail': $("#eMail").val(), 'password': $("#password").val() , 'firstname': $("#fName").val() , 'lastname': $("#lName").val()};
	  $.post(ajaxurl, data, function (response) {
	  	if(response == "ok")
	  	{
	  		window.location = "home.php";
	  	}	
	    else
	    {
	  		$(".error").empty();
            $(".error").append(alertMsg);
            $(".error").html(response);
	    }
	  });
  });
  $(".cart").click(function () {
  	var r = confirm("are you sure ._.");
  	if (r == true) {
  	  var ajaxurl = 'ajax.php';
  	  var id = $(this).attr("id")
	  data =  {'action': 'addtoCart','id': id, 'quantity': $("#quantity"+id).val()};
	  $.post(ajaxurl, data, function (response) {
	  	alert(response);
	  });
	 }
  });
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

function loadProducts() {
	  var ajaxurl = 'ajax.php';
	  data =  {'action': 'load_products'};
	  $.post(ajaxurl, data, function (response) {
		var products = JSON.parse(response);
		for (var i = 0; i < products.length; i++) {
			var product = $(".template");
			$(".template > .thumbnail > .productImage").attr("src",products[i].thumbnail);
			$(".template > .thumbnail > .caption > .productName").html(products[i].name);
			$(".template > .thumbnail > .caption > .productDescription").html(products[i].description);
			$(".template > .thumbnail > .caption > .productStock").html(products[i].stock);
			$(".template > .thumbnail > .caption > p > .productBuy").attr("id",products[i].id);
			$(".template > .thumbnail > .caption > p > .productQuantity").attr('id', 'quantity'+products[i].id);
			product.clone().removeClass("template").addClass(products[i].id).prependTo( ".row" );
		};
		$(".template").remove();
	  });
  };
function loadCartProducts() {
	  var ajaxurl = 'ajax.php';
	  data =  {'action': 'load_cart_products'};
	  $.post(ajaxurl, data, function (response) {
		var products = JSON.parse(response);
	  	var cost = 0;
		for (var i = 0; i < products.length; i++) {
			var txt = "";
			txt += "<td>"+i+"</td>";
			txt += "<td>"+products[i].thumbnail+"</td>";
			txt += "<td>"+products[i].quantity+"</td>";
			txt += "<td>"+products[i].price+"</td>";
			txt += "<td>"+ products[i].quantity*products[i].price +"</td>";
			cost += products[i].quantity*products[i].price;
			txt = "<tr>"+ txt + "</tr>";
			$('#myTable tr:last').after(txt);
			};
			$('#myTable').after("<p> the over all cost is "+cost+"</p>");
	  });
	};