<form action="user.php" method="post">
    <input type="hidden" name="registrazione" value="1">

    <!-- NOME -->
    <label for="name">Inserisci il nome</label>
    <input type="text" id="name" name="name" placeholder="Mario">

    <!-- COGNOME -->
    <label for="surname">Inserisci il cognome:</label>
    <input type="text" id="surname" name="surname" placeholder="Rossi">

    <!-- EMAIL -->
    <label for="email">Inserisci l'email</label>
    <input type="email" id="email" name="email" placeholder="name@example.com">

    <!-- PASSWORD -->
    <label for="password">Inserisci la password</label>
    <input type="password" id="password" name="password" placeholder="Scrivila qui">

    <button type="submit">Registrati</button>

    <a href="http://localhost/edusogno-esercizio/login.php">Hai già un account? <span class="bold">Accedi</span></a>


</form>