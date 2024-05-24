$(document).ready(function () {
    $("button").click(function () {
        $.ajax({
            url: "http://localhost:3000/Main_Program/Web%20Programming/AJAX/project/transactionApp/controller/authentication/user-logout.php",
            success: function (result) {
                location.href =
                    'http://localhost:3000/Main_Program/Web%20Programming/AJAX/project/transactionApp/view/test/login.php';
            }
        });
    });
});