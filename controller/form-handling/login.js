$(document).ready(function () {
	$("form").submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();

		$.post(
			"../../transactionApp/controller/authentication/user-login.php",
			data,
			function (response) {
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
			}
		);
	});
});
