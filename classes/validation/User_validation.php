<?php


require_once __DIR__ . '/../../Database/Db.php';



class User_validation
{
    use Db;


    // VALIDAZIONE REGISTRAZIONE
    public function registerUser_validation($name, $surname, $email, $password)
    {
        $db = $this->connect();
        $errors = [];

        // VALIDAZIONE DATI E MESSAGGI DI ERRORE

        // INPUT
        if (empty($name) || empty($surname) || empty($password) || empty($email)) {
            $errors[] = "Tutti i campi sono obbligatori";
        }

        //USERNAME
        if (strlen($name) > 20 || strlen($surname) > 20) {
            $errors[] = "Il nome e il cognome non possono essere piu lunghi di 20 caratteri";
        }

        if (strlen($name) < 2 || strlen($surname) < 2) {
            $errors[] = "Il nome e il cognome non possono essere un solo carattere";
        }



        // EMAIL
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'indirizzo email non è valido";
        }

        if (strlen($email) > 255) {
            $errors[] = "L'indirizzo email è troppo lungo";
        }


        //verifichiamo che l'email non sia già usata
        $stmt = $db->prepare("SELECT email FROM utenti WHERE email = ?");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {

                $errors[] = "Email già registrata";
            }
        } else {
        }
        $stmt->close();


        //PASSWORD
        if (strlen($password) < 8) {
            $errors[] = "La password deve essere lunga almeno 8 caratteri";
        }

        if (strlen($password) > 255) {
            $errors[] = "La password è troppo lunga";
        }

        return $errors;
    }

    //VALIDAZIONE LOGIN
    public function loginUser_validation($email, $password)
    {
        $errors = [];

        if (empty($email) || empty($password)) {
            $errors[] = "Tutti i campi sono obbligatori";
        }

        return $errors;
    }
}
