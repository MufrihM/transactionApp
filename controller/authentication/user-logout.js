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
					url: "http://localhost:3000/Main_Program/Web%20Programming/AJAX/project/transactionApp/controller/authentication/user-logout.php",
					success: function () {
						location.href =
							"http://localhost:3000/Main_Program/Web%20Programming/AJAX/project/transactionApp/view/test/login.php";
					},
				});
			}
		});
	});
});
