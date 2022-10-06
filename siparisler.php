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
    <?php require "HTML/navbar.php"?>
</div>
<div>
    <table class="table table-sm mt-2">
        <thead>
        <tr>
            <th scope="col">Ürün Resmi</th>
            <th scope="col">Ürün Adı</th>
            <th scope="col">Ödenen ücret</th>
            <th scope="col">Ürün Adeti</th>
            <th scope="col">Durumu</th>
            <th scope="col">Tarihi</th>
            <th scope="col">Düzenle</th>
        </tr>
        </thead>
        <!-- HTML Admin Tablo Başlıklar Bitiş -->
        <tbody class="table-group-divider">
        <!-- Admin Tablo Verileri Veritabanından Alma Başlangıç -->
        <?php
        $sorguUsers = $conn->prepare(" select * from buy where whoBuy=? ");
        $sorguUsers ->execute([$_SESSION["id"]]);
        $usersListele = $sorguUsers -> fetchall();
        foreach ($usersListele as $user) { ?>
        <tr>
            <input type="hidden" name="id" value="<?php echo $user['id']?>">
            <td><img width="70px" height="50px" src='<?php echo $user["photoUrl"]; ?>'></td>
            <td><?php echo $user['title']?></td>
            <td><?php echo $user['kacAdetUrun']*$user['price'] . " TL"?></td>
            <td><?php echo $user['kacAdetUrun'] ?></td>
            <td><?php echo $user['durumu']?></td>
            <td><?php echo $user['siparisTarih']?></td>
            <td>
                <form method="post" action="./controls.php">
                    <input type="hidden" name="cardSilTitle" value="<?php echo $user["urunID"] ?>">
                    <button type="submit" class="btn btn-danger" name="siparisSil" value="<?php echo $user['id']; ?>">Delete Order</button>
                </form>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        <!-- Admin Tablo Verileri Veritabanından Alma Bitiş -->
    </table>
</div>
<div>

    <?php require "HTML/footer.php"?>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
