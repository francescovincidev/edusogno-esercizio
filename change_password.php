<?php
require_once __DIR__ . '/classes/User.php';
session_start();
$newUser = $_SESSION['newUser'];
var_dump($newUser);


$newUser->getPasswordLink();
require_once __DIR__ . '/section/top.php' ?>
<h3>Abbiamo mandato nella tua email un link per cambiare password</h3>
<?php require_once __DIR__ . '/section/bottom.php' ?>