<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <link rel="stylesheet" href="assets/styles/style.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include __DIR__ . '/layout/navbar.php';
    include __DIR__ . '/layout/background.php'; ?>
    <div class="register">
        <form action="">
            <!-- NOME -->
            <label for="nome">Inserisci il nome</label>
            <input type="text" id="nome" name="nome" placeholder="Mario">

            <label for="cognome">Inserisci il cognome:</label>
            <input type="text" id="cognome" name="cognome" placeholder="Rossi">

            <label for="email">Inserisci l'email</label>
            <input type="email" id="email" name="email" placeholder="name@example.com">

            <label for="password">Inserisci l'email</label>
            <input type="password" id="password" name="password" placeholder="Scrivila qui">

            <button type="submit">Registrati</button>

            <a href="">Hai già un account? <span class="bold">Accedi</span></a>
        </form>
    </div>


</body>

</html>