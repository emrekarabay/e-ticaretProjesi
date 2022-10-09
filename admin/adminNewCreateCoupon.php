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
<?php  ?>
<div class="container mt-3">
    <form method="post" action="adminControls.php">
        <div class="row">
        <div class="col-4" >
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" name="title" placeholder="TV">
                <label for="title">Coupon Title</label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-floating mb-3">
                <label for="discountRate" class="form-label"></label>
                <select class="form-select" id="discountRate" name="discountRate" >
                    <option>Choose a discount rate</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
        </div>

        <div class="col-4">
            <div class="form-floating mb-3">
                <label for="user" class="form-label"></label>
                <select class="form-select" id="user" name="user" >
                    <option>Choose a user</option>
                    <option value="all">All</option>
                    <?php
                    $sorguUsers = $conn->query(" select * from users ");
                    $usersListele = $sorguUsers -> fetchall();
                    foreach ($usersListele as $user) { ?>
                    <option value="<?php echo $user['id'] ?>"><?php echo $user['id'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        </div>

        <input class="btn btn-primary" type="submit" name="createNewCoupon" value="Create New Coupon">

    </form>
</div>

<div><?php require "../HTML/footer.php" ?></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>