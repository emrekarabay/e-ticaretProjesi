<?php require "sessionControl.php"; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<div>
    <?php require "../HTML/navbar.php" ?>
</div>
<?php require "userCartRight.php"?>



<div class="container">
    <div class="row">
    <?php

    $sorguUserCoupons = $conn-> prepare(" select * from userscoupons  WHERE whoUser=?");
    $sorguUserCoupons -> execute([$_SESSION['id']]);
    $couponsListele = $sorguUserCoupons -> fetchAll();
    foreach ($couponsListele as $coupons) {
    ?>
    <div class="col-md-6 mt-3">
        <div class="card mb-5">
            <div class="card-header text-center fw-bold h3"><?php echo $coupons["couponsDiscountRate"] ?>% OFF</div>
            <div class="card-body">
                <h4 class="card-title text-center"><?php echo $coupons["couponsTitle"] ?></h4>
                <!-- Text -->
                <p class="card-text mt-2">1. The amount of discounts is limited.</p>
                <div class="text-center">
                    <!--Copy coupon wrapper-->
                    <div class="d-inline-flex inline mt-2 flex-wrap justify-content-center">

                        <!--Coupon code-->
                        <code class="h2 border rounded py-1 px-5 flex-item me-2 w-100 text-center text-danger"><?php echo $coupons["couponsCode"] ?></code>
                        <br>

                        <!--Copy to clipboard-->
                    </div>
                </div>

            </div>
        </div>

    </div>
    <?php  } ?>
</div>
</div>
<div>

    <?php require "../HTML/footer.php" ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>

