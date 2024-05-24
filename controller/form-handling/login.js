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
					// script untuk menampilkan notifikasi
					$(".msg").html("Error: Email or password wrong!");
					$(".alert").addClass("show");
					$(".alert").removeClass("hide");
					$(".alert").addClass("showAlert");
					setTimeout(function () {
						$(".alert").removeClass("show");
						$(".alert").addClass("hide");
					}, 1000);
					return;
				} else {
					swal("Login successful!", "Please enter ok!", "success").then(() => {
						location.href = "../../../transactionApp";
					});
				}
			}
		);
	});
});
