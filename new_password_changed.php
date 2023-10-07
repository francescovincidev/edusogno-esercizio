<?php

require_once __DIR__ . '/classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // SE è REGISTRAZIONE
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        // $_SESSION['email'] = $email;
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        // CREAMO L'OGGETTO NEWUSER E VALIDIAMO I DATI
        $newUser = new User('', '', $email, $old_password);
        $changedPassword = $newUser->changePassword($new_password);
    }
}

require_once __DIR__ . '/section/top.php';
if ($changedPassword === true) {
    echo "<h3>Password cambiata</h3>";
} elseif ($changedPassword) { ?>
    <div class="form-container">
        <?php
        include __DIR__ . '/layout/password_form.php';
        echo "<div class='errors'>" .  $changedPassword . "</div>";
        ?>
    </div>
<?php
} elseif (!$changedPassword) { ?>
    <div class="form-container">
        <?php
        include __DIR__ . '/layout/password_form.php';
        echo "<div class='errors'> Errore, password errata</div>";
        ?>
    </div>

<?php
}

require_once __DIR__ . '/section/bottom.php' ?>