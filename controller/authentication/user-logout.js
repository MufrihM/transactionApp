$(document).ready(function () {
	$("#logout").click(function () {
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
					url: "../controller/authentication/user-logout.php",
					success: function () {
						location.href = "../views/login.php";
					},
				});
			}
		});
	});
});
