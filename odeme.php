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

<?php require "HTML/navbar.php"?>

<form class="m-3" method="post" action="./controls.php">
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
                        <input type="text" class="form-control" id="floatingPassword" placeholder=".." name="adress">
                        <label for="floatingPassword">Address</label>
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
                $toplam = 0;?>
        <div class="col-5">
            <div class="row">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill"><?php echo $row ?></span>
                </h4>
            </div>
            <div class="row">
                <ul class="list-group mb-3">


               <?php foreach ($usersListele as $user) { ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div class="row">
                            <div class="col-2">
                                <img src="<?php echo $user["photoUrl"] ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="col-9">
                                <h6 class="my-0"><?php echo $user["title"] ?></h6>
                            </div>
                        </div>
                        <span class=""><?php echo $user["price"] . " TL" ?></span>
                    </li>
               <?php
               $toplam +=$user["price"];
               }?>



                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (TL)</span>
                        <strong><?php echo $toplam . " TL" ?></strong>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <h4 class="m-3">Payment</h4>

    <div class="row">
        <div class="col-6">
            <div class="form-check">
                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked >
                <label class="form-check-label" for="credit">Credit card</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-check">
                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" >
                <label class="form-check-label" for="debit">Debit card</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-check">
                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" >
                <label class="form-check-label" for="paypal">PayPal</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="cc-name" class="form-label">Name on card</label>
            <input type="text" class="form-control" id="cc-name" placeholder="" >
            <small class="text-muted">Full name as displayed on card</small>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="cc-number" class="form-label">Credit card number</label>
            <input type="text" class="form-control" id="cc-number" placeholder="" >
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="cc-expiration" class="form-label">Expiration</label>
            <input type="text" class="form-control" id="cc-expiration" placeholder="" >
        </div>
        <div class="col-2">
            <label for="cc-cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" placeholder="" >
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <button type="submit" class="btn btn-primary mt-3" name="satinAlindi" value=".">Satın Al</button>

        </div>
    </div>




</form>


<?php require "HTML/footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>