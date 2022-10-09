<?php
require 'dbConnectPhp.php';

if(isset($_POST["addToCard"])){

    $sorguUsers = $conn-> prepare(" select * from users  WHERE id=?");
    $sorguUsers -> execute([$_SESSION['id']]);
    $usersListele = $sorguUsers -> fetch();

    $sorguProduct = $conn->prepare(" select * from letgo where id=?");
    $sorguProduct ->execute([$_POST["addToCard"]]);
    $productListele = $sorguProduct->fetch();

    $sorguCard = $conn->prepare(" select * from card where urunID=? and whoBuy=?");
    $sorguCard -> execute([$_POST["addToCard"],$_SESSION['id']]);
    $numberOfRow = $sorguCard -> rowCount();
    $cardListele = $sorguCard->fetch();

    if($numberOfRow == 0){
        $sorguCard2 = $conn->prepare(" INSERT INTO card SET title=?,photoUrl=?,price=?,kacAdetUrun=?,whoBuy=?,urunID=?");
        $sorguCard2 ->execute([$productListele["title"],$productListele["photoUrl"],$productListele['price'] - (($productListele['price'] * $usersListele["discountRate"])/100),1,$_SESSION["id"],$_POST["addToCard"]]);
    }else{
        $sorguCard3 = $conn->prepare(" UPDATE card SET kacAdetUrun = ? WHERE urunID=?");
        $sorguCard3 -> execute([$cardListele["kacAdetUrun"]+1,$_POST["addToCard"]]);
    }
    header('Location: ./userProducts.php?addToCart=yes');
}

if(isset($_POST["howManyProduct"])){
    $sorguUsers4 = $conn->prepare(" select * from letgo where id=?");
    $sorguUsers4 ->execute([$_POST["urunID"]]);
    $usersListele = $sorguUsers4 -> fetch();

    $sorguUsers5 = $conn->prepare("UPDATE card SET kacAdetUrun = ? WHERE id=?");


    if($usersListele["stock"] >= $_POST["howManyProduct"]){
        $sorguUsers5 ->execute([$_POST["howManyProduct"],$_POST["id"]]);
        header('Location: ./userCard.php');
    }else{
        $sorguUsers5 ->execute([$usersListele["stock"],$_POST["id"]]);
        header('Location: ./userCard.php?hata=yes');
    }

}

if(isset($_POST["cardDelete"])){
    $sorguUsers = $conn->prepare(" DELETE FROM card WHERE id=?");
    $sorguUsers ->execute([$_POST["cardDelete"]]);

    header('Location: ./userCard.php');
}

if(isset($_POST["checkout"])){
    header('Location: ./userCheckout.php');
}

if(isset($_POST["payment"])){
    $sorguUsers = $conn-> prepare(" select * from card where whoBuy=?");
    $sorguUsers -> execute([$_SESSION['id']]);
    $usersListele2 = $sorguUsers -> fetchAll();
    date_default_timezone_set('Europe/Istanbul');
    $orderDate = date("d-m-Y H:i:s");
    $sorguUsers2 = $conn->prepare(" INSERT INTO buy SET title=?,photoUrl=?,price=?,whoBuy=?,urunID=?,kacAdetUrun=?,durumu=?,siparisTarih=?");
    $gelenDiscount = $_POST["discountTL"];

    foreach ($usersListele2 as $user) {
        $yeniFiyat=$user["price"]-$gelenDiscount;
        if($yeniFiyat < 0){
            $sorguUsers2 ->execute([$user["title"],$user["photoUrl"],"0",$user["whoBuy"],$user['urunID'],$user['kacAdetUrun'],"Onay bekliyor",$orderDate]);
            $gelenDiscount = $yeniFiyat*-1;
        }else{
            $sorguUsers2 ->execute([$user["title"],$user["photoUrl"],$yeniFiyat,$user["whoBuy"],$user['urunID'],$user['kacAdetUrun'],"Onay bekliyor",$orderDate]);
            $gelenDiscount = 0;
        }


        $sorguUsers4 = $conn->prepare(" select * from letgo where title=?");
        $sorguUsers4 ->execute([$user["title"]]);

        $usersListele4 = $sorguUsers4->fetch();
        $usersListele4["stock"] -= $user['kacAdetUrun'];

        $sorguUsers5 = $conn->prepare("UPDATE letgo SET stock = ? WHERE title=?");
        $sorguUsers5 ->execute([$usersListele4["stock"],$user["title"]]);
    }

    if(isset($_POST["whichCouponUse"])){
        $sorguUsers6 = $conn->prepare(" DELETE FROM userscoupons where whoUser=? and id=?");
        $sorguUsers6 ->execute([$_SESSION['id'],$_POST["whichCouponUse"]]);
    }


    $sorguUsers3 = $conn->prepare(" DELETE FROM card where whoBuy=?");
    $sorguUsers3 ->execute([$_SESSION['id']]);
    header('Location: ./userOrders.php');
}

