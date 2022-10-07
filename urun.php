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
<?php
$sorguUsers = $conn-> prepare(" select * from users  WHERE id=?");
$sorguUsers -> execute([$_SESSION['id']]);
$usersListele = $sorguUsers -> fetch();

$sorguUsers2 = $conn-> prepare(" select * from letgo  WHERE id=?");
$sorguUsers2 -> execute([$_POST['urun']]);
$usersListele2 = $sorguUsers2 -> fetch();
?>
    <div class="container m-3">
        <div class="row">
            <div class="col-8">
                <img src="<?php echo $usersListele2["photoUrl"]?>">
                <?php echo $usersListele2["title"] ?>
            </div>
            <div class="col-4 text-center">
                <?php echo $usersListele2['price'] - (($usersListele2['price'] * $usersListele["discountRate"])/100) . " TL "."<br>"?>
            </div>
        </div>
        <div class="row m-3">
            <div class="text-end">
                <form method="post" action="./satinAlindi.php">
                    <button type="submit" class="btn btn-primary" name="satinAlindi" value="<?php echo $usersListele2['id']; ?>">Satın Al</button>
                </form>
            </div>
        </div>
    </div>
<div>
    <?php require "HTML/footer.php"?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>