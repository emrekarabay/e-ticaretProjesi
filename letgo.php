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
</head>
<body>
<?php require "HTML/navbar.php"?>

<!-- İçerik Başlangıç -->
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

    }if($kisiSayisi != 0) {
        $oylamaOrt = $top / $kisiSayisi;
    }else{
        $oylamaOrt = 0;
        $kisiSayisi = 0;
    }
    ?>
        <div class="col-4 mt-3 ">
            <div class="card mx-auto" style="width: 18rem;">
                <img src="<?php echo $user["photoUrl"] ?>" class="card-img-top" alt="..." height="200px" width="200px">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user['title']; ?></h5>
                    <h5 class="card-text "><?php echo $user['price'] . " TL yerine " . ($user['price'] - (($user['price'] * $usersListele2["discountRate"])/100)) . " TL "; ?></h5>
                    <p class="card-title"><?php echo $user['stock'] . " adet stokta"; ?></p>
                    <?php for ($i=0;$i < 5;$i++){
                        if($i<floor($oylamaOrt)){ ?>
                        <span class="fa fa-star checked"></span>
                    <?php }else{ ?>
                            <span class="fa fa-star"></span>
                        <?php  } } echo "(" . $kisiSayisi . ") " ?>
                    <form class="mt-3" method="post" action="./controls.php">
                        <button type="submit" class="btn btn-primary" name="addToCard" value="<?php echo $user['id']; ?>">Sepete Ekle</button>
                    </form>
                </div>
            </div>
        </div>

    <?php
    } ?>
</div>
<!-- İçerik Bitiş -->
<?php require "HTML/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>