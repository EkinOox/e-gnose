<?php
session_start();
require_once("../controller/singleton_connexion.php");
$id_user = $_SESSION["id_user"]; 
$id_film = $_POST["id_film"];


// Suppression de la wishlist de la base de données
$delete = $db->prepare('DELETE FROM wishlist WHERE id_user = ? AND id_film = ?');
$delete->execute([$id_user, $id_film]);
if($delete){
    header("Location: ../view/wishlist.php");
    exit;
}
