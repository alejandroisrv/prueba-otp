<?php

include 'connection.php';

$name = $_POST['name'];
$last_name = $_POST['last_name'];
$cedula = $_POST['cedula'];
$email = $_POST['email'];
$lenguajes = $_POST['lenguajes'];




try {

    $stmd = $conn->prepare("SELECT * FROM programador WHERE correo = ?");
    $stmd->bindParam(1, $email);
    $stmd->execute();
    $isExists = $stmd->fetch(PDO::FETCH_ASSOC);

    if ($isExists > 0) {
        echo json_encode([
            "message" => 'Usuario ya existe',
            "status" => false
        ]);
        exit;
    }

    $sql = "INSERT INTO programador (nombre,apellidos,cedula,correo,lenguajes) VALUES (?, ?, ?, ?, ? )";

    $std = $conn->prepare($sql);

    $std->execute([$name, $last_name, $cedula, $email, $lenguajes]);

    $count = $conn->query("SELECT * FROM programador")->fetchColumn();

    echo json_encode(["message" => 'Insertado con éxito', "totalCount" => $count, "status" => true]);
} catch (\PDOException $e) {
    echo "Se ha producido un error " . $e->getMessage();
}
