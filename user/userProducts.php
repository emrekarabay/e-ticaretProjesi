<?php require "sessionControl.php"; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }
    </style>
    <script type="text/javascript" src="app.js"></script>
</head>
<body>
<div>
<?php require "../HTML/navbar.php" ?>
</div>

<?php require "userCartRight.php"?>
<!-- İçerik Başlangıç -->
<div class="container">
<div class="row">
    <?php
    $sorguUsers = $conn->query(" select * from letgo ");
    $usersListele = $sorguUsers -> fetchall();


    $sorguUsers2 = $conn-> prepare(" select * from users  WHERE id=?");
    $sorguUsers2 -> execute([$_SESSION['id']]);
    $usersListele2 = $sorguUsers2 -> fetch();



    foreach ($usersListele as $user) {
        $top = 0;
        $sorguUsers3 = $conn->prepare(" SELECT * from urunratings WHERE urunID=? ");
        $sorguUsers3 -> execute([$user['id']]);
        $usersListele3 = $sorguUsers3 -> fetchAll();
        $kisiSayisi = $sorguUsers3 ->rowCount();
    foreach ($usersListele3 as $oylama) {
        $top += $oylama["score"];

    }
        $kalan = 0;
    if($kisiSayisi != 0) {
        $oylamaOrt = $top / $kisiSayisi;

        $kalan = $oylamaOrt - floor($oylamaOrt);
        $yildizSayisi = 0;
        $check = 1;
    }else{
        $oylamaOrt = 0;
        $kisiSayisi = 0;
        $check =0;
    }
    ?>
        <div class="col-3 mt-2">
            <div class="card mx-auto" style="width: 18rem;">
                <img src="<?php echo $user["photoUrl"] ?>" class="card-img-top" alt="..." height="200px" width="200px">
                <div class="card-body">
                    <a class="text-decoration-none text-dark"  href="./userProductDetail.php?id=<?php echo $user["id"]?>"><h5 class="card-title"><?php echo $user['title'];?></h5></a>
                    <h6 class="card-title"><?php echo $user['stock'] . " adet stokta"; ?></h6>
                    <?php for ($i=0;$i < 5;$i++){
                        if($i<floor($oylamaOrt) && $check == 1){ ?>
                        <span class="fa fa-star checked"></span>
                    <?php $yildizSayisi++; }}
                    if($kalan >= 0.25 && $kalan < 0.75  && $check == 1){ ?>
                        <span class="fa fa-star-half-o checked"></span>
                    <?php $yildizSayisi++;  }
                    if($kalan >= 0.75  && $check == 1){ ?>
                        <span class="fa fa-star checked"></span>
                    <?php  $yildizSayisi++;}
                    if( $check == 1){
                        for($i=$yildizSayisi;$i < 5;$i++) {?>
                        <span class="fa fa-star "></span>
                   <?php }}

                    if($oylamaOrt == 0  && $check == 0){
                        for($i=0;$i < 5;$i++) {?>
                            <span class="fa fa-star "></span>
                        <?php } }
                    echo "(" . $kisiSayisi . ") " ?>
                    <h5 class="card-text mt-1"><?php echo $user['price'] . " TL yerine " . ($user['price'] - (($user['price'] * $usersListele2["discountRate"])/100)) . " TL "; ?></h5>

                    <form class="mt-1" method="post" action="./userControls.php">
                        <button type="submit" class="btn btn-primary" name="addToCard" id="addToCard" value="<?php echo $user['id']; ?>">Add to Card</button>
                    </form>
                </div>
            </div>
        </div>

    <?php
    } ?>
</div>
</div>
<!-- İçerik Bitiş -->
<?php require "../HTML/footer.php" ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>
</html>