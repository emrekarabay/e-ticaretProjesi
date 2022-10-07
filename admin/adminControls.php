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