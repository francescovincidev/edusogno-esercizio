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
}
