<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "mio_database";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$nome_tabella = $_POST["nome_tabella"];

$campo1 = $_POST["campo1"];
$tipo1 = $_POST["tipo1"];

$campo2 = $_POST["campo2"];
$tipo2 = $_POST["tipo2"];

$campo3 = $_POST["campo3"];
$tipo3 = $_POST["tipo3"];

$query = "CREATE TABLE $nome_tabella (
            id INT AUTO_INCREMENT PRIMARY KEY,
            $campo1 $tipo1,
            $campo2 $tipo2,
            $campo3 $tipo3
          )";

if ($conn->query($query) === TRUE) {
    echo "Tabella creata correttamente!";
} else {
    echo "Errore: " . $conn->error;
}

$conn->close();

?>