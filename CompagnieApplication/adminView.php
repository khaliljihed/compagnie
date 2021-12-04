<?php echo $_SESSION ?>
<?php
	if (isset($_POST['submit_p'])){
		if (isset($_POST['numero_ss'])){
		$numeroSS=$_POST['numero_ss'];
	    $mysqli = new mysqli("db", "root", "root", "db");
	    if (!$res=$mysqli->multi_query("delete from pilote where numero_SS='$numeroSS'")) 
	    {
		    echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
	    }
	    else{
		    header('location: http://localhost:8001/adminView.php');
	    }
    }}
    if (isset($_POST['submit_a'])){
		if (isset($_POST['nom_aeroport']) and isset($_POST['code'])){
		$nom_aeroport=$_POST['nom_aeroport'];
		$code=$_POST['code'];
	    $mysqli = new mysqli("db", "root", "root", "db");
	    if (!$res=$mysqli->multi_query("delete from aeroport where nom_aeroport='$nom_aeroport' and code='$code'")) 
	    {
		    echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
	    }
	    else{
		    header('location: http://localhost:8001/adminView.php');
	    }
    }}
    if (isset($_POST['submit_e'])){
		if (isset($_POST['numero_ss_membre'])){
		$numero_ss_membre=$_POST['numero_ss_membre'];
	    $mysqli = new mysqli("db", "root", "root", "db");
	    if (!$res=$mysqli->multi_query("delete from membre_equipage where numero_SS='$numero_ss_membre'")) 
	    {
		    echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
	    }
	    else{
		    header('location: http://localhost:8001/adminView.php');
	    }
    }}
    if (isset($_POST['submit_l'])){
		if (isset($_POST['numero_vol_liaison'])){
		$numero_vol_liaison=$_POST['numero_vol_liaison'];
	    $mysqli = new mysqli("db", "root", "root", "db");
	    if (!$res=$mysqli->multi_query("delete from vol_aeroport where numero_vol='$numero_vol_liaison'")) 
	    {
		    echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
	    }
	    else{
		    header('location: http://localhost:8001/adminView.php');
	    }
	}}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Airio</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="assets/css/main_1.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style_menu.css">
</head>

<body>

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <div class="site-navbar-wrap">
        <div class="site-navbar-top">
            <div class="container py-3">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="d-flex mr-auto">
                            <a href="#" class="d-flex align-items-center mr-4">
                                <span class="icon-envelope mr-2"></span>
                                <span class="d-none d-md-inline-block">info@domain.com</span>
                            </a>
                            <a href="#" class="d-flex align-items-center mr-auto">
                                <span class="icon-phone mr-2"></span>
                                <span class="d-none d-md-inline-block">+1 234 4567 8910</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div class="mr-auto">
                            <a href="#" class="p-2 pl-0"><span class="icon-twitter"></span></a>
                            <a href="#" class="p-2 pl-0"><span class="icon-facebook"></span></a>
                            <a href="#" class="p-2 pl-0"><span class="icon-linkedin"></span></a>
                            <a href="#" class="p-2 pl-0"><span class="icon-instagram"></span></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="site-navbar site-navbar-target js-sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-2">
                        <h1 class="my-0 site-logo"><a href="index.html">AIRIO</a></h1>
                    </div>
                    <div class="col-10">
                        <nav class="site-navigation text-right" role="navigation">
                            <div class="container">
                                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

                                <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.html">About us</a></li>
                                    <li><a href="rechercher.php">Réservation de billet</a></li>
                                    <li><a href="signin.php">Connexion</a></li>
                                    <li><a href="signup.php">S'inscrire</a></li>
                                    <li><a href="contact.html">Contacter nous</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Heading -->
    <div id="heading">
        <h1>Gérer la base des données</h1>
    </div>

    <section id="main" class="wrapper">
        <div class="inner">
            <div class="content">

