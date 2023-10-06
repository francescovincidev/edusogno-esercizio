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
        // session_start();

        // VALIDAZIONE DATI E MESSAGGI DI ERRORE
        // $errors = $this->registerUser_validation($this->name, $this->surname, $this->email, $this->password);

        // if (!empty($errors)) {
        //     http_response_code(400); // Bad Request
        //     echo json_encode(['errors' => $errors]);
        //     exit;
        // }

        // hashiamo la password
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        //INSERIAMO IL NUOVO UTENTE NEL DB
        $stmt = $db->prepare("INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->name, $this->surname, $this->email, $hashedPassword);
        if ($stmt->execute()) {
            $stmt->close();
            return true;

            // $_SESSION['user_email'] = $this->email;
        } else {
            http_response_code(500); // Errore del server
            echo json_encode(['errors' => 'Errore durante la registrazione']);
        }
        $stmt->close();
    }

    //LOGIN
    // public function loginUser()
    // {
    //     $db = $this->connect();


    //     // VALIDAZIONE DATI E MESSAGGI DI ERRORE
    //     $errors = $this->loginUser_validation($this->email, $this->password);


    //     if (!empty($errors)) {
    //         http_response_code(400); // Errore negli input
    //         echo json_encode(['errors' => $errors]);
    //         exit;
    //     }

    //     $stmt = $db->prepare("SELECT name, surname,  password FROM utenti WHERE email = ?");
    //     $stmt->bind_param("s", $this->email);
    //     if ($stmt->execute()) {
    //         $stmt->store_result();

    //         if ($stmt->num_rows === 1) {
    //             $stmt->bind_result($username, $user_id, $hashedPassword);
    //             $stmt->fetch();


    //             if (password_verify($this->password, $hashedPassword)) {

    //                 http_response_code(201);
    //                 echo json_encode(['message' => 'Login avvenuto con successo', 'logged_id' => $user_id, 'username' => $username]);
    //             } else {
    //                 http_response_code(400); // Errore negli input
    //                 $errors['inputs'][] = "Accesso non valido, email o password errati";

    //                 echo json_encode(['errors' => $errors]);
    //             }
    //         } else {
    //             http_response_code(400); // Errore negli input
    //             $errors['inputs'][] = "Accesso non valido, email o password errati";

    //             echo json_encode(['errors' => $errors]);
    //         }
    //     } else {
    //         http_response_code(500); // Errore del server
    //         echo json_encode(['errors' => 'Errore durante il login']);
    //     }

    //     $stmt->close();
    // }
}
