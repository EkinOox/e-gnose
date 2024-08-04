<?php
if (isset($_POST["id_livre"])) {
    $id_user = $_SESSION["id_user"];
    $id_livre = $_GET['id'];

    $done = $db->prepare('SELECT * FROM wishlist WHERE id_livre = ? AND id_user = ?');
    $done->bindParam(1, $id_livre, PDO::PARAM_INT);
    $done->bindParam(2, $id_user, PDO::PARAM_INT);
    $done->execute();
    if ($done->rowCount() == 0) {
        $insert = $db->prepare('INSERT INTO wishlist (id_user, id_livre) VALUES (?, ?)');
        $insert->execute([$id_user, $id_livre]);
        if ($insert) {
            header('Location: ../view/wishlist.php');
            exit;
        }
    } else {
        header('Location: ../view/wishlist.php');
        exit;
    }
}

class livre
{
    public $id_livre;
    public $livre_titre;
    public $livre_auteur;
    public $livre_editeur;
    public $livre_date_publication;
    public $livre_nombre_page;
    public $livre_cover_image;
    public $livre_popularity;
    public $livre_value;

    public function getlivre()
    {
        require_once("../controller/singleton_connexion.php");
        global $db;
        $livres = $db->prepare('SELECT * FROM livres WHERE livre_value = :livre_value AND id_livre = :id_livre ORDER BY livre_titre DESC ');
        $livres->bindValue(":livre_value", 1, PDO::PARAM_INT);
        $livres->bindValue(":id_livre", $_GET["id"], PDO::PARAM_INT);
        $livres->execute();
        if ($livres->rowCount() > 0) {
            while ($livre = $livres->fetch()) {
                $livre_titre = $livre['livre_titre'];
                $livre_auteur = $livre['livre_auteur'];
                $livre_editeur = $livre['livre_editeur'];
                $livre_cover_image = $livre['livre_cover_image'];
                $livre_nombre_page = $livre['livre_nombre_page'];
                $livre_date_publication = explode("-", $livre['livre_date_publication']);
                $livre_popularity = $livre['livre_popularity'];
                $livre_value = $livre['livre_value'];
            }
            if ($livre_value == 1) {
                echo "
                <div class='details--content__section' style='background: linear-gradient(rgb(21, 192, 237, 0.5), rgb(7, 30, 83, 1)), url(\"https://i.pinimg.com/originals/61/63/be/6163be93c09e268bebdb6b983c3137c9.png\");background-repeat: no-repeat !important;background-size: cover;background-position: center;'>
                    <div class='poster--content'>
                        <div class='infos--content'>
                            <h1> $livre_titre ($livre_date_publication[0])</h1>
                            <p>Auteur : $livre_auteur.</p>
                            <p>Editeur : $livre_editeur.</p>
                            <p>Nombre de page : $livre_nombre_page minutes.</p>
                            
                            <div class='stars'>
                                <p>Avis des internautes :</p><i class='fa fa-star gold'></i><p> $livre_popularity/5</p>
                            </div>
            ";

                if (isset($_SESSION['id_user'])) {
                    $id_livre = $_GET['id'];
                    $done = $db->prepare('SELECT * FROM wishlist WHERE id_livre = ? AND id_user = ?');
                    $done->bindParam(1, $id_livre, PDO::PARAM_INT);
                    $done->bindParam(2, $_SESSION['id_user'], PDO::PARAM_INT);
                    $done->execute();
                    if ($done->rowCount() == 0) {
?>
                        <div class="add-remove-wishlist">
                            <form method="POST" action="">
                                <input type="hidden" name="id_livre" value="<?php echo $id_livre ?>">
                                <button type="submit" title="Ajouter à la wishlist."><i class="fa-solid fa-circle-plus" style="color: rgb(21, 192, 237, 1)"></i></button>
                            </form>
                        </div>
                        <?php
                    } else {
                        if (isset($_POST['id_livre'])) {
                            $id_user = $_SESSION['id_user'];
                            $id_livre = $_POST['id_livre'];
                            $delete = $db->prepare('DELETE FROM wishlist WHERE id_user = ? AND id_livre = ?');
                            $delete->bindParam(1, $id_user, PDO::PARAM_INT);
                            $delete->bindParam(2, $id_livre, PDO::PARAM_INT);
                            $delete->execute();
                            if ($delete) {
                        ?>
                                <div class="add-remove-wishlist">
                                    <form method="POST" action="">
                                        <input type="hidden" name="id_livre" value="<?php echo $id_livre ?>">
                                        <button type="submit" title="Retirer de la wishlist."><i class="fa-solid fa-circle-minus" style="color: rgb(21, 192, 237, 1)"></i></button>
                                    </form>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="add-remove-wishlist">
                                <form method="POST" action="">
                                    <input type="hidden" name="id_livre" value="<?php echo $id_livre ?>">
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

$livre = new livre();
