<?php
require 'dbConnectPhp.php';

if(isset($_POST["registerButton"])){
    header('Location: ./register.php');
}
if(isset($_POST["loginButton"])){
    $sorguUsers = $conn->prepare(" SELECT * FROM users WHERE username=? AND password=?");
    $sorguUsers ->execute([$_POST['username'],$_POST['password']]);
    $numberOfRow = $sorguUsers ->rowCount();
    $usersListele = $sorguUsers -> fetch();

    if($numberOfRow > 0){
        $_SESSION["id"] = $usersListele["id"];
        $_SESSION["username"] = $usersListele["username"];
        $_SESSION["adminLevel"] = $usersListele["adminLevel"];
        $_SESSION['authLevel'] = $usersListele['authLevel'];
        if($usersListele['adminLevel'] == "1" && $usersListele['authLevel'] == "1"){
            header('Location: ./admin/adminDashboard.php');
        }elseif($usersListele['adminLevel'] == "0" && $usersListele['authLevel'] == "1"){
            header('Location: ./user/userProducts.php?category=all');
        }else{
            header('Location: ./auth.php');
        }
    }else{
        header("location: login.php?hata=yes");
    }
}

if(isset($_POST["signUpbutton"])){
    $sorguUsers = $conn->prepare(" SELECT * FROM users WHERE username=?");
    $sorguUsers ->execute([$_POST['username']]);
    $numberOfRow = $sorguUsers ->rowCount();
    if($numberOfRow == 0){
        $sorguUsers = $conn->prepare(" INSERT INTO users SET username=?,password=?,authLevel=?,activationCode=?,photoAdress=?,adminLevel=?,discountRate=?");
        if($_POST['password'] == $_POST['confirmPassword']){
            $authNumber = rand(100,999);
            $sorguUsers ->execute([$_POST['username'],$_POST['password'],"0",$authNumber,"images/none.svg","0","10"]);
            $_SESSION['adminLevel'] = "0";

            $sorguUsers2 = $conn->prepare(" SELECT * FROM users WHERE username=?");
            $sorguUsers2 ->execute([$_POST['username']]);
            $usersListele = $sorguUsers2 -> fetch();
            $_SESSION['authLevel'] = $usersListele['authLevel'];
            $_SESSION["id"] = $usersListele['id'];
            header('Location: ./auth.php');
        }else{
            header('Location: ./register.php?hataPassword=yes');
        }
    }else{
        header('Location: ./register.php?hataUsername=yes');
    }
}

if(isset($_POST["activationCodeSubmit"])){
    $sorguUsers = $conn->prepare(" select * from users where id=?");
    $sorguUsers ->execute([$_SESSION['id']]);
    $usersListele = $sorguUsers -> fetch();
    if($_POST["activationCode"] == $usersListele["activationCode"]){
        $sorguUsers2 = $conn->prepare(" UPDATE users SET authLevel = ? WHERE id=?");
        $sorguUsers2 ->execute(["1",$usersListele["id"]]);

        $random = mt_rand();
        $sorguCoupons = $conn->prepare(" INSERT INTO userscoupons SET whoUser=?,couponsDiscountRate=?,couponsCode=?,couponsTitle=?");
        $sorguCoupons ->execute([$_SESSION['id'],10,$random,"Welcome Coupon"]);


        $sorguUsers3 = $conn->prepare(" select * from users where id=?");
        $sorguUsers3 ->execute([$_SESSION['id']]);
        $usersListele3 = $sorguUsers3 -> fetch();
        $_SESSION['authLevel'] = $usersListele3['authLevel'];
        if($usersListele['adminLevel']== "1"){
            header('Location: ./admin/adminDashboard.php');
        }else{
            header('Location: ./user/userProducts.php');
        }
    }else{
        echo "Lütfen doğrulama kodunu kontrol ediniz!!!!!";
    }
}

if(isset($_POST["logOut"])){

    $sorguUsers = $conn->prepare("UPDATE users SET lastLoginDate = ? WHERE id=?");
//    $sorguUsers3 = $conn->query(" DELETE FROM card");
    if($sorguUsers){
        date_default_timezone_set('Europe/Istanbul');
        $LastLoginDate = date("d-m-Y H:i:s");
        $sorguUsers ->execute([$LastLoginDate,$_SESSION['id']]);
        session_destroy();
        header('Location: ./login.php');
    }
}

if(isset($_POST["alertKapatCard"])){

    header('Location: ./user/userCard.php');
}
