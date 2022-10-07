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

<?php require "../HTML/navbar.php" ?>
<div class="container">
<form class="m-3" method="post" action="./userControls.php">
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Emre" name="fname">
                        <label for="floatingInput">First name</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Karabay" name="lname" >
                        <label for="floatingPassword">Last name</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="you@example.com" name="email" >
                        <label for="floatingPassword">Email</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <label for="adress" class="form-label"></label>
                        <select class="form-select" id="adress" name="adress" >
                        <option selected name="adress">Adres Seç</option>
                        <?php
                        $sorguUsers2 = $conn-> prepare(" select * from useradress  WHERE whoUser=?");
                        $sorguUsers2 -> execute([$_SESSION['id']]);
                        $usersListele2 = $sorguUsers2 -> fetchAll();

                        foreach ($usersListele2 as $user) { ?>
                        <option value="<?php echo $user["adress"] ?>"><?php echo $user["adress"] ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <label for="country" class="form-label"></label>
                        <select class="form-select" id="country" name="country" >
                            <option value="">Choose a country</option>
                            <option>United States</option>
                            <option>Turkey</option>
                            <option>Germany</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating mb-3">
                        <label for="state" class="form-label"></label>
                        <select class="form-select" id="state" name="state" >
                            <option value="">Choose a state</option>
                            <option>California</option>
                            <option>Balikesir</option>
                            <option>Berlin</option>
                        </select>

                    </div>
                </div>
                <div class="col-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="." name="zip" >
                        <label for="floatingPassword">Zip</label>
                    </div>
                </div>
            </div>
        </div>
        <?php  $sorguUsers = $conn-> prepare(" select * from card where whoBuy=?");
                $sorguUsers -> execute([$_SESSION["id"]]);
                $row = $sorguUsers -> rowCount();
                $usersListele = $sorguUsers -> fetchAll();
                $urunGenelToplam = 0;?>
        <div class="col-6">
            <div class="row">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill"><?php echo $row ?></span>
                </h4>
            </div>
            <div class="row">
                <ul class="list-group mb-3">


                   <table class="table">
                       <thead>
                       <tr>
                           <th scope="col">#</th>
                           <th scope="col">Photo</th>
                           <th scope="col">Title</th>
                           <th scope="col">Adet</th>
                           <th scope="col">Ürün Fiyatı</th>
                       </tr>
                       </thead>
                       <tbody>
                       <?php foreach ($usersListele as $user) {
                           $urunToplam = (int)$user["price"]*$user["kacAdetUrun"];
                           $urunGenelToplam+=$urunToplam;
                           ?>
                           <tr>
                               <th scope="row"><?php $user['id']; ?></th>
                               <td><img src="<?php echo $user["photoUrl"]?>" width="100px" height="75px"></td>
                               <td><?php echo $user["title"] ?></td>
                               <td><?php echo $user["kacAdetUrun"] ?></td>
                               <td><?php echo $urunToplam . " TL" ?></td>
                           </tr>
                       <?php } ?>

                       </tbody>
                   </table>
               <?php
               ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (TL)</span>
                        <strong><?php echo $urunGenelToplam . " TL" ?></strong>
                    </li>
                </ul>
            </div>

        </div>
    </div>
<button type="submit" class="btn btn-primary mt-3" name="payment" value=".">Payment</button>
</form>
</div>

<?php require "../HTML/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>