<div class="tabs">
    
    <input type="radio" style=" display : none;" name="tabs" id="tabone" checked="checked" >
    <label for="tabone">Pilotes</label>
    <div class="tab">
        <ul class="actions">
            <li><a href="addPilote.php" class="button primary icon fa-plus">Ajouter Pilote</a></li>
        </ul>
        <table class="table-wrapper">
            <h1>Tableau des pilotes </h1>
            <thead>
                <tr>
                    <th>Numéro sécurité sociale</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Salaire</th>
                    <th>Heures de vol</th>
                    <th>Numéro License</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            $mysqli = new mysqli("db", "root", "root", "db");
            $result=$mysqli->multi_query("select * from pilote;");
            do {
            if ($result = $mysqli->store_result()) {
                $arrayResult= $result->fetch_all();
                foreach($arrayResult as $row){
                $nom_pilote=$row[4];
                $prenom_pilote=$row[3];
                $salaire_pilote=$row[6];
                $heure_vol=$row[2];
                $numero_license=$row[1];
                $numero_ss=$row[0];
                $adresse=$row[5];
                echo "
                <tr>
                    <td>$numero_ss</td>
                    <td>$nom_pilote</td>
                    <td>$prenom_pilote</td>
                    <td>$salaire_pilote</td>
                    <td>$heure_vol</td>
                    <td>$numero_license</td>
                    <td>$adresse</td>
                    <td>
                    <form method='post'>
                        <input type='hidden' name='numero_ss' value='$numero_ss'>
                        <ul class='actions'>
                            <li><input type='submit' name='submit_p' value='Delete' class='primary'/></li>
                        </ul>
                    </form>
                    </td>
                </tr>";}

            }
            }while ($mysqli->more_results() && $mysqli->next_result());
            ?>
            </tbody>
        </table>
    </div>
    
    <input type="radio" name="tabs" id="tabtwo" class="rad">
    <label for="tabtwo">Aéroports </label>
    <div class="tab">
        <ul class="actions">
            <li><a href="addAeroport.php" class="button primary icon fa-plus">Ajouter Aéroport</a></li>
        </ul>
        <table class="table-wrapper">
            <h1>Tableau d'aéroports </h1>
            <thead></thead>
            <tr>
                <th>Nom aéroport</th>
                <th>Code</th>
                <th>Ville</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php 
            $mysqli = new mysqli("db", "root", "root", "db");
            $result=$mysqli->multi_query("select * from aeroport;");
            do {
            if ($result = $mysqli->store_result()) {
                $arrayResult= $result->fetch_all();
                foreach($arrayResult as $row){
                $nom_aeroport=$row[0];
                $code=$row[1];
                $ville=$row[2];
                echo " <tr>
                    <td>$nom_aeroport</td>
                    <td>$code</td>
                    <td>$ville</td>
                    <td>
                    <form method='post'>
                    <input type='hidden' name='nom_aeroport' value='$nom_aeroport'>
                    <input type='hidden' name='code' value='$code'>
                        <ul class='actions'>
                            <li><input type='submit' name='submit_a' value='Delete' class='primary'/></li>
                        </ul>
                    </form>
                    </td>
                </tr>";}

            }
            }while ($mysqli->more_results() && $mysqli->next_result());
            ?>
            </tbody>
        </table>
    </div>
    
    <input type="radio"  name="tabs" id="tabthree" class="tabs">
    <label for="tabthree">Equipage </label>
    <div class="tab">
        <ul class="actions">
            <li><a href="addEquipage.php" class="button primary icon fa-plus">Ajouter Membre
                    d'équipage</a></li>
        </ul>
        <table class="table-wrapper">
            <h1>Tableau de Membres d'équipage </h1>
            <thead>
                <tr>
                    <th>Numéro sécurité sociale</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Salaire</th>
                    <th>Heures de vol</th>
                    <th>Fonction</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            $mysqli = new mysqli("db", "root", "root", "db");
            $result=$mysqli->multi_query("select * from membre_equipage;");
            do {
            if ($result = $mysqli->store_result()) {
                $arrayResult= $result->fetch_all();
                foreach($arrayResult as $row){
                $nom_membre=$row[4];
                $prenom_membre=$row[3];
                $salaire_membre=$row[6];
                $heure_vol_membre=$row[2];
                $fonction=$row[1];
                $numero_ss_membre=$row[0];
                $adresse_membre=$row[5];
                echo " <tr>
                    <td>$numero_ss_membre</td>
                    <td>$nom_membre</td>
                    <td>$prenom_membre</td>
                    <td>$salaire_membre</td>
                    <td>$heure_vol_membre</td>
                    <td>$fonction</td>
                    <td>$adresse_membre</td>
                    <td>
                    <form method='post'>
                    <input type='hidden' name='numero_ss_membre' value='$numero_ss_membre'>
                        <ul class='actions'>
                            <li><input type='submit' name='submit_e' value='Delete' class='primary'/></li>
                        </ul>
                    </form>
                    </td>
                </tr>";}

            }
            }while ($mysqli->more_results() && $mysqli->next_result());
            ?>
            </tbody>
        </table>
    </div>
    
    <input type="radio" name="tabs" id="tabfour" class="rad">
    <label for="tabfour">Vols</label>
    <div class="tab">
        <ul class="actions">
            <li><a href="addVol.php" class="button primary icon fa-plus">Ajouter Vol</a></li>
        </ul>
        <table class="table-wrapper">
            <h1>Tableau de vols </h1>
            <thead>
                <tr>
                    <th>Numéro vol</th>
                    <th>Début de période</th>
                    <th>Fin de période</th>
                    <th>Heure départ</th>
                    <th>Heure arrivée</th>
                    <th>Numéro immatriculation d'avion</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            $mysqli = new mysqli("db", "root", "root", "db");
            $result=$mysqli->multi_query("select * from vol;");
            do {
            if ($result = $mysqli->store_result()) {
                $arrayResult= $result->fetch_all();
                foreach($arrayResult as $row){
                $numero_vol=$row[0];
                $debutP=$row[1];
                $finP=$row[2];
                $heureD=$row[3];
                $heureA=$row[4];
                $numero_imm=$row[5];
                echo " <tr>
                    <td>$numero_vol</td>
                    <td>$debutP</td>
                    <td>$finP</td>
                    <td>$heureD</td>
                    <td>$heureA</td>
                    <td>$numero_imm</td>
                </tr>";}

            }
            }while ($mysqli->more_results() && $mysqli->next_result());
            ?>
            </tbody>
        </table>
    </div>
    <input type="radio" name="tabs" id="tabfive" class="rad">
    <label for="tabfive">Départ</label>
    <div class="tab">
        <ul class="actions">
            <li><a href="addDepart.php" class="button primary icon fa-plus">Ajouter un départ</a></li>
        </ul>
        <table class="table-wrapper">
            <h1>Tableau des départs </h1>
            <thead>
                <tr>
                    <th>Place libre</th>
                    <th>Place occupée</th>
                    <th>Date de départ</th>
                    <th>Numéro de vol</th>
                    <th>prix</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            $mysqli = new mysqli("db", "root", "root", "db");
            $result=$mysqli->multi_query("select * from depart;");
            do {
            if ($result = $mysqli->store_result()) {
                $arrayResult= $result->fetch_all();
                foreach($arrayResult as $row){
                $pl=$row[1];
                $pc=$row[2];
                $db=$row[3];
                $Num_vol=$row[4];
                $prix=$row[5];
                echo " <tr>
                    <td>$pl</td>
                    <td>$pc</td>
                    <td>$db</td>
                    <td>$Num_vol</td>
                    <td>$prix</td>
                </tr>";}

            }
            }while ($mysqli->more_results() && $mysqli->next_result());
            ?>
            </tbody>
        </table> 
    </div>
    <input type="radio" name="tabs" id="tabsix" class="rad">
    <label for="tabsix">Liaisons</label>
    <div class="tab">
    <ul class="actions">
                    <li><a href=" addLiaison.php" class="button primary icon fa-plus">Ajouter une liaison</a></li>
                </ul>
      <table class="table-wrapper">
        <h1>Tableau de liaisons </h1>
        <thead>
            <tr>
                <th>Numéro vol</th>
                <th>Nom aéroport départ</th>
                <th>Code aéroport départ</th>
                <th>Nom aéroport arrivée</th>
                <th>Code aéroport arrivée</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
        $mysqli = new mysqli("db", "root", "root", "db");
        $result=$mysqli->multi_query("select * from vol_aeroport;");
        do {
        if ($result = $mysqli->store_result()) {
            $arrayResult= $result->fetch_all();
            foreach($arrayResult as $row){
            $numero_vol_liaison=$row[0];
            $aeropD=$row[1];
            $codeD=$row[2];
            $aeropA=$row[3];
            $codeA=$row[4];
            echo " <tr>
                <td>$numero_vol_liaison</td>
                <td>$aeropD</td>
                <td>$codeD</td>
                <td>$aeropA</td>
                <td>$codeA</td>
                <td>
                <form method='post'>
                <input type='hidden' name='numero_vol_liaison' value='$numero_vol_liaison'>
                    <ul class='actions'>
                        <li><input type='submit' name='submit_l' value='Delete' class='primary'/></li>
                    </ul>
                </form>
                </td>
            </tr>";}

        }
        }while ($mysqli->more_results() && $mysqli->next_result());
        ?>
        </tbody>
    </table>
</div>

  </div>

            </div>
        </div>

    </section>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <div class="content">
                <section>
                    <h3>Service Relation Clientèle</h3>
                    <p>Nous sommes à votre écoute 24h/24, 7j/7 sur Messenger, Facebook et Twitter pour faciliter
                        votre voyage. Nous vous aidons où que vous soyez</p>
                </section>
                <section>
                    <ul class="alt">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="about.html"></a>Informations</li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </section>
                <section>
                    <h4>Visitez nos réseaux sociaux</h4>
                    <ul class="plain">
                        <li><a href="#"><i class="icon fa-twitter">&nbsp;</i>Twitter</a></li>
                        <li><a href="#"><i class="icon fa-facebook">&nbsp;</i>Facebook</a></li>
                        <li><a href="#"><i class="icon fa-instagram">&nbsp;</i>Instagram</a></li>
                        <li><a href="#"><i class="icon fa-github">&nbsp;</i>Github</a></li>
                    </ul>
                </section>
            </div>
            <div class="copyright">
                &copy; 2020, CentraleAir. Designed by<a href="https://unsplash.co">Groupe Centrale</a>
            </div>
        </div>
    </footer>





    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/main.js"></script>
</body>

</html>