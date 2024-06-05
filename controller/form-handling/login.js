$(document).ready(function () {
	$("form").submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			type: "POST",
			url: "../../transactionApp/controller/authentication/user-login.php",
			data: data,
			// dataType: "json",
			success: function (response) {
				var data = JSON.parse(response);

				if (data.login == "false") {
					swal.fire({
						title: "Email or password is wrong",
						text: "Please check your email or password again!",
						icon: "error",
					});
					return;
				} else {
					Swal.fire({
						title: "Login successful!",
						text: "Please click ok!",
						icon: "success",
					}).then(() => {
						location.href = "../../transactionApp";
					});
				}
			},
			error: function (req, textStatus, errorThrown) {
				//this is going to happen when you send something different from a 200 OK HTTP
				alert("Ooops, something happened: " + textStatus + " " + errorThrown);
			},
		});

		// $.post(
		// 	"../../transactionApp/controller/authentication/user-login.php",
		// 	data,
		// 	function (response) {
		// 		var data = JSON.parse(response);

		// 		if (data.login == "false") {
		// 			swal.fire({
		// 				title: "Email or password is wrong",
		// 				text: "Please check your email or password again!",
		// 				icon: "error",
		// 			});
		// 			return;
		// 		} else {
		// 			Swal.fire({
		// 				title: "Login successful!",
		// 				text: "Please click ok!",
		// 				icon: "success",
		// 			}).then(() => {
		// 				location.href = "../../transactionApp";
		// 			});
		// 		}
		// 	}
		// );
	});
});
