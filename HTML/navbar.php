<nav class="navbar navbar-expand-lg bg-light ms-auto">
    <div class="container-fluid">
        <div class="navbar-text text-center">
            <?php
            if(isset($_SESSION['id'])){
                if($_SESSION['adminLevel'] == "0" and $_SESSION['authLevel'] == "1"){
                ?>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <a class="navbar-brand" href=""><img src="../Photos/logo2.png"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./letgo.php">Ana Sayfa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../card.php">Sepet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../urunRatings.php">Ürün Puanlamaların</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../siparisler.php">Siparişlerim</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../editProfile.php">Profili Düzenle</a>
                        </li>
                    </ul>

                    <span class="text-end">
                        <form class="" method="post" action="../controls.php">
                            <input class="btn btn-danger " type="submit" name="logOut" value="Log Out">
                        </form>

                    </span>
                </div>

            <?php }elseif($_SESSION['adminLevel'] == "1" and $_SESSION['authLevel'] == "1"){ ?>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <a class="navbar-brand" href=""><img src="../Photos/logo2.png"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./adminPanel.php">Ana Sayfa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../adminSiparisler.php">Siparişler</a>
                            </li>
                        </ul>
                        <span class="text-end">
                        <form class="" method="post" action="../controls.php">
                            <input class="btn btn-danger " type="submit" name="logOut" value="Log Out">
                        </form>

                    </span>
                    </div>
            <?php }else{ ?>
                    <span class="text-end">
                        <form class="" method="post" action="../controls.php">
                            <input class="btn btn-danger " type="submit" name="logOut" value="Log Out">
                        </form>

                    </span>


                <?php }
            }else{ ?>
                <span class="navbar-text">
                </span>
           <?php } ?>
           <?php  ?>
        </div>
    </div>
</nav>