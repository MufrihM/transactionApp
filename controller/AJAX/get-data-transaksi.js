$(document).ready(function() {

    $.ajax({
			url: "http://localhost:3000/Main_Program/Web%20Programming/AJAX/project/transactionApp/controller/AJAX/get-data-transaksi.php",
			success: function (data) {
				$("tbody").append(data);
			},
		});

});