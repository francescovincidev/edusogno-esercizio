<?php
session_start();

$email = null;


if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} elseif (isset($_GET['email'])) {
    $email = $_GET['email'];
    $_SESSION['email'] = $email;
}
if ($email) {
?>
    <h3>Cambia la tua password</h3>
    <form action="new_password_changed.php" method="post">
        <?php echo  "<input type='hidden' name='email' value='$email'>" ?>

        <!-- VECCHIA PASSWORD -->
        <label for="old_password">Inserisci la password</label>
        <input type="password" id="old_password" name="old_password" placeholder="Scrivila qui la password attuale">

        <!-- NUOVA PASSWORD -->
        <label for="new_password">Inserisci la password</label>
        <input type="password" id="new_password" name="new_password" placeholder="Scrivila qui l anuova password">

        <button type="submit">Cambia password</button>


    </form>
<?php
}
?>