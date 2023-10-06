<?php
require_once __DIR__ . '/classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $newUser = new User($name, $surname, $email, $password);
    $errors = $newUser->registerUser_validation($name, $surname, $email, $password);
    $user = null;

    if (empty($errors)) {

        $user = $newUser->registerUser();
    }
}
?>

<?php require_once __DIR__ . '/section/top.php' ?>
<div class="register">

    <?php
    if ($errors) {
        include __DIR__ . '/layout/registration_form.php';
        echo "<div class='errors'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    } else if ($user) {
        echo 'Ciao ' . $name . $surname . ' ecco i tuoi eventi';
    } ?>
</div>

<?php require_once __DIR__ . '/section/bottom.php' ?>