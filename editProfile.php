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
<div><?php
    $sorguUsers = $conn->prepare(" select * from users where id=?");
    $sorguUsers ->execute([$_SESSION["id"]]);
    $user = $sorguUsers -> fetch(); ?>
    <form class="m-3" method="POST" action="controls.php">
            <input type="hidden" name="id" value="<?php echo $user['id']?>">
        <div class="input-group mb-3">
            <span class="input-group-text">@</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup1" placeholder="<?php echo $user['username']?>" disabled>
                <label for="floatingInput"><?php echo $user['username']?></label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="newPassword" value="<?php echo $user['password']?>"  required>
            <label for="floatingInput">Password:</label>
        </div>
        <div class="mb-3">
            <img  class="mb-1" width="50px" height="50px" src='<?php echo $user["photoAdress"]; ?>'>
            <label for="formFile" class="form-label">Lütfen Resim Seçiniz!</label>
            <input class="form-control" type="file" id="formFile" name="newPhoto">
        </div>

        <input class="btn btn-primary" type="submit" name="newUpdate" value="Update">

    </form>
</div>
<div>
    <?php require "HTML/footer.php"?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>