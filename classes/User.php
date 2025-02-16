<?php

require_once __DIR__ . '/validation/User_validation.php';

class User extends User_validation
{
    use Db;


    private $name;
    private $surname;
    private $email;
    private $password;

    public function __construct($name, $surname, $email, $password)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
    }

    // REGISTRAZIONE
    public function registerUser()
    {

        $db = $this->connect();


        // hashiamo la password
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        //INSERIAMO IL NUOVO UTENTE NEL DB
        $stmt = $db->prepare("INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->name, $this->surname, $this->email, $hashedPassword);
        if ($stmt->execute()) {
            $stmt->close();
            $userinfo['name'] = $this->name;
            $userinfo['surname'] = $this->surname;
            return $userinfo;
        } else {
            return false;
        }
        $stmt->close();
    }

    //LOGIN
    public function loginUser()
    {
        $db = $this->connect();

        // STMT PER RECUPERAREI DATI PER IL LOGIN
        $stmt = $db->prepare("SELECT nome, cognome,  password FROM utenti WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        if ($stmt->execute()) {
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($name, $surname, $hashedPassword);
                $stmt->fetch();


                if (password_verify($this->password, $hashedPassword)) {

                    $userinfo['name'] = $name;
                    $userinfo['surname'] = $surname;
                    return $userinfo;
                } else {

                    return false;
                }
            } else {

                return false;
            }
        } else {
            return false;
        }

        $stmt->close();
    }

    // OTTENIAMO GLI EVENTI
    public function getEvents()
    {
        $db = $this->connect();
        $events = [];

        $stmt = $db->prepare("SELECT * FROM eventi WHERE FIND_IN_SET(? , attendees) > 0");
        $stmt->bind_param("s", $this->email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // CICLIAMO PER SALVARE TUTTI  I RISULTATI IN UN ARRAY
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
            return $events;
        } else {
            return false;
        }

        $stmt->close();
    }

    //MANDIAMO L'EMAIL PER IL CAMBIO PASSWORD
    public function getPasswordLink()
    {
        $to = $this->email;
        $subject = "Richiesta cambio password";
        $message = "Ciao " . $this->name . " ecco il link per il cambio della password: http://localhost/edusogno-esercizio/new_password.php?email=" . $this->email; // Contenuto dell'email
        $headers = "From: edusogno@assistenza.com";

        // Invia l'email
        mail($to, $subject, $message, $headers);
    }

    public function changePassword($newPassword)
    {

        if (strlen($newPassword) < 8) {
            return "La password deve essere lunga almeno 8 caratteri";
        }

        if (strlen($newPassword) > 255) {
            return "La password è troppo lunga";
        }


        $db = $this->connect();

        // STMT PER VERIFICARE I DATI
        $stmt = $db->prepare("SELECT password FROM utenti WHERE email = ?");
        $stmt->bind_param("s", $this->email);
        if ($stmt->execute()) {
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($hashedPassword);
                $stmt->fetch();


                if (password_verify($this->password, $hashedPassword)) {
                    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    $passwordStmt = $db->prepare("UPDATE utenti SET password = ? WHERE email = ?");
                    $passwordStmt->bind_param("ss", $newHashedPassword, $this->email);
                    $passwordStmt->execute();
                    $stmt->close();
                    $passwordStmt->close();

                    return true;
                } else {

                    return false;
                }
            } else {

                return false;
            }
        } else {
            return false;
        }
    }
}
