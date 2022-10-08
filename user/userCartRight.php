
<div>
    <?php  $sorguUsers = $conn-> prepare(" select * from card where whoBuy=?");
    $sorguUsers -> execute([$_SESSION["id"]]);
    $row = $sorguUsers -> rowCount();
    $usersListele = $sorguUsers -> fetchAll();
    $urunGenelToplam = 0;?>
    <?php foreach ($usersListele as $user) {
        $urunToplam = (int)$user["price"]*$user["kacAdetUrun"];
        $urunGenelToplam+=$urunToplam; }
    ?>
    <div style="width: 600px;" class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Cart Subtotal (<?php echo $row ." " ?> item): <?php echo " " .$urunGenelToplam . " TL" ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="mb-3">
                <form method="post" action="userControls.php">
                    <button type="submit" class="btn btn-outline-dark" name="cart" value="<?php echo $user['id']; ?>">Cart</button>
                    <button type="submit" class="btn btn-warning ms-3" name="checkoutDirectly" value="<?php echo $user['id']; ?>">Checkout (<?php echo $row ." " ?> item)</button>
                </form>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Title</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
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
        </div>
    </div>
</div>