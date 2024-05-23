$(document).ready(function () {
	$("form").submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();

		$.post(
			"../../../transactionApp/controller/authentication/user-login.php",
			data,
			function (response) {
				var data = JSON.parse(response);

				if (data.login == "false") {
					swal("Email or password not registered!", "Please try again", "error");
					return;
				} else {
					swal("Login successful!", "Please enter ok!", "success").then(() => {
						location.href = "../../../transactionApp/view/test/login.html";
					});
				}
			}
		);
	});
});
