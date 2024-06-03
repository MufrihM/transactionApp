$(document).ready(function () {
	$(".create").submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();

		$.post(
			"../../transactionApp/controller/tools/transaksi.php?action=create",
			data,
			function () {
				Swal.fire({
					title: "Success!",
					text: "New transaksi added!",
					icon: "success",
				}).then((result) => {
					if (result.isConfirmed) {
						location.href = "../../transactionApp";
					}
				});
			}
		);
	});

	$(".update").submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();
		var transactionId = $(this).data("id");
		var oldTotal = $(this).data("oldtotal");
		var oldtype = $(this).data("oldtype");

		data +=
			"&id=" + transactionId + "&oldtotal=" + oldTotal + "&oldtype=" + oldtype;

		$.post(
			"../../transactionApp/controller/tools/transaksi.php?action=update",
			data,
			function () {
				Swal.fire({
					title: "Success!",
					text: "Transaksi Updated!",
					icon: "success",
				}).then((result) => {
					if (result.isConfirmed) {
						location.href = "../../transactionApp";
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
			"../../transactionApp/views/edit.php?token=" +
			urlGetParams;
	});

	$(".delete").click(function () {
		var transactionId = $(this).data("id");
		var transactionType = $(this).data("type");
		var transactionTotal = $(this).data("total");
		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.post(
					"../../transactionApp/controller/tools/transaksi.php?action=delete",
					{
						id: transactionId,
						type: transactionType,
						total: transactionTotal,
					},
					function () {
						Swal.fire(
							"Deleted!",
							"Transaksi has been deleted.",
							"success"
						).then((result) => {
							if (result.isConfirmed) {
								location.href =
									"../../transactionApp";
							}
						});
					}
				);
			}
		});
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
