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
<?php require "../HTML/navbar.php" ?>
<?php require "userCartRight.php"?>

<div class="container">
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Ürün Resmi</th>
        <th scope="col">Ürün Adı</th>
        <th scope="col">Ürün Puanı</th>
        <th scope="col">İşlem</th>
    </tr>
    </thead>
    <tbody>
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
        <tr>
            <th scope="row"><?php $user['id']; ?></th>
            <td><img src="<?php echo $user["photoUrl"]?>" width="100px" height="75px"></td>
            <td><?php echo $user["title"] ?></td>
            <td>
                <form method="post" action="./userControls.php">
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
            </td>
            <td><button type="submit" class="btn btn-primary" name="rateTheProduct" value="">Rate the Product</button></td>
                </form>
        </tr>
    <?php } } ?>

    </tbody>
</table>
</div>
<?php require "../HTML/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
