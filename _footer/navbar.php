<div id="header" class="wrapper">
    <nav>
        <input type="checkbox" id="show-search">
        <input type="checkbox" id="show-menu">
        <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
        <div class="content-navbar">
            <ul class="links">
                <li><a href="https://e-gnose.sfait.fr/">Accueil</a></li>
                <li>
                    <a href="#" class="desktop-link">Catégories</a>
                    <input type="checkbox" id="show-features">
                    <label for="show-features">Catégories</label>
                    <ul>
                        <li><a href="https://e-gnose.sfait.fr/view/categorie.php">Catégories 1</a></li>
                        <li><a href="https://e-gnose.sfait.fr/view/categorie.php">Catégories 2</a></li>
                        <li><a href="https://e-gnose.sfait.fr/view/categorie.php">Catégories 3</a></li>
                        <li><a href="https://e-gnose.sfait.fr/view/categorie.php">Catégories 4</a></li>
                    </ul>
                </li>
                <li><a href="https://e-gnose.sfait.fr/view/wishlist.php">Ma wishlist</a></li>
            </ul>
            <div class="logo">
                <a href="https://e-gnose.sfait.fr/"><span>e</span>-Gnose</a>
            </div>
        </div>

        <?php
        if (isset($_SESSION['id_user']) && $_SESSION['id_user'] != null) {
            echo '<div class="content-navbar" style="right: 45px;">
                    <ul class="links">
                        <li>
                            <button class="icons2 desktop-link"><a href="#" style="padding: 22px 22px 12px 22px;"><i class="far fa-user-circle"></i></a></button>
                            <input type="checkbox" id="show-features">
                            <label for="show-features"><i class="far fa-user-circle"></i></label>
                                <ul style="right: 50px">
                                    <li><a href="https://e-gnose.sfait.fr/view/account_user.php">Mon compte</a></li>
                                    <li><a href="https://e-gnose.sfait.fr/_navbar/deconnexion.php">Se déconnecter</a></li>
                                </ul>
                        </li>
                    </ul>
                    </div>';
        } else {
            echo '<div class="content-navbar" style="right: 45px;padding: 21px 14px 13px 20px;">
                     <ul class="links">
                        <li>
                            <button class="icons2 desktop-link"><a href="https://e-gnose.sfait.fr/view/authentification.php" style="padding: 22px 22px 12px 22px;"><i class="far fa-user-circle"></i></a></button>
                                <input type="checkbox" id="show-features">
                                <label for="show-features"><i class="far fa-user-circle"></i></label>
                        </li>
                     </ul>
                  </div>';
        }
        ?>

    <label for="show-search" class="icons search-icon"><i class="fas fa-search"></i></label>
        <form method="get" action="" class="search-box">
            <input type="search" name="searchdata" id="searchdata" onkeyup="showMovie(this.value)" placeholder="Rechercher un film, une série..." autocomplete="off">
            <button type="submit" class="go-icon" title="Lancer la recherche !"><i class="fas fa-search"></i></button>
            <div class="dropdown--searchbar" id="txtMovie"></div>
        </form>
    </nav>
</div>

<script src="../assets/js/font-awesome.js"></script>