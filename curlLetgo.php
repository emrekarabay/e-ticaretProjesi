<?php
require "sessionControl.php";

$link = baglan("https://www.letgo.com/");

preg_match_all('@data-aut-id="itemTitle">(.*?)</span>@', $link, $urlArray);
preg_match_all('@><img src="https://apollo(.*?)" alt@', $link, $imgArray);
preg_match_all('@data-aut-id="itemPrice">(.*?)</span>@', $link, $priceArray);

function baglan($a)
{

    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $a);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_TIMEOUT, 10);

    $kaydet = curl_exec($c);
    curl_close($c);
    return $kaydet;
}
/*
$sorgu=$conn->prepare("INSERT INTO letgo (title,photoUrl,price) values(?,?,?)");
$sorguUsers = $conn->prepare(" select * from users WHERE id=?");
$sorguUsers->execute([$_SESSION["id"]]);
$usersListele = $sorguUsers -> fetch();
for($i=0; $i < count($priceArray[1]);$i++){
    $price = (int)filter_var($priceArray[1][$i], FILTER_SANITIZE_NUMBER_INT);
    $x = "https://apollo" . $imgArray[1][$i];
    //$discountPrice = $price - (($price * $usersListele["discountRate"])/100);
    $sorgu->execute([$urlArray[1][$i],$x,$price]);
}
*/
/*
$sorguUsers = $conn->prepare(" select * from kullanici WHERE username=?");
$sorguUsers->execute([$_SESSION["loginUsername"]]);
$usersListele = $sorguUsers -> fetch();
$count = 0;


for($i=0; $i < count($priceArray[1]);$i++){
    $sorgu=$conn->prepare("UPDATE letgo SET baslik=?,url=?,price=?,discountPrice=? WHERE id=?");
    $price = (int)filter_var($priceArray[1][$i], FILTER_SANITIZE_NUMBER_INT);
    $x = "https://apollo" . $imgArray[1][$i];
    $discountPrice = $price - (($price * $usersListele["discountRate"])/100);
    $sorgu->execute([$urlArray[1][$i],$x,$price,$discountPrice,$i+1021]);
    $count++;
}
*/

    header('Location: ./letgo.php');
