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
                Teslim Edilen Sipariş
            </div>
            <div class="card-body">
                <h3><?php echo $toplamSatilanUrun   ?></h3>
            </div>
        </div>
        <div class="card text-center  col-5 ms-5">
            <div class="card-header">
                Teslim Edilmeyi Bekleyen Sipariş
            </div>
            <div class="card-body">
                <h3><?php echo $toplamSatilmasiBeklenenUrun  ?></h3>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="card text-center  col-5">
            <div class="card-header">
                Stoğu Azalan Ürünler
            </div>
            <div class="card-body">
                <table class="table table-sm mt-2">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Stock</th>

                    </tr>
                    </thead>
                    <!-- HTML Admin Tablo Başlıklar Bitiş -->
                    <tbody class="table-group-divider">
                    <!-- Admin Tablo Verileri Veritabanından Alma Başlangıç -->
                    <?php
                    $sorguProducts = $conn->query("SELECT * FROM `letgo` ORDER BY `letgo`.`stock` ASC LIMIT 5");
                    $productsListele = $sorguProducts -> fetchall();
                    foreach ($productsListele as $products) {

                        ?>
                    <tr>
                        <form method="POST" action="./adminControls.php">
                            <td><input type="hidden" name="id" value="<?php echo $products['id']?>"><?php echo $products['id']?></td>
                            <td><img width="50px" height="50px" src='<?php echo $products["photoUrl"]; ?>'></td>
                            <td><?php echo $products['stock']?></td>



                        <?php } ?>

                    </tr>

                    </tbody>
                    <!-- Admin Tablo Verileri Veritabanından Alma Bitiş -->
                </table>
                <input class="btn btn-info text-light" type="submit" name="adminStockUpdate" value="Stock Update">
                </form>
            </div>
        </div>
        <div class="card text-center  col-5 ms-5">
            <div class="card-header">
                Sepetinde Ürün Unutanlar
            </div>
            <div class="card-body">
                <table class="table table-sm mt-2">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cart Sum</th>
                        <th scope="col">Operation</th>
                    </tr>
                    </thead>
                    <!-- HTML Admin Tablo Başlıklar Bitiş -->
                    <tbody class="table-group-divider">
                    <!-- Admin Tablo Verileri Veritabanından Alma Başlangıç -->
                    <?php
                    $sorguUsers = $conn->query("SELECT * FROM users");
                    $usersListele = $sorguUsers -> fetchall();

                    foreach ($usersListele as $user) {
                        $sumOfCard=0;
                        $sorguCard = $conn->prepare("SELECT * FROM card WHERE whoBuy=? ");
                        $sorguCard ->execute([$user["id"]]);
                        $numberOfRow = $sorguCard -> rowCount();
                        if($numberOfRow > 0) {
                            $cardListele = $sorguCard->fetchall();
                            foreach ($cardListele as $card) {
                                $sumOfCard += $card["price"];
                            }
                    ?>
                    <tr>
                        <form method="POST" action="./adminControls.php">
                            <td><input type="hidden" name="id" value="<?php echo $user['id']?>"><?php echo $user['id']?></td>
                            <td><?php echo $sumOfCard ." TL" ?></td>
                            <?php
                            $sorguCoupons = $conn->prepare(" SELECT * FROM userscoupons WHERE whoUser=? and couponsTitle=?");
                            $sorguCoupons ->execute([$user["id"],"Diamond Coupon"]);
                            $numberOfRow2 = $sorguCoupons -> rowCount();
                            if($numberOfRow2 == 0){
                            $couponsListele = $sorguCoupons -> fetch();
                            ?>
                            <td><input class="btn btn-info text-light" type="submit" name="getCouponForCart" value="Get Coupon"></td>
                                <?php }else{ ?>

                                <td>This user has a <b>diamond Coupon</b></td>
                        </form>
                    </tr>
                            <?php } } } ?>



                    </tbody>
                    <!-- Admin Tablo Verileri Veritabanından Alma Bitiş -->
                </table>

            </div>
        </div>
    </div>
</div>
</div>
<div><?php require "../HTML/footer.php" ?></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
