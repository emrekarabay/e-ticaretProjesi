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
<div><?php require "../HTML/navbar.php" ?></div>
<div class="container ">
<div class="mt-3 align-self-center ">
    <?php
    $sorguOrders = $conn->prepare(" SELECT * FROM buy");
    $sorguOrders ->execute();
    $OrdersListele = $sorguOrders -> fetchall();

    $toplamGerceklesen = 0;
    $toplamBeklenen = 0;
    $toplamSatilanUrun =0;
    $toplamSatilmasiBeklenenUrun =0;

    foreach ($OrdersListele as $orders) {
        if($orders["durumu"] == "Teslim Edildi"){
            $toplamGerceklesen += $orders["price"];
            $toplamSatilanUrun++;
        }else{
            $toplamBeklenen += $orders["price"]*$orders["kacAdetUrun"];
            $toplamSatilmasiBeklenenUrun++;
        }
    }   ?>
    <div class="row mt-3">
        <div class="card text-center  col-5">
            <div class="card-header">
            Toplam Gerçekleşen Ciro
            </div>
            <div class="card-body">
                <h3><?php echo $toplamGerceklesen . " TL"  ?></h3>
            </div>
        </div>
        <div class="card text-center  col-5 ms-5">
            <div class="card-header">
                Toplam Beklenen Ciro
            </div>
            <div class="card-body">
                <h3><?php echo $toplamBeklenen . " TL"  ?></h3>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="card text-center  col-5">
            <div class="card-header">
                Toplam Satılan Ürün
            </div>
            <div class="card-body">
                <h3><?php echo $toplamSatilanUrun   ?></h3>
            </div>
        </div>
        <div class="card text-center  col-5 ms-5">
            <div class="card-header">
                Toplam Satılması Beklenen Ürün
            </div>
            <div class="card-body">
                <h3><?php echo $toplamSatilmasiBeklenenUrun  ?></h3>
            </div>
        </div>
    </div>
</div>
</div>
<div><?php require "../HTML/footer.php" ?></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
