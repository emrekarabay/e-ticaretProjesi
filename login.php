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
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div></div>
            <img src="images/background.svg" width="300px" height="300px" class="ms-5" alt="bg">
        </div>
        <div class="col-7 mt-3">
            <?php if(isset($_GET["hata"])) {
                    if($_GET["hata"]== "yes"){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username or password is wrong
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>
            <?php }}?>
            <form class="ms-1 me-3 mt-3" method="POST" action="controls.php">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" placeholder="name@example.com" required>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3" name="loginButton">Log in</button>

            </form>
            <form class="ms-1 mt-1" method="POST" action="controls.php">
                <button type="submit" class="btn btn-primary mt-3" name="registerButton">Register</button>
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