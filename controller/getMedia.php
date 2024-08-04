<?php
require_once("../controller/singleton_connexion.php");
$m = $_GET["m"];
if (isset($_GET['searchdata']) && !empty($_GET['searchdata']) || isset($m) && !empty($m)) {
    $recherche = htmlspecialchars($m);
    $allRessources = $db->prepare('SELECT * FROM films WHERE film_titre LIKE ?');
    $allRessources->execute(["%$recherche%"]);
    if ($allRessources->rowCount() > 0) {
        while ($ressources = $allRessources->fetch()) {
            ?>

            <a href="./view/content.php?id=<?= $ressources['id_film'] ?>"><p><?= $ressources['film_titre'] ?></p></a>
            <?php
        }
    } else {
        ?>
        <p>Aucun média trouvé.</p>
        <?php
    }
}
?>