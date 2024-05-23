$(document).ready(function () {
	$("form").submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();
		var params = new URLSearchParams(data);

		// Access a specific value
		var password = params.get("password");
		var confirmPassword = params.get("confirm-password");

		if (password != confirmPassword) {
			swal("Password not match!", "Please check your password again", "error");
			return;
		}

		$.post(
			"../../../transactionApp/controller/authentication/user-register.php",
			data,
			function (response) {
				var data = JSON.parse(response);

				if (data.email_exists == "true") {
					swal("Email already exists!", "Please use another email", "error");
					return;
				} else {
					// script untuk menampilkan notifikasi
					$(".msg").html("User registration successful!");
					$(".alert").addClass("show");
					$(".alert").removeClass("hide");
					$(".alert").addClass("showAlert");
					setTimeout(function () {
						$(".alert").removeClass("show");
						$(".alert").addClass("hide");
					}, 5000);
				}
			}
		);
	});

	$(".close-btn").click(function () {
		$(".alert").removeClass("show");
		$(".alert").addClass("hide");
	});
});
