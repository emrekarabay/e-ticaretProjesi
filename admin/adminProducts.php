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
<div>
    <table class="table table-sm mt-2">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Photo</th>
            <th scope="col">Price</th>
            <th scope="col">Stock</th>
            <th scope="col">Edit</th>

        </tr>
        </thead>
        <!-- HTML Admin Tablo Başlıklar Bitiş -->
        <tbody class="table-group-divider">
        <!-- Admin Tablo Verileri Veritabanından Alma Başlangıç -->
        <?php
        $sorguProducts = $conn->query(" SELECT * FROM letgo ");
        $productsListele = $sorguProducts -> fetchall();
        foreach ($productsListele as $products) { ?>
        <tr>
            <form method="POST" action="./adminControls.php">
                <td><input type="hidden" name="id" value="<?php echo $products['id']?>"><?php echo $products['id']?></td>
                <td><input type="text" name="title" value="<?php echo $products['title']?>"></td>
                <td><img width="50px" height="50px" src='<?php echo $products["photoUrl"]; ?>'></td>
                <td><input type="text" name="price" value="<?php echo $products['price']?>"></td>
                <td><input type="text" name="stock" value="<?php echo $products['stock']?>"></td>
                <td><input class="btn btn-primary" type="submit" name="adminUpdateProduct" value="Update">
                    <input class="btn btn-danger" type="submit" name="adminDeleteProduct" value="Delete"></td>
            </form>


            <?php } ?>
        </tr>
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