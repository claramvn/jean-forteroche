<!-- Header -->
<header>
    <div id="header">
        <div id="div_pages">
            <nav>
                <ul>
                    <li><a href="index.php"><img id="tag" src="public/img/tag.png" alt="Logo Jean Forteroche" /></a>
                    </li>
                    <li><a href="index.php"><i class="fas
                                fa-grip-lines-vertical"></i> ACCUEIL</a></li>
                    <li><a href="index.php?action=author"><i class="fas
                                fa-grip-lines-vertical"></i> L' AUTEUR</a>
                    </li>
                    <li><a href="index.php?action=listPosts"><i class="fas
                                fa-grip-lines-vertical"></i> LES
                            CHAPITRES</a></li>
                </ul>
            </nav>
        </div>
        <div id="div_user">
            <nav>
                <ul class="second_nav_hover">
                    <li>
                        <?php
                        if ($this->is_logged()) {
                            echo '<span class="connected">BONJOUR' . ' <span class="red2">' . mb_strtoupper($this->user['pseudo_user']) . '</span> ! </span>' ?>
                        <i class="fas fa-user"></i>
                        <ul class="second_ul">
                            <?php if ($this->is_admin()) { ?>
                            <li class="first_li"><a href="index.php?action=adminReportedComments">TABLEAU DE BORD</a>
                            </li>
                            <li><a href="index.php?action=profil">PROFIL</a></li>
                            <li><a href="index.php?action=logout">DÉCONNECTION</a></li>
                            <?php } else { ?>
                            <li class="first_li"><a href="index.php?action=profil">PROFIL</a></li>
                            <li><a href="index.php?action=logout">DÉCONNECTION</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php
                        } else { ?>
                    <li>
                        <i class="fas fa-user"></i>
                        <ul class="second_ul">
                            <li class="first_li"><a href="index.php?action=connection">CONNEXION</a></li>
                            <li><a href="index.php?action=register">INSCRIPTION</a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</header>