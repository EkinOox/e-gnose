<?php
if (isset($_POST["id_serie"])) {
    $id_user = $_SESSION["id_user"];
    $id_serie = $_GET["id"];
    $done = $db->prepare('SELECT * FROM wishlist WHERE id_serie = ? AND id_user = ?');
    $done->bindParam(1, $id_serie, PDO::PARAM_INT);
    $done->bindParam(2, $id_user, PDO::PARAM_INT);
    $done->execute();
    if ($done->rowCount() == 0) {
        $insert = $db->prepare('INSERT INTO wishlist (id_user, id_serie) VALUES (?, ?)');
        $insert->execute([$id_user, $id_serie]);
        if ($insert) {
            header('Location: ../view/wishlist.php');
            exit;
        }
    } else {
        header('Location: ../view/wishlist.php');
        exit;
    }
}
class serie
{
    public $id_serie;
    public  $serie_city;
    public  $serie_titre;
    public $serie_description_plus;
    public $serie_realisateur;
    public $serie_cover_image;
    public $serie_trailer;
    public $serie_nombre_episodes;
    public $serie_nombre_saison;
    public $serie_popularity;
    public $serie_value;

    public function getSerie()
    {
        require_once("../controller/singleton_connexion.php");
        global $db;
        $series = $db->prepare('SELECT * FROM series WHERE serie_value = :serie_value AND id_serie = :id_serie ORDER BY serie_titre DESC ');
        $series->bindValue(":serie_value", 1, PDO::PARAM_INT);
        $series->bindValue(":id_serie", $_GET["id"], PDO::PARAM_INT);
        $series->execute();
        if ($series->rowCount() > 0) {
            while ($serie = $series->fetch()) {
                $serie_titre = $serie['serie_titre'];
                $serie_realisateur = $serie['serie_realisateur'];
                $serie_back_cover = $serie['serie_back_cover'];
                $serie_nombre_episodes = $serie['serie_nombre_episodes'];
                $serie_nombre_saison = $serie['serie_nombre_saison'];
                $serie_popularity = $serie['serie_popularity'];
                $serie_value = $serie['serie_value'];
            }
            if ($serie_value == 1) {
                echo "
                <div class='details--content__section' style='background: linear-gradient(rgb(21, 192, 237, 0.5), rgb(7, 30, 83, 1)), url($serie_back_cover);background-repeat: no-repeat !important;background-size: cover;background-position: center;'>
                    <div class='poster--content'>
                        <div class='infos--content'>
                            <h1> $serie_titre</h1>
                            <p>Réalisateur : $serie_realisateur </p>
                            <p>Nombres d'épisodes : $serie_nombre_episodes </p>
                            <p>Nombres de saison : $serie_nombre_saison </p>
                            
                            <div class='stars'>
                                <p>Avis des internautes </p>
                                <i class='fa fa-star gold'></i>
                                <p> $serie_popularity/5</p>
                            </div>
            ";
            if (isset($_SESSION['id_user'])) {
                $id_serie = $_GET['id'];
                $done = $db->prepare('SELECT * FROM wishlist WHERE id_serie = ? AND id_user = ?');
                $done->bindParam(1, $id_serie, PDO::PARAM_INT);
                $done->bindParam(2, $_SESSION['id_user'], PDO::PARAM_INT);
                $done->execute();
                if ($done->rowCount() == 0) {
?>
                    <div class="add-remove-wishlist">
                        <form method="POST" action="">
                            <input type="hidden" name="id_serie" value="<?php echo $id_serie ?>">
                            <button type="submit" title="Ajouter à la wishlist."><i class="fa-solid fa-circle-plus" style="color: rgb(21, 192, 237, 1)"></i></button>
                        </form>
                    </div>
                    <?php
                } else {
                    if (isset($_POST['id_serie'])) {
                        $id_user = $_SESSION['id_user'];
                        $id_serie = $_POST['id_serie'];
                        $delete = $db->prepare('DELETE FROM wishlist WHERE id_user = ? AND id_serie = ?');
                        $delete->bindParam(1, $id_user, PDO::PARAM_INT);
                        $delete->bindParam(2, $id_serie, PDO::PARAM_INT);
                        $delete->execute();
                        if ($delete) {
                    ?>
                            <div class="add-remove-wishlist">
                                <form method="POST" action="">
                                    <input type="hidden" name="id_serie" value="<?php echo $id_serie ?>">
                                    <button type="submit" title="Retirer de la wishlist."><i class="fa-solid fa-circle-minus" style="color: rgb(21, 192, 237, 1)"></i></button>
                                </form>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="add-remove-wishlist">
                            <form method="POST" action="">
                                <input type="hidden" name="id_serie" value="<?php echo $id_serie ?>">
                                <button type="submit" title="Retirer de la wishlist."><i class="fa-solid fa-circle-minus" style="color: rgb(21, 192, 237, 1)"></i></button>
                            </form>
                        </div>
<?php
                    }
                }
            }
            }
        }
    }
}
$serie = new serie();
