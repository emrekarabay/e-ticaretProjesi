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
<div><?php require "HTML/navbar.php"?></div>
<div>
    <table class="table table-sm mt-2">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Password</th>
            <th scope="col">Auth Level</th>
            <th scope="col">Photo</th>
            <th scope="col">Admin Level</th>
            <th scope="col">Edit</th>
            <th scope="col">Discount Rate</th>
            <th scope="col">Last Log Out Date</th>

        </tr>
        </thead>
        <!-- HTML Admin Tablo Başlıklar Bitiş -->
        <tbody class="table-group-divider">
        <!-- Admin Tablo Verileri Veritabanından Alma Başlangıç -->
        <?php
        $sorguUsers = $conn->query(" select * from users ");
        $usersListele = $sorguUsers -> fetchall();
        foreach ($usersListele as $user) { ?>
        <tr>
            <form method="POST" action="controls.php">
                <td><input type="hidden" name="id" value="<?php echo $user['id']?>"><?php echo $user['id']?></td>
                <td><input type="text" name="username" value="<?php echo $user['username']?>"></td>
                <td><input type="text" name="password" value="<?php echo $user['password']?>"></td>
                <td><input type="text" name="authLevel" value="<?php echo $user['authLevel']?>"></td>
                <td><img width="50px" height="50px" src='<?php echo $user["photoAdress"]; ?>'></td>
                <td><input type="text" name="adminLevel" value="<?php echo $user['adminLevel']?>"></td>
                <td><input class="btn btn-primary" type="submit" name="updateAdminPanel" value="Update">
                    <input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>
                <td><input type="text" name="discountRate" value="<?php echo $user['discountRate']?>"></td>
                <td><?php echo $user["lastLoginDate"]; ?></td>
            </form>

            <?php } ?>
        </tr>
        </tbody>
        <!-- Admin Tablo Verileri Veritabanından Alma Bitiş -->
    </table>
</div>
<div><?php require "HTML/footer.php"?></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>