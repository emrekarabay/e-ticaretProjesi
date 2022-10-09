<?php
require 'dbConnectPhp.php';

if(isset($_POST["adminUpdateStatusOfOrder"])){
    $sorguOrders = $conn->prepare(" UPDATE buy SET durumu = ?  WHERE id=?");
    $sorguOrders ->execute([$_POST["siparisDurumu"],$_POST["id"]]);
    header('Location: ./adminOrders.php');
}

if(isset($_POST["adminDeleteOrder"])){
    $sorguOrders = $conn->prepare(" DELETE FROM buy WHERE id=?");
    $sorguOrders ->execute([$_POST["adminDeleteOrder"]]);

    $sorguProducts2 = $conn->prepare(" SELECT * FROM letgo WHERE id=?");
    $sorguProducts2 ->execute([$_POST["urunID"]]);
    $ordersListele2 = $sorguProducts2 -> fetch();

    $ordersListele2["stock"] += $_POST['kacAdetUrun'];

    $sorguProducts = $conn->prepare("UPDATE letgo SET stock = ? WHERE id=?");
    $sorguProducts ->execute([$ordersListele2["stock"],$_POST["urunID"]]);

    header('Location: ./adminOrders.php');
}

if(isset($_POST["adminUpdateProduct"])){
    $sorguProducts = $conn->prepare("UPDATE letgo SET title=?,price=?, stock = ? WHERE id=?");
    $sorguProducts ->execute([$_POST["title"],$_POST["price"],$_POST["stock"],$_POST["id"]]);
    header('Location: ./adminProducts.php');
}

if(isset($_POST["adminDeleteProduct"])){
    $sorguProducts = $conn->prepare(" DELETE FROM letgo WHERE id=?");
    $sorguProducts ->execute([$_POST["id"]]);
    header('Location: ./adminProducts.php');
}

if(isset($_POST["adminUpdateUser"])){

    $sorguUsers = $conn->prepare(" UPDATE users SET username=?,password=?,authLevel=?,adminLevel=?,discountRate=? WHERE id=?");
    $sorguUsers ->execute([$_POST["username"],$_POST["password"],$_POST["authLevel"],$_POST["adminLevel"],$_POST["discountRate"],$_POST["id"]]);
    if($sorguUsers){
        header('Location: ./adminUsers.php');
    }
}

if(isset($_POST["adminDeleteUser"])){
    $sorguUsers = $conn->prepare(" DELETE FROM users WHERE id=?");
    $sorguUsers -> execute([$_POST["id"]]);
    if($sorguUsers){
        header('Location: ./adminUsers.php');
    }
}
if(isset($_POST["addNewProduct"])){
    header('Location: ./adminAddNewProduct.php');
}

if(isset($_POST["addToProducts"])){
    $sorguLetgo = $conn->prepare(" INSERT INTO letgo SET title=?,photoUrl=?,price=?,stock=?");
    $sorguLetgo ->execute([$_POST["title"],$_POST["photoUrl"],$_POST["price"],$_POST["stock"]]);
    header('Location: ./adminProducts.php');

}

if(isset($_POST["adminCreateCoupons"])){
    header('Location: ./adminNewCreateCoupon.php');
}

if(isset($_POST["createNewCoupon"])) {
    $sorguCoupons = $conn->prepare(" INSERT INTO userscoupons SET whoUser=?,couponsDiscountRate=?,couponsCode=?,couponsTitle=?");

    if ($_POST["user"] == "all") {
        $sorguUsers = $conn->query(" select * from users ");
        $usersListele = $sorguUsers->fetchall();
        foreach ($usersListele as $user) {
            $random = mt_rand();
            $sorguCoupons->execute([$user["id"], $_POST["discountRate"], $random,$_POST["title"]]);
        }
    }
    else{
        $random = mt_rand();
            $sorguCoupons->execute([$_POST["user"], $_POST["discountRate"], $random,$_POST["title"]]);
        }
    header('Location: ./adminCoupons.php');

}

if(isset($_POST["adminStockUpdate"])){
    header('Location: ./adminProducts.php');
}

if(isset($_POST["getCouponForCart"])) {

    $sorguUsers = $conn->prepare(" select * from users WHERE id=?");
    $sorguUsers -> execute([$_POST["id"]]);

    $usersListele = $sorguUsers->fetch();

    $random = mt_rand();

    $sorguCoupons = $conn->prepare(" INSERT INTO userscoupons SET whoUser=?,couponsDiscountRate=?,couponsCode=?,couponsTitle=?");
    $sorguCoupons->execute([$usersListele["id"],5, $random,"Diamond Coupon"]);

    header('Location: ./adminCoupons.php');
}








