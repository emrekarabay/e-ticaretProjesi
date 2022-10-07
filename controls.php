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
            header('Location: ./letgo.php');
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

        $sorguUsers3 = $conn->prepare(" select * from users where id=?");
        $sorguUsers3 ->execute([$_SESSION['id']]);
        $usersListele3 = $sorguUsers3 -> fetch();
        $_SESSION['authLevel'] = $usersListele3['authLevel'];
        if($usersListele['adminLevel']== "1"){
            header('Location: ./adminDashboard.php');
        }else{
            header('Location: ./letgo.php');
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

if(isset($_POST["addToCard"])){

    $sorguUsers = $conn-> prepare(" select * from users  WHERE id=?");
    $sorguUsers -> execute([$_SESSION['id']]);
    $usersListele2 = $sorguUsers -> fetch();

    $sorguUsers = $conn->prepare(" INSERT INTO card SET title=?,photoUrl=?,price=?,kacAdetUrun=?,whoBuy=?,urunID=?");

    $sorguUsers2 = $conn->prepare(" select * from letgo where id=?");
    $sorguUsers2 ->execute([$_POST["addToCard"]]);
    $usersListele = $sorguUsers2->fetch();

    $sorguUsers ->execute([$usersListele["title"],$usersListele["photoUrl"],$usersListele['price'] - (($usersListele['price'] * $usersListele2["discountRate"])/100),1,$_SESSION["id"],$_POST["addToCard"]]);
    header('Location: ./letgo.php');
}
if(isset($_POST["odemeYap"])){
    header('Location: ./odeme.php');
}

if(isset($_POST["satinAlindi"])){
    $sorguUsers = $conn-> prepare(" select * from card where whoBuy=?");
    $sorguUsers -> execute([$_SESSION['id']]);
    $usersListele2 = $sorguUsers -> fetchAll();
    date_default_timezone_set('Europe/Istanbul');
    $orderDate = date("d-m-Y H:i:s");
    $sorguUsers2 = $conn->prepare(" INSERT INTO buy SET title=?,photoUrl=?,price=?,whoBuy=?,urunID=?,kacAdetUrun=?,durumu=?,siparisTarih=?");

    foreach ($usersListele2 as $user) {
        $sorguUsers2 ->execute([$user["title"],$user["photoUrl"],$user["price"],$user["whoBuy"],$user['urunID'],$user['kacAdetUrun'],"Onay bekliyor",$orderDate]);

        $sorguUsers4 = $conn->prepare(" select * from letgo where title=?");
        $sorguUsers4 ->execute([$user["title"]]);

        $usersListele4 = $sorguUsers4->fetch();
        $usersListele4["stock"] -= 1;

        $sorguUsers5 = $conn->prepare("UPDATE letgo SET stock = ? WHERE title=?");
        $sorguUsers5 ->execute([$usersListele4["stock"],$user["title"]]);
    }


    $sorguUsers3 = $conn->prepare(" DELETE FROM card where whoBuy=?");
    $sorguUsers3 ->execute([$_SESSION['id']]);
    header('Location: ./siparisler.php');
}
if(isset($_POST["cardSil"])){
    $sorguUsers = $conn->prepare(" DELETE FROM card WHERE id=?");
    $sorguUsers ->execute([$_POST["cardSil"]]);

    header('Location: ./card.php');
}

if(isset($_POST["urunuOyla"])){
    echo $_POST['id']. "<br>";
    $sorguUsers = $conn-> prepare(" select * from buy Where whoBuy=? and id=?");
    $sorguUsers -> execute([$_SESSION['id'],$_POST['id']]);
    $usersListele = $sorguUsers ->fetch();
    echo $usersListele['urunID'];
    $sorguUsers2 = $conn->prepare(" INSERT INTO urunratings SET userID=?,urunID=?,score=?");
    $sorguUsers2 -> execute([$_SESSION['id'],$usersListele['urunID'],$_POST['urunPuani']]);
    header('Location: ./urunRatings.php');


}
if(isset($_POST["newUpdate"])){
    $sorguUsers = $conn->prepare(" UPDATE users SET photoAdress = ? , password =? WHERE id=?");
    $sorguUsers ->execute(["images/".$_POST["newPhoto"],$_POST["newPassword"],$_POST["id"]]);
    if($_POST["adress"] != "") {
        $sorguUsers2 = $conn->prepare(" INSERT INTO userAdress SET whoUser = ? , adress =?");
        $sorguUsers2->execute([$_SESSION["id"], $_POST["adress"]]);
    }
    header('Location: ./editProfile.php');
}

if(isset($_POST["siparisSil"])){
    $sorguUsers4 = $conn->prepare(" select * from letgo where id=?");
    $sorguUsers4 ->execute([$_POST["cardSilTitle"]]);
    $usersListele = $sorguUsers4 -> fetch();
    $usersListele["stock"] += 1;
    $sorguUsers5 = $conn->prepare("UPDATE letgo SET stock = ? WHERE id=?");
    $sorguUsers5 ->execute([$usersListele["stock"],$_POST["cardSilTitle"]]);

    $sorguUsers = $conn->prepare(" DELETE FROM buy WHERE id=?");
    $sorguUsers ->execute([$_POST["siparisSil"]]);

    header('Location: ./siparisler.php');
}



if(isset($_POST["kacAdetUrunGuncelle"])){
    $sorguUsers4 = $conn->prepare(" select * from letgo where id=?");
    $sorguUsers4 ->execute([$_POST["urunID"]]);
    $usersListele = $sorguUsers4 -> fetch();

    $sorguUsers5 = $conn->prepare("UPDATE card SET kacAdetUrun = ? WHERE id=?");


    if($usersListele["stock"] >= $_POST["kacAdetUrun"]){
        $sorguUsers5 ->execute([$_POST["kacAdetUrun"],$_POST["kacAdetUrunGuncelle"]]);
        header('Location: ./card.php');
    }else{
        $sorguUsers5 ->execute([$usersListele["stock"],$_POST["kacAdetUrunGuncelle"]]);
        header('Location: ./card.php?hata=yes');
    }

}
if(isset($_POST["alertKapatCard"])){

    header('Location: ./card.php');
}






















