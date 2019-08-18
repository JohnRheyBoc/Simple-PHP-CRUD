<?php
require 'assets/php/config.php';

if(isset($_SESSION['user'])) {
    header("Location: crud.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAMPLE CURD - REGISTER</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/crud.css">
</head>

<body style="height: 100%">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-md-5 col-12 my-auto mx-auto">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <form action="#" method="post" id="frm_register">
                            <h3>Register</h3>
                            <div class="form-group">
                                <label>Username: *</label>
                                <input name="username" type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label>Password: *</label>
                                <input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label>Name *:</label>
                                <input name="name" type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <button id="btn_register" type="button" class="btn btn-outline-primary shadow">Register</button>
                                <a href="login.php" class="btn btn-link float-right">Click Here to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/crud.js"></script>
    <script>
        $("#btn_register").on("click", function() {
            $.ajax({
                url: "<?php phpLink('register.php') ?>",
                method: "post",
                data: $("#frm_register").serialize(),
                success: function(response) {

                    alert(response.message);

                    if(response.status == "success") {
                        window.location.href = "login.php";
                    }
                }
            });
        });
    </script>
</body>

</html>