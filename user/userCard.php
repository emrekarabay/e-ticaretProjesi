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
<div class="">
    <?php require "../HTML/navbar.php" ?>
</div>
<div class="container">
<?php if(isset($_GET["hata"])) {
    if($_GET["hata"]== "yes"){
        ?>
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            Yeterli stok yok!! Stok kadar ürün eklendi
            <form method="post" action="../controls.php">
                <button type="submit" name="alertKapatCard" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </form>
        </div>
    <?php }}?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Ürün Resmi</th>
        <th scope="col">Ürün Adı</th>
        <th scope="col">Ürün Adeti</th>
        <th scope="col">Birim Ürün Fiyatı</th>
        <th scope="col">İşlem</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sorguCard = $conn-> prepare(" select * from card where whobuy=?");
    $sorguCard -> execute([$_SESSION['id']]);
    $cardListele = $sorguCard ->fetchAll();
    $rowCard = $sorguCard -> rowCount();
    foreach ($cardListele as $card) {
    ?>
    <tr>
        <th scope="row"><?php $card['id']; ?></th>
        <td><img src="<?php echo $card["photoUrl"]?>" width="100px" height="75px"></td>
        <td><?php echo $card["title"] ?></td>
        <td>
            <form method="post" action="./userControls.php">
                <input type="hidden" name="id" value="<?php echo $card['id'] ?>">
                <input type="hidden" name="urunID" value="<?php echo $card['urunID'] ?>">
                <input type="number" class="form-control" style="width: 75px;" name="howManyProduct" value="<?php echo $card['kacAdetUrun']?>">
            </form>
        </td>
        <td><?php echo $card['price'] . " TL"?></td>
        <td>
            <form method="post" action="./userControls.php">
                <button type="submit" class="btn btn-danger" name="cardDelete" value="<?php echo $card['id']; ?>">Delete Product</button>
            </form>
        </td>
    </tr>
    <?php } ?>

    </tbody>
</table>

<div>
    <?php
    if($rowCard != 0){
    ?>
        <div class="row m-3">
            <div class="text-end">
                <form method="post" action="./userControls.php">
                    <button type="submit" class="btn btn-success" name="checkout" value="">Checkout</button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>
</div>
<div><?php require "../HTML/footer.php" ?></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>