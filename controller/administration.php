<?php
class Administration
{



    //Insert
    public function InsertFilm()
    {
        global $db;
        if (isset($_POST['insert_film'])) {
            $req = $db->prepare('INSERT INTO `films`(`id_film`,`film_city`,`film_titre`,`film_description`,`film_realisateur`,`film_cover_image`,`film_back_image`,`film_trailer`, 
            `film_duree`,`film_date`,`film_popularity`,`film_value`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
            $req->execute(array(
                $_POST['id_film'], $_POST['film_city'],
                $_POST['film_titre'], $_POST['film_description'], $_POST['film_realisateur'], $_POST['film_cover_image'],
                $_POST['film_back_image'], $_POST['film_trailer'], $_POST['film_duree'], $_POST['film_date'], $_POST['film_popularity'],
                $_POST['film_value']
            ));
        }
    }
    public function InsertGenre()
    {
        global $db;
        if (isset($_POST['insert_genres'])) {
            $req = $db->prepare('INSERT INTO `genres`(`genre`) VALUES(?)');
            $req->execute(array(
                $_POST['genre']
            ));
        }
    }


    // Modify
    public function ModifyFilm()
    {
        global $db;
        if (isset($_POST['film_titre'])) {
            $modify = $db->prepare('UPDATE films SET film_city=?,film_titre=?,film_description=?,film_realisateur=?, film_cover_image =?, film_back_image =?,film_trailer=?, 
            film_duree=?, film_date=?, film_popularity=?, film_value=? WHERE id_film = ?');
            $modify->execute(array(
                $_POST['film_city'],
                $_POST['film_titre'], $_POST['film_description'], $_POST['film_realisateur'], $_POST['film_cover_image'],
                $_POST['film_back_image'], $_POST['film_trailer'], $_POST['film_duree'], $_POST['film_date'], $_POST['film_popularity'],
                $_POST['film_value'], $_POST['id_film']
            ));
            if ($modify) {
                echo "modification réussi sur l'id : <b>" . $_POST['id_film'] . ' - ' . $_POST['film_titre'] . "</b>";
            } else {
                echo "echec de la modification";
            }
        }
    }
    public function ModifySerie()
    {
        global $db;
        if (isset($_POST['serie_titre'])) {
            $modify = $db->prepare('UPDATE series SET serie_city=?,serie_titre=?,serie_realisateur=?,serie_description_plus=?,serie_duree_episode=?, serie_cover_image =?, serie_back_cover =?,serie_trailer=?, 
            serie_nombre_episodes=?, serie_nombre_saison=?, serie_popularity=?, serie_value=? WHERE id_serie = ?');
            $modify->execute(array(
                $_POST['serie_city'],
                $_POST['serie_titre'], $_POST['serie_realisateur'], $_POST['serie_description_plus'], $_POST['serie_duree_episode'], $_POST['serie_cover_image'],
                $_POST['serie_back_cover'], $_POST['serie_trailer'], $_POST['serie_nombre_episodes'], $_POST['serie_nombre_saison'], $_POST['serie_popularity'],
                $_POST['serie_value'], $_POST['id_serie']
            ));
            if ($modify) {
                echo "modification réussi sur l'id : <b>" . $_POST['id_serie'] . ' - ' . $_POST['serie_titre'] . "</b>";
            } else {
                echo "echec de la modification";
            }
        }
    }
    public function ModifyLivre()
    {
        global $db;
        if (isset($_POST['livre_titre'])) {
            $modify = $db->prepare('UPDATE livres SET livre_titre=?,livre_editeur=?,livre_auteur=?,livre_date_publication=?, livre_nombre_page =?,livre_cover_image=?, 
            livre_description=?, livre_popularity=?, livre_value=? WHERE id_livre = ?');
            $modify->execute(array(
                $_POST['livre_titre'], $_POST['livre_editeur'], $_POST['livre_auteur'], $_POST['livre_date_publication'], 
                $_POST['livre_nombre_page'], $_POST['livre_cover_image'], $_POST['livre_description'], $_POST['livre_popularity'],
                $_POST['livre_value'], $_POST['id_livre']
            ));
            if ($modify) {
                echo "modification réussi sur l'id : <b>" . $_POST['id_livre'] . ' - ' . $_POST['livre_titre'] . "</b>";
            } else {
                echo "echec de la modification";
            }
        }
    }
    public function ModifyUser()
    {
        global $db;
        if (isset($_POST['user_email'])) {
            $modify = $db->prepare('UPDATE users SET user_nom=?, user_email=?,user_role=?,user_telephone=?,user_date_naissance=?, user_value=?,id_abonnement=? WHERE id_user=?');
            $modify->execute(array(
                $_POST['user_nom'], $_POST['user_email'],
                $_POST['user_role'], $_POST['user_telephone'],
                $_POST['user_date_naissance'], $_POST['user_value'],
                $_POST['id_abonnement'], $_POST['id_user']
            ));
            if ($modify) {
                echo "modification réussi sur l'id : <b>" . $_POST['id_user'] . ' - ' . $_POST['user_nom'] . "</b>";
            } else {
                echo "echec de la modification";
            }
        }
    }
    public function ModifyUserAccount()
    {
        global $db;
        if (isset($_POST['user_email'])) {
            $modify = $db->prepare('UPDATE users SET user_nom=?,user_prenom=?, user_email=?,user_address=?,user_city=?,user_country=?,user_cp=?,user_desc=? WHERE id_user=?');
            $modify->execute(array(
                $_POST['user_nom'], $_POST['user_prenom'], $_POST['user_email'],
                $_POST['user_address'], $_POST['user_city'],  $_POST['user_country'],
                $_POST['user_cp'], $_POST['user_desc'], $_SESSION['id_user']
            ));
            if ($modify) {
                echo "
    <div id='modal' class='modal fade' >
        <div class='modal-dialog modal-confirm'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <div class='icon-box'>
                        <i class='material-icons'>&#xE876;</i>
                    </div>
                    <h4 class='modal-title w-100'>Parfait !</h4>
                </div>
                <div class='modal-body'>
                    <p class='text-center'>Vos nouvelles informations ont été enregistrées avec succÃ¨s. Vous devrez peut-Ãªtre rafraichir la page pour les voir apparaitre.</p>
                </div>
                <div class='modal-footer'>
                    <button class='btn btn-success btn-block' data-dismiss='modal'>Fermer</button>
                </div>
            </div>
        </div>
    </div>";
            } else {
                echo "
    <div id='modal' class='modal fade'>
        <div class='modal-dialog modal-confirm'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <div class='icon-box' style='background: red;'>
                        <i class='material-icons'>&#xe000;</i>
                    </div>
                    <h4 class='modal-title w-100'>Erreur !</h4>
                </div>
                <div class='modal-body'>
                    <p class='text-center'>Une erreur est survenue. Veuillez réitérer votre demande ultérieurement.</p>
                </div>
                <div class='modal-footer'>
                    <button class='btn btn-success btn-block' data-dismiss='modal' style='background: red;'>Fermer</button>
                </div>
            </div>
        </div>
    </div>";
            }
        }
    }
    public function ModifyGenre()
    {
        global $db;
        if (isset($_POST['genre'])) {
            $modify = $db->prepare('UPDATE genres SET genre=? WHERE id_genre=?');
            $modify->execute(array(
                $_POST['genre'], $_POST['id_genre']
            ));

            if ($modify) {
                echo "modification réussi sur l'id : <b>" . $_POST['id_genre'] . ' - ' . $_POST['genre'] . "</b>";
            } else {
                echo "echec de la modification";
            }
        }
    }


    // DELETE 
    public function DeleteFilm()
    {
        global $db;
        if (isset($_POST['id_film'])) {
            $req = $db->prepare('DELETE FROM `films` WHERE id_film= ?');
            $req->execute(array($_POST['id_film']));
var_dump($req);
die();
            if ($req) {
                echo "Suppression réussi sur l'id : <b>" . $_POST['id_film'] . ' - ' . $_POST['film_titre'] . "</b>";
            } else {
                echo "Echec de la suppression";
            }
        }
    }
    public function DeleteSerie()
    {
        global $db;
        if (isset($_POST['id_serie'])) {
            $req = $db->prepare('DELETE FROM `series` WHERE id_serie= ?');
            $req->execute(array($_POST['id_serie']));

            if ($req) {
                echo "Suppression réussi sur l'id : <b>" . $_POST['id_serie'] . ' - ' . $_POST['serie_titre'] . "</b>";
            } else {
                echo "Echec de la suppression";
            }
        }
    }
    public function DeleteLivre()
    {
        global $db;
        if (isset($_POST['id_livre'])) {
            $req = $db->prepare('DELETE FROM `livres` WHERE id_livre= ?');
            $req->execute(array($_POST['id_livre']));

            if ($req) {
                echo "Suppression réussi sur l'id : <b>" . $_POST['id_livre'] . ' - ' . $_POST['livre_titre'] . "</b>";
            } else {
                echo "Echec de la suppression";
            }
        }
    }
    public function DeleteUser()
    {
        global $db;
        if (isset($_POST['id_user'])) {
            $req = $db->prepare('DELETE FROM `users` WHERE id_user= ?');
            $req->execute(array($_POST['id_user']));

            if ($req) {
                echo "Suppression réussie sur l'id : <b>" . $_POST['id_user'] . ' - ' . $_POST['user_nom'] . "</b>";
            } else {
                echo "Echec de la suppression";
            }
        }
    }
    public function DeleteGenre()
    {
        global $db;
        if (isset($_POST['id_genre'])) {
            $req = $db->prepare('DELETE FROM `genres` WHERE id_genre= ?');
            $req->execute(array($_POST['id_genre']));

            if ($req) {
                echo "Suppression réussie sur l'id : <b>" . $_POST['id_genre'] . ' - ' . $_POST['genre'] . "</b>";
            } else {
                echo "Echec de la suppression";
            }
        }
    }
    public function DeleteGenreFilm()
    {
        global $db;
        if (isset($_POST['id_genre'])) {
            $req = $db->prepare('DELETE FROM `genre_films` WHERE id_genre= ?');
            $req->execute(array($_POST['id_genre']));
        }
    }
    public function DeleteAbonnement()
    {
        global $db;
        if (isset($_POST['id_abonnement'])) {
            $req = $db->prepare('DELETE FROM `abonnement` WHERE id_abonnement= ?');
            $req->execute(array($_POST['id_abonnement']));
        }
    }
    public function DeleteCommentaire()
    {
        global $db;
        if (isset($_POST['id_commentaire'])) {
            $req = $db->prepare('DELETE FROM `laisser`, WHERE id_commentaire= ?');
            $req->execute(array($_POST['id_commentaire']));
        }
    }
    public function DeleteTag()
    {
        global $db;
        if (isset($_POST['id_tag'])) {
            $req = $db->prepare('DELETE FROM `tag` WHERE id_tag= ?');
            $req->execute(array($_POST['id_tag']));
        }
    }


    //SELECT USER
    public function SelectUser()
    {
        if (isset($_SESSION["id_user"])) {
            global $db;
            $req = $db->prepare('SELECT * FROM `users` WHERE id_user= ?');
            $req->execute(array($_SESSION["id_user"]));
        }
    }

    // SELECT FILM
    public function SelectFilm()
    {
        global $db;
        $req = $db->prepare('SELECT * FROM `films` ');
        $req->execute();
    }
    public function SelectFilmByDateAsc()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films WHERE film_value = 1 ORDER BY film_date DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
<a href="./view/content.php?id=' . $ressources['id_film'] . '">
    <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
    <div class="item__body">
        <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
        <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
        <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
    </div>
</a>
</div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectFilmByPop()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films WHERE film_value = 1 ORDER BY film_popularity DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
<a href="./view/content.php?id=' . $ressources['id_film'] . '">
    <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
    <div class="item__body">
        <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
        <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
        <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
    </div>
</a>
</div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectFilmByFr()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films WHERE film_value = 1 AND film_city="France" ORDER BY film_popularity DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
<a href="./view/content.php?id=' . $ressources['id_film'] . '">
    <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
    <div class="item__body">
        <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
        <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
        <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
    </div>
</a>
</div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }

    public function SelectFilmByAction()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films, genre_films, genres WHERE films.id_film = genre_films.id_film AND genre_films.id_genre = genres.id_genre AND genres.id_genre = 18 AND film_value = 1 ORDER BY film_popularity DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
<a href="./view/content.php?id=' . $ressources['id_film'] . '">
    <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
    <div class="item__body">
        <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
        <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
        <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
    </div>
</a>
</div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectFilmByAventure()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films, genre_films, genres WHERE films.id_film = genre_films.id_film AND genre_films.id_genre = genres.id_genre AND genres.id_genre = 12 AND film_value = 1 ORDER BY film_popularity DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
<a href="./view/content.php?id=' . $ressources['id_film'] . '">
    <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
    <div class="item__body">
        <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
        <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
        <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
    </div>
</a>
</div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectFilmBySF()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films, genre_films, genres WHERE films.id_film = genre_films.id_film AND genre_films.id_genre = genres.id_genre AND genres.id_genre = 878 AND film_value = 1 ORDER BY film_date DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
    <a href="./view/content.php?id=' . $ressources['id_film'] . '">
        <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
        <div class="item__body">
            <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
            <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
            <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
        </div>
    </a>
</div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectFilmByHorror()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films, genre_films, genres WHERE films.id_film = genre_films.id_film AND genre_films.id_genre = genres.id_genre AND genres.id_genre = 27 AND film_value = 1 ORDER BY film_date DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
    <a href="./view/content.php?id=' . $ressources['id_film'] . '">
        <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
        <div class="item__body">
            <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
            <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
            <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
        </div>
    </a>
</div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectFilmByFantastique()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films, genre_films, genres WHERE films.id_film = genre_films.id_film AND genre_films.id_genre = genres.id_genre AND genres.id_genre = 14 AND film_value = 1 ORDER BY film_date DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
    <a href="./view/content.php?id=' . $ressources['id_film'] . '">
        <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
        <div class="item__body">
            <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
            <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
            <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
        </div>
    </a>
</div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectFilmByLong()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films WHERE film_value = 1 ORDER BY film_duree DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
    <a href="./view/content.php?id=' . $ressources['id_film'] . '">
        <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
        <div class="item__body">
            <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
            <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
            <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
        </div>
    </a>
</div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectFilmByCourt()
    {
        global $db;
        $allRessources = $db->query('SELECT * FROM films WHERE film_value = 1 ORDER BY film_duree ASC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
                        <a href="./view/content.php?id=' . $ressources['id_film'] . '">
                        <div class="item__image"><img src="' . $ressources['film_cover_image'] . '" alt=""></div>
                        <div class="item__body">
                            <div class="item__title">' . strip_tags($ressources['film_titre']) . '</div>
                            <div class="item__description">' . substr($ressources['film_description'], 0, 200) . '... <br/>
                            <a style="float: right" href="./view/content.php?id=' . $ressources['id_film'] . '">Lire la suite...</a></div>
                        </div>
                        </a> 
                      </div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }


    // SELECT SERIE
    public function SelectSerieByPop()
    {
        global $db;
        $allRessources = $db->prepare('SELECT * FROM `series`  WHERE serie_cover_image != " " AND serie_value = 1 ORDER BY serie_popularity DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
                        <a href="./view/content_serie.php?id=' . $ressources['id_serie'] . '">
                            <div class="item__image"><img src="' . $ressources['serie_cover_image'] . '" alt=""></div>
                            <div class="item__body">
                                <div class="item__title">' . strip_tags($ressources['serie_titre']) . '</div>
                            </div>
                        </a>
                    </div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectSerieByMinDuree()
    {
        global $db;
        $allRessources = $db->prepare('SELECT * FROM `series`  WHERE serie_cover_image != " " AND serie_value = 1 ORDER BY serie_duree_episode DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
                        <a href="./view/content_serie.php?id=' . $ressources['id_serie'] . '">
                            <div class="item__image"><img src="' . $ressources['serie_cover_image'] . '" alt=""></div>
                            <div class="item__body">
                                <div class="item__title">' . strip_tags($ressources['serie_titre']) . '</div>
                            </div>
                        </a>
                    </div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectSerieByUsCity()
    {
        global $db;
        $allRessources = $db->prepare('SELECT * FROM `series`  WHERE serie_city = "US" AND serie_cover_image != " " AND serie_value = 1 ORDER BY serie_titre DESC LIMIT 15');
        $allRessources->execute();
        if ($allRessources->rowCount() > 0) {
            while ($ressources = $allRessources->fetch()) {
                echo '<div class="item" style="width: 85%">
                        <a href="./view/content_serie.php?id=' . $ressources['id_serie'] . '">
                            <div class="item__image"><img src="' . $ressources['serie_cover_image'] . '" alt=""></div>
                            <div class="item__body">
                                <div class="item__title">' . strip_tags($ressources['serie_titre']) . '</div>
                            </div>
                        </a>
                    </div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }

    // SELECT LIVRE
    public function SelectLivreNbPageAsc()
    {
        global $db;
        $req = $db->prepare('SELECT * FROM `livres` WHERE livre_value = 1 ORDER By livre_nombre_page ASC ');
        $req->execute();
        if ($req->rowCount() > 0) {
            while ($ressources = $req->fetch()) {
                echo '<div class="item" style="width: 85%">
                        <a href="./view/content_livre.php?id=' . $ressources['id_livre'] . '">
                            <div class="item__image"><img src="' . $ressources['livre_cover_image'] . '" alt=""></div>
                            <div class="item__body">
                                <div class="item__title">' . strip_tags($ressources['livre_titre']) . '</div>
                            </div>
                        </a>
                    </div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    public function SelectLivreDateAsc()
    {
        global $db;
        $req = $db->prepare('SELECT * FROM `livres` WHERE livre_value = 1 ORDER By livre_date_publication ASC');
        $req->execute();
        if ($req->rowCount() > 0) {
            while ($ressources = $req->fetch()) {
                echo '<div class="item" style="width: 85%">
                        <a href="./view/content_livre.php?id=' . $ressources['id_livre'] . '">
                            <div class="item__image"><img src="' . $ressources['livre_cover_image'] . '" alt=""></div>
                            <div class="item__body">
                                <div class="item__title">' . strip_tags($ressources['livre_titre']) . '</div>
                            </div>
                        </a>
                    </div>';
            }
        } else {
            echo "<p>Aucun média trouvé</p>";
        }
    }
    
    
    
    
     //SELECT ACTOR
     public function SelectActor()
     {
         global $db;
         $id = $_GET['id'];
         $acteur = $db->prepare('SELECT * FROM acteurs, personnage, films  WHERE acteurs.id_acteur = personnage.id_acteur AND personnage.id_film = films.id_film AND films.id_film = ? ORDER BY personnage.personnage_order ASC LIMIT 0,10');
         $acteur->bindParam(1, $id, PDO::PARAM_INT);
         $acteur->execute();
         if ($acteur->rowCount() > 0) {
             while ($acteurs = $acteur->fetch(PDO::FETCH_ASSOC)) {
                 echo '<div class="item" style="width: 85%">
                         <div class="item__image"><img src="' . $acteurs['acteur_img'] . '" alt=""></div>
                         <div class="item__body">
                             <div class="item__title">' . strip_tags($acteurs['acteur_nom']) . '</div>
                             <div class="item__description">' . strip_tags($acteurs['personnage_nom']) . '</div><br/>
                         </div>
                     </div>';
             }
         }else {
             echo "<p>Aucun acteur disponible pour le moment</p>";
         }
     }

    // SELECT USER INFO
    public function SelectUserInfo()
    {
        global $db;
        global $donnees;
        $req = $db->prepare('SELECT users.*, abonnement.type FROM `users`, `abonnement`  WHERE id_user= ? AND users.id_abonnement =  abonnement.id_abonnement');
        $req->execute(array($_SESSION["id_user"]));
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
    }
}

$administration = new Administration();
