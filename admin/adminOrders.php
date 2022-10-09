<?php require "sessionControl.php" ?>
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
<div class="container">
    <table class="table table-sm mt-2">
        <thead>
        <tr>
            <th scope="col">Kullanıcı ID</th>
            <th scope="col">Ürün Resmi</th>
            <th scope="col">Ürün Adı</th>
            <th scope="col">Ürün Adeti</th>
            <th scope="col">Ödenen ücret</th>
            <th scope="col">Durumu</th>
            <th scope="col">Tarih</th>
        </tr>
        </thead>
        <!-- HTML Admin Tablo Başlıklar Bitiş -->
        <tbody class="table-group-divider">
        <!-- Admin Tablo Verileri Veritabanından Alma Başlangıç -->
        <?php
        $sorguOrders = $conn->prepare(" SELECT * FROM buy");
        $sorguOrders ->execute();
        $ordersListele = $sorguOrders -> fetchall();
        foreach ($ordersListele as $orders) { ?>
            <tr>
                <td><?php echo $orders['whoBuy']?></td>
                <td><img width="50px" height="50px" src='<?php echo $orders["photoUrl"]; ?>'></td>
                <td><?php echo $orders['title']?></td>
                <td><?php echo $orders['kacAdetUrun']?></td>
                <td><?php echo $orders['kacAdetUrun']*$orders['price']. " TL" ?></td>
                <td>
                    <form method="post" action="./adminControls.php">
                    <input type="hidden" name="id" value="<?php echo $orders['id']?>">
                        <input type="hidden" name="urunID" value="<?php echo $orders['urunID']?>">

                        <input type="hidden" name="kacAdetUrun" value="<?php echo $orders['kacAdetUrun']?>">

                        <div class="form-floating">
                        <select name = "siparisDurumu" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected disabled><?php echo $orders['durumu']?></option>
                            <option value="Siparis Onaylandi" >Sipariş Onaylandı</option>
                            <option value="Kargolandi" >Kargolandı</option>
                            <option value="Teslim Edildi" >Teslim Edildi</option>
                        </select>
                        <label for="floatingSelect">Sipariş Durumu</label>
                    </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary mt-3" name="adminUpdateStatusOfOrder" value="">Update Status</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-danger mt-3" name="adminDeleteOrder" value="<?php echo $orders['id']; ?>">Delete Order</button>

                            </div>
                        </div>

                </form></td>
                <td><?php echo $orders['siparisTarih'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
        <!-- Admin Tablo Verileri Veritabanından Alma Bitiş -->
    </table>
</div>
<div><?php require "../HTML/footer.php" ?></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>