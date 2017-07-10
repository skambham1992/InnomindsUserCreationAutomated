$(document).ready(function(){
	$("#logout").on('click', function(){
		$.ajax({
			url : 'logout.php'
		}).then(function(success){
			console.log("success");
			window.location.href = 'ldap_auth.php';
		},function(error){
			console.log("error");
		})
	});
	
	
	// display the first div by default.
	$("#accordion .acc_tab").first().css('display', 'block');


	// Get all the links.
	var link = $("#accordion a");

	// On clicking of the links do something.
	link.on('click', function(e) {

		e.preventDefault();

		var a = $(this).attr("href");

		$(a).slideDown('fast');

		//$(a).slideToggle('fast');
		$("#accordion .acc_tab").not(a).slideUp('fast');
		
	});
});


			
