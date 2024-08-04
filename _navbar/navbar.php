<div id="header" class="wrapper">
    <nav>
        <input type="checkbox" id="show-search">
        <input type="checkbox" id="show-menu">
        <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
        <div class="content-navbar">
            <ul class="links">
                <li><a href="./index.php">Accueil</a></li>

                <li>
                    <a href="#" class="desktop-link">Catégories</a>
                    <input type="checkbox" id="category-dropdown">
                    <label for="category-dropdown">Catégories</label>
                    <ul>
                        <li><a href="../view/film.php">Films</a></li>
                        <li><a href="../view/serie.php">Séries</a></li>
                        <li><a href="../view/livre.php">Livres</a></li>
                    </ul>
                </li>


                
                <li><a href="../view/wishlist.php">Ma wishlist</a></li>



                <div class="responsive-navbar">
                    <?php
                    if (isset($_SESSION['id_user']) && $_SESSION['id_user'] != null) {
                        echo '<li>
 <input type="checkbox" id="user-area-dropdown">
 <label for="user-area-dropdown">Mon compte</label>
 <ul>
 <li><a href="./view/account_user.php">Accéder à mon compte</a></li>';
                        if (isset($_SESSION['id_user']) && $_SESSION['user_role'] == 1) {
                            echo '<li><a href="./index-admin.php">Espace admin</a></li>';
                        }
                        echo '<li><a href="./_navbar/deconnexion.php">Se déconnecter</a></li>
 </ul>
 </li>';
                    } else {
                        echo '<li><a href="../view/authentification.php">Mon compte</a></li>';
                    }
                    ?>
            </ul>


            <div class="logo">
                <a href="./"><span>e</span>-Gnose</a>
            </div>

            <div class="desktop-navbar">
                <?php
                if (isset($_SESSION['id_user']) && $_SESSION['id_user'] != null) {
                    echo ' <div class="content-navbar" style="right: 45px;">
 <ul class="links">
 <li>
 <button class="icons2 desktop-link"><a href="#" style="padding: 22px 22px 12px 22px;"><i class="far fa-user-circle"></i></a></button>
 <input type="checkbox" id="show-user-features">
 <label for="show-user-features"><i class="far fa-user-circle"></i></label>
 <ul style="right: 50px">
 <li><a href="./view/account_user.php">Mon compte</a></li>';
                    if (isset($_SESSION['id_user']) && $_SESSION['user_role'] == 1) {
                        echo '<li><a href="./index-admin.php">Espace admin</a></li>';
                    }
                    echo '<li><a href="./_navbar/deconnexion.php">Se déconnecter</a></li>
 </ul>
 </li>
 </ul>
 </div>';
                } else {
                    echo '<div class="content-navbar" style="right: 45px;padding: 21px 14px 13px 20px;">
 <ul class="links">
 <li>
 <button class="icons2 desktop-link"><a href="../view/authentification.php" style="padding: 22px 22px 12px 22px;"><i class="far fa-user-circle"></i></a></button>
 <input type="checkbox" id="show-features">
 <label for="show-features"><i class="far fa-user-circle"></i></label>
 </li>
 </ul>
 </div>';
                }
                ?>
            </div>
        </div>


        <label for="show-search" class="icons search-icon"><i class="fas fa-search"></i></label>
        <form method="get" action="" class="search-box">
            <input type="search" name="searchdata" id="searchdata" onkeyup="showMovie(this.value)"
                   placeholder="Rechercher un film, une série.." autocomplete="off">
            <button type="submit" class="go-icon" title="Lancer la recherche !"><i class="fas fa-search"></i>
            </button>
            <div class="dropdown--searchbar" id="txtMovie"></div>
        </form>
    </nav>
</div>

<script src="./assets/js/font-awesome.js"></script>