var type = document.getElementById("type_transaksi");
var data = document.getElementById("ajax-type");

type.addEventListener("change", function () {
    // initiate ajax object
    var ObjAjax = new XMLHttpRequest();

    // check status ajax
    ObjAjax.onreadystatechange = function () {
        if (ObjAjax.readyState == 4 && ObjAjax.status == 200) {
            // do something with the response
            data.innerHTML = ObjAjax.responseText;
        }
    };

    ObjAjax.open(
			"get",
			"../controller/AJAX/filter-transaksi.php?type=" +
				type.value,
			true
		);
    ObjAjax.send();
});
