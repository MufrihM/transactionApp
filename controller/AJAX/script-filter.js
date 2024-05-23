var jenis = document.getElementById("jenis");
var data = document.getElementById("data");

jenis.addEventListener("change", function () {
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
        "./controller/filter-siswaApp.php?jenis=" + jenis.value,
        true
    );
    ObjAjax.send();
});
