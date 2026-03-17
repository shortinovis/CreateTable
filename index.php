<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "testerprogramma";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$nome_tabella = $_POST["nome_tabella"];
$nomi = $_POST["campo_nome"];
$tipi = $_POST["campo_tipo"];
$lunghezze = $_POST["campo_lunghezza"];
$nulls = $_POST["campo_null"];
$primary_keys = isset($_POST["primary_key"]) ? $_POST["primary_key"] : [];

$campi_sql = [];
$pk_sql = [];

for ($i = 0; $i < count($nomi); $i++) {

    if (!empty($nomi[$i])) {

        $tipo = $tipi[$i];

        
        if ($tipo == "VARCHAR") {
            $lunghezza = !empty($lunghezze[$i]) ? $lunghezze[$i] : 50;
            $tipo .= "($lunghezza)";
        }

        $null = $nulls[$i];

        $campo_def = $nomi[$i] . " " . $tipo . " " . $null;

        $campi_sql[] = $campo_def;

        if (in_array($i, $primary_keys)) {
            $pk_sql[] = $nomi[$i];
        }
    }
}


$query = "CREATE TABLE $nome_tabella (";
$query .= implode(", ", $campi_sql);

if (count($pk_sql) > 0) {
    $query .= ", PRIMARY KEY (" . implode(", ", $pk_sql) . ")";
}

$query .= ")";


if ($conn->query($query) === TRUE) {
    echo " Tabella creata correttamente!";
} else {
    echo " Errore: " . $conn->error;
}

$conn->close();

?>