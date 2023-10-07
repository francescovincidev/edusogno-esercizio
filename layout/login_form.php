<h3>Hai già un account?</h3>
<form action="user.php" method="post">
    <input type="hidden" name="accesso" value="1">

    <!-- EMAIL -->
    <label for="email">Inserisci l'email</label>
    <input type="email" id="email" name="email" placeholder="name@example.com">

    <!-- PASSWORD -->
    <label for="password">Inserisci la password</label>
    <input type="password" id="password" name="password" placeholder="Scrivila qui">

    <button type="submit">Accedi</button>

    <a href="http://localhost/edusogno-esercizio"> Non sei registrato? <span class="bold">Registrati</span></a>

</form>