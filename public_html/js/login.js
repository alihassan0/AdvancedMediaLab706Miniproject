$(document).ready(function() {
  $(".login").click(function () {
  	  var ajaxurl = 'ajax.php',
	  data =  {'action': 'login','eMail': 'alithephantom@gmail.', 'password': '25588100'};
	  $.post(ajaxurl, data, function (response) {
	    alert(response);
	  });
  });

});