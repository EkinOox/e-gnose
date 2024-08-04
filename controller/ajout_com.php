<?php
require_once("../controller/singleton_connexion.php");
require_once("../model/comment_model.php");
function ajout_com()
{
    global $db;
    $id_user = $_SESSION["id_user"];
    $id_film = $_GET["id"];
    

    if (!empty($_POST)) {
        if (isset($_POST["titre"], $_POST["content"], $_POST["stars"]) && !empty($_POST["titre"]) && !empty($_POST["content"]) && !empty($_POST["stars"])) {
            // Formulaire complet
            // Récupération des données en les protégeants
            // On retire les balises du titre
            $titre = strip_tags($_POST["titre"]);
            // On neutralise les balises du contenu
            $content = htmlspecialchars($_POST["content"]);

            // Enregistrer les données
            $sql = "INSERT INTO `commentaires`(`commentaire_titre`, `commentaire_text`, `commentaire_note`,`commentaire_value`) VALUES (:commentaire_titre, :commentaire_text, :commentaire_note, :commentaire_value)";
            // Préparation de la requête
            $query = $db->prepare($sql);
            $query->bindValue(":commentaire_titre", $titre, PDO::PARAM_STR);
            $query->bindValue(":commentaire_text", $content, PDO::PARAM_STR);
            $query->bindValue(":commentaire_note", strval($_POST["stars"]), PDO::PARAM_STR);
            $query->bindValue(":commentaire_value", 1, PDO::PARAM_INT);
            $query->execute();

            // On execute
            if (!$query) {
                die("Une erreur est survenue");
            } else {
                $id = $db->lastInsertId();
                
                $sql2 = "INSERT INTO `laisser`(`id_user`, `id_commentaire`, `id_film`, `id_serie`,`id_livre`) VALUES (:id_user, :id_commentaire, :id_film, :id_serie, :id_livre)";
                // Préparation de la requête
                $query2 = $db->prepare($sql2);
                $query2->bindValue(":id_user", $id_user, PDO::PARAM_INT);
                $query2->bindValue(":id_commentaire", $id, PDO::PARAM_INT);
                $query2->bindValue(":id_film", $id_film, PDO::PARAM_INT);
                $query2->bindValue(":id_serie", 0, PDO::PARAM_INT);
                $query2->bindValue(":id_livre", 0, PDO::PARAM_INT);
                if (!$query2->execute()) {
                    die("Une erreur est survenue lors de l'ajout dans la table laisser");
                }
            }
        } else {
            die("le formulaire est incomplet");
        }
    }
}

?>
<?php
if (isset($_SESSION['user_nom'])) {
    ajout_com(); ?>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row justify-content-center">
                    <div class="contact-wrap">
                        <h2 class="mb-4 text-center">Ajouter un commentaire</h2>
                        <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="content" class="form-control" id="content" cols="30" rows="8" placeholder="Votre commentaire ..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="stars"> Nombres d'étoiles</label>
                                        <input type="number" class="form-control" name="stars" id="stars" max="5.0" min="1.0" step="0.01" placeholder="Nombres d'étoiles">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" value="Publier" class="btn btn-primary">
                                        <div class="submitting"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<section>
    <div>
        <?php
        $comment->getComment();
        ?>
    </div>
</section>


<?php
?>