<?php
require 'assets/php/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

if (!$sql = mysqli_query($mysql, 'select * from tbl_products')) {
    return die('MySql Error: ' . mysqli_error($mysql));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAMPLE CURD - LOGIN</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/crud.css">
</head>

<body style="height: 100%">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="crud.php">SAMPLE CRUD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ml-auto">
                <button id="btn_logout" type="button" class="btn btn-secondary my-2 my-sm-0">Logout</button>
            </ul>
        </div>
    </nav>
    <div class="container h-100" style="margin-top: 5rem">
        <div class="row h-100">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <strong>Product Listing</strong>    
                        <button class="btn btn-outline-primary float-right">CREATE</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="dt_products" class="table table-bordered table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>PRICE</th>
                                    <th style="width: 1%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!mysqli_num_rows($sql)) {
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center">NO PRODUCTS FOUND</td>
                                    </tr>
                                    <?php
                                } else {
                                    foreach(mysqli_fetch_all($sql, MYSQLI_ASSOC) as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id']?></td>
                                            <td><?php echo $row['name']?></td>
                                            <td><?php echo $row['description']?></td>
                                            <td><?php echo $row['price']?></td>
                                            <td style="width: 1%; white-space: nowrap">
                                                <button class="btn btn-outline-primary">EDIT</button>
                                                <button class="btn btn-outline-danger">DELETE</button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/crud.js"></script>
    <script>
        $("#btn_logout").on("click", function () {
            var result = confirm("Are you sure that you want to logout?");

            if (result) {
                $.ajax({
                    url: "<?php phpLink('logout.php') ?>",
                    method: "post",
                    success: function (response) {
                        alert(response.message);
                        if (response.status == "success") {
                            window.location.href = "login.php";
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>