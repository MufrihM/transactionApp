$(document).ready(function () {
	$(".create").submit(function (event) {
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
						location.href = "../../../transactionApp/view/test/dashboard.php";
					}
				});
			}
		);
	});

	$(".update").submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();
		var transactionId = $(this).data("id");
		console.log(transactionId);

		$.post(
			"../../../transactionApp/controller/tools/transaksi.php?action=update&id=" +
				transactionId,
			data,
			function () {
				Swal.fire({
					title: "Success!",
					text: "Transaksi Updated!",
					icon: "success",
				}).then((result) => {
					if (result.isConfirmed) {
						location.href = "../../../transactionApp/view/test/dashboard.php";
					}
				});
			}
		);
	});

	$(".edit").click(function () {
		var transactionId = $(this).data("id");
		const firstRandomString = generateRandomString(10);
		const secondRandomString = generateRandomString(10);
		const urlGetParams =
			firstRandomString + "" + transactionId + "" + secondRandomString;

		location.href =
			"../../../transactionApp/view/test/update-transaksi.php?id=" +
			urlGetParams;
	});
});

function generateRandomString(length) {
	const characters =
		"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	let result = "";
	const charactersLength = characters.length;
	for (let i = 0; i < length; i++) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	}
	return result;
}