if(isset($_POST["deleteOrder"])){
    $sorguUsers = $conn-> prepare(" select * from buy Where whoBuy=? and urunID=?");
    $sorguUsers -> execute([$_SESSION['id'],$_POST["cardSilTitle"]]);
    $usersListele2 = $sorguUsers ->fetch();

    $sorguUsers4 = $conn->prepare(" select * from letgo where id=?");
    $sorguUsers4 ->execute([$_POST["cardSilTitle"]]);
    $usersListele = $sorguUsers4 -> fetch();
    $usersListele["stock"] += $usersListele2["kacAdetUrun"];

    $sorguUsers5 = $conn->prepare("UPDATE letgo SET stock = ? WHERE id=?");
    $sorguUsers5 ->execute([$usersListele["stock"],$_POST["cardSilTitle"]]);

    $sorguUsers = $conn->prepare(" DELETE FROM buy WHERE id=?");
    $sorguUsers ->execute([$_POST["deleteOrder"]]);

    header('Location: ./userOrders.php');
}

if(isset($_POST["rateTheProduct"])){
    echo $_POST['id']. "<br>";
    $sorguUsers = $conn-> prepare(" select * from buy Where whoBuy=? and id=?");
    $sorguUsers -> execute([$_SESSION['id'],$_POST['id']]);
    $usersListele = $sorguUsers ->fetch();
    echo $usersListele['urunID'];
    $sorguUsers2 = $conn->prepare(" INSERT INTO urunratings SET userID=?,urunID=?,score=?");
    $sorguUsers2 -> execute([$_SESSION['id'],$usersListele['urunID'],$_POST['urunPuani']]);
    header('Location: ./userProductRatings.php');
}

if(isset($_POST["userProfileUpdate"])){
    $sorguUsers = $conn->prepare(" UPDATE users SET photoAdress = ? , password =? WHERE id=?");
    $sorguUsers ->execute(["../images/".$_POST["newPhoto"],$_POST["newPassword"],$_POST["id"]]);
    if($_POST["adress"] != "") {
        $sorguUsers2 = $conn->prepare(" INSERT INTO userAdress SET whoUser = ? , adress =?");
        $sorguUsers2->execute([$_SESSION["id"], $_POST["adress"]]);
    }
    header('Location: ./userProfile.php');
}

if(isset($_POST["cart"])){
    header('Location: ./userCard.php');
}
if(isset($_POST["checkoutDirectly"])){
    header('Location: ./userCheckout.php');
}

if(isset($_POST["closeAlertAddToCart"])){
    header('Location: ./userProducts.php');
}

if(isset($_POST["redeemButton"])){
    $sorguUserCoupons = $conn-> prepare(" select * from userscoupons  WHERE whoUser=?");
    $sorguUserCoupons -> execute([$_SESSION['id']]);
    $couponsListele = $sorguUserCoupons -> fetchAll();
    foreach ($couponsListele as $coupons) {
        if($_POST["promocode"] == $coupons["couponsCode"]){
            header('Location: ./userCheckout.php?coupon=true&id=' .$coupons["id"]);
        }
    }
}


