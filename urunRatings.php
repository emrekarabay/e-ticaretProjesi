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
<?php require "HTML/navbar.php"?>

<?php

$sorguUsers = $conn-> prepare(" select * from buy Where whoBuy=?");
$sorguUsers -> execute([$_SESSION['id']]);
$usersListele2 = $sorguUsers ->fetchAll();

foreach ($usersListele2 as $user) {

$sorguUsers2 = $conn-> prepare(" select * from urunratings Where userID=? and urunID=?");
$sorguUsers2 -> execute([$_SESSION['id'],$user['urunID']]);
$rowCount = $sorguUsers2 -> rowCount();
if($rowCount == 0){
?>
<div class="container">
    <div class="row m-3 ">
        <div class="col-8">
            <img src="<?php echo $user["photoUrl"]?>" width="300px" height="200px">
            <?php echo $user["title"] ?>
        </div>
        <div class="col-2">
            <?php echo $user['price'] . " TL" . "<br>"?>
        </div>
        <div class="col-2">
            <form method="post" action="./controls.php">
                <input type="hidden" name="id" value="<?php echo $user['id']?>">
                <div class="form-floating">
                    <select name = "urunPuani" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected>Tıklayınız</option>
                        <option value="1" >One</option>
                        <option value="2" >Two</option>
                        <option value="3" >Three</option>
                        <option value="4" >Four</option>
                        <option value="5" >Five</option>
                    </select>
                    <label for="floatingSelect">Ürün Puanın</label>
                </div>
                <button type="submit" class="btn btn-primary m-3" name="urunuOyla" value="">Ürünü Oyla</button>
            </form>

        </div>
    </div>
    <?php } } ?>

<?php require "HTML/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
ü</body>
</html>
