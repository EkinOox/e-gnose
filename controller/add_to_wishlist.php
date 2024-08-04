<?php
session_start();
require_once("../controller/singleton_connexion.php");
$id_user = $_SESSION["id_user"];
$id_film = $_POST["id_film"];

// Insertion de la wishlist dans la base de données
$done = $db->prepare('SELECT * FROM wishlist WHERE id_film = ? AND id_user = ?');
$done->bindParam(1, $id_film, PDO::PARAM_INT);
$done->bindParam(2, $id_user, PDO::PARAM_INT);
$done->execute();

if ($done->rowCount() == 0) {
    $insert = $db->prepare('INSERT INTO wishlist (id_user, id_film) VALUES (?, ?)');
    $insert->execute([$id_user, $id_film]);
    if ($insert) {
        header('Location: ../view/wishlist.php');
        exit;
    }
} else {
    header('Location: ../view/wishlist.php');
    exit;
}
