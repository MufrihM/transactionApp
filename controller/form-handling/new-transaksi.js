$(document).ready(function () {
	$("form").submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();

		$.post(
			"../../../transactionApp/controller/tools/transaksi.php?action=create",
			data,
			function () {
				Swal.fire({
					title: "Success!",
					text: "New transaksi added!",
					icon: "success",
				}).then((result) => {
					if (result.isConfirmed) {
                        location.href = "../../../transactionApp";
					}
				});
			}
		);
	});
});
