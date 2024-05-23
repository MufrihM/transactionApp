$(document).ready(function () {
	// $("form").submit(function (event) {
	// 	event.preventDefault();
	// 	var data = $(this).serialize();
	// 	$.post("../../../transactionApp/controller/authentication/user-register.php", data, function () {
	// 		swal(
	// 			"Akun berhasil didaftarkan",
	// 			"Klik login untuk melanjutkan!",
	// 			"success",
	// 			// {
	// 			// 	button: "Login",
	// 			// }
	// 		).then(() => {
	// 			location.href = "../../view/test/register.php";
	// 		});
	// 	});
	// });

	$("form").submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();
		$.post(
			"../../../transactionApp/controller/authentication/user-register.php",
			data,
			function () {
				// script untuk menampilkan notifikasi
				$(".alert").addClass("show");
				$(".alert").removeClass("hide");
				$(".alert").addClass("showAlert");
				setTimeout(function () {
					$(".alert").removeClass("show");
					$(".alert").addClass("hide");
				}, 5000);
			}
		);
	});

	$(".close-btn").click(function () {
		$(".alert").removeClass("show");
		$(".alert").addClass("hide");
	});
});
