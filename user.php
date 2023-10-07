<?php
require_once __DIR__ . '/classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // SE è REGISTRAZIONE
    if (isset($_POST['registrazione'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // CREAMO L'OGGETTO NEWUSER E VALIDIAMO I DATI
        $newUser = new User($name, $surname, $email, $password);
        $errors = $newUser->registerUser_validation($name, $surname, $email, $password);
        $userinfo = null;
        $events = null;

        // SE NON CI SONO ERRORI AVVIENE LA REGISTRAZIONE
        if (empty($errors)) {

            $userinfo = $newUser->registerUser();
            $events = $newUser->getEvents();
        }

        // SE DEVE EFFETTUARE L'ACCESSO
    } elseif (isset($_POST['accesso'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // VERIFICA LOGIN
        $newUser = new User('', '', $email, $password);
        $errors = $newUser->loginUser_validation($email, $password);
        $userinfo = null;

        if (empty($errors)) {

            $userinfo = $newUser->loginUser();
            $events = $newUser->getEvents();
        }
    }
}
?>

<?php require_once __DIR__ . '/section/top.php' ?>
<div class="register">

    <?php
    // SE SI VIENE RIMANDATI IN QUESTA PAGINA TRAMITE IL FORM
    if (isset($errors) || isset($userinfo)) {
        // SE CI SONO ERRORI, VIENE RICARICATO IL FORM
        if ($errors || $userinfo === false) {

            if (isset($_POST['registrazione'])) {
                include __DIR__ . '/layout/registration_form.php';
            } elseif (isset($_POST['accesso'])) {
                include __DIR__ . '/layout/login_form.php';
            }

            echo "<div class='errors'>";
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";

            if ($userinfo === false) {
                echo "<div class='errors'> Accesso non valido, email o password errati</div>";
            }
        } else if ($userinfo) {

            echo  '<h3>Ciao ' . $userinfo['name'] . ' ' . $userinfo['surname'] . ' ecco i tuoi eventi</h3>';

            // STAMPIAMO GLI EVENTI
            echo "<div class='events'>";
            foreach ($events as $event) {
                echo   "<div class='event'>";
                echo "<span class='event-title'>" . $event['nome_evento'] . "</span>";
                echo "<span class='event-date'>" . $event['data_evento'] . "</span>";
                echo "<button>JOIN</button>";
                echo   "</div>";
            }
            echo "</div>";
        }
    } else {
        // SE L'UTENTE PROVA AD ACCEDERE ALLA PAGINA SENZA REGISTRARSI O LOGGARSI
        header('Location: http://localhost/edusogno-esercizio/');
    }
    ?>
</div>

<?php require_once __DIR__ . '/section/bottom.php' ?>