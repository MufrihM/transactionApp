$(document).ready(function () {
	$("button").click(function () {
		Swal.fire({
			title: "Are you sure?",
			text: "You must login again!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Logout",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "./transactionApp/controller/authentication/user-logout.php",
					success: function () {
						location.href = "./transactionApp/views/login.php";
					},
				});
			}
		});
	});
});
