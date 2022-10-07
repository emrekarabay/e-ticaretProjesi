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
<div class="container mt-3">
    <form method="post" action="adminControls.php">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="title" name="title" placeholder="TV">
            <label for="title">Product Title</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="photo" name="photoUrl" placeholder="www.url.com.tr">
            <label for="photo">Photo Url</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="price" name="price" placeholder="10000">
            <label for="price">Price</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="stock" name="stock" placeholder="100">
            <label for="stock">Stock</label>
        </div>
        <input class="btn btn-primary" type="submit" name="addToProducts" value="Add to Products">
    </form>
</div>
<div><?php require "../HTML/footer.php" ?></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>