<?php
$mysqli = new mysqli("db", "root", "root", "db");
if ($mysqli->connect_errno) {
    echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
}
$id_Depart = $_GET['idDepart'];
$depart = $_GET['depart'];
$arrivee = $_GET['arrivee'];
$result = $mysqli->query("select prix FROM depart WHERE id_depart='$id_Depart';");
$res = $result->fetch_assoc();
$prix = $res['prix'];
$verif = $_GET['idUser'];
?>
<?php
if (isset($_POST['submit']) and $verif != NULL) {
    if (isset($_POST['nomPassager']) and isset($_POST['prenomPassager']) and isset($_POST['numeroPassager']) and isset($_POST['adressePassager'])) {
        $mysqli = new mysqli("db", "root", "root", "db");
        $nom = $_POST['nomPassager'];
        $prenom = $_POST['prenomPassager'];
        $passeport = $_POST['numeroPassager'];
        $adresse = $_POST['adressePassager'];
        if (!$resInsert = $mysqli->multi_query("CALL nouveau_passager('$passeport','$prenom','$nom','$adresse',$verif,$id_Depart)")) {
            echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
            echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
        } else {
            header("location: http://localhost:8001/billet.php?idDepart=$id_Depart&nom=$nom&prenom=$prenom&passeport=$passeport&adresse=$adresse");
        }
    }
} else {
    if (isset($_POST['nomPassager']) and isset($_POST['prenomPassager']) and isset($_POST['numeroPassager']) and isset($_POST['adressePassager'])) {
        $mysqli = new mysqli("db", "root", "root", "db");
        $nom = $_POST['nomPassager'];
        $prenom = $_POST['prenomPassager'];
        $passeport = $_POST['numeroPassager'];
        $adresse = $_POST['adressePassager'];
        if (!$resInsert = $mysqli->multi_query("CALL nouveau_passager('$passeport','$prenom','$nom','$adresse',NULL,$id_Depart)")) {
            echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
            echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
        } else {
            header("location: http://localhost:8001/billet.php?idDepart=$id_Depart&nom=$nom&prenom=$prenom&passeport=$passeport&adresse=$adresse");
        }
    }
}
?>

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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style_menu.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
                        <h1 class="my-0 site-logo"><a href="index.php">AIRIO</a></h1>
                    </div>
                    <div class="col-10">
                        <nav class="site-navigation text-right" role="navigation">
                            <div class="container">
                                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

                                <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">

                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.html">About us</a></li>
                                    <li><a href="rechercher.php">R??servation de billet</a></li>
                                    <li><a href="contact.html">Contacter nous</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="heading">
        <h1>Paiement</h1>
    </div>
    <!-- container -->
    <section id="main" class="wrapper">
        <div class="inner">
            <div class="content">
                <h3 style="color:blue; text-align: center;">Check-out</h3>
                <table class="table-wrapper">
                    <thead>
                        <tr>
                            <th>Num??ro</th>
                            <th>Prix</th>
                            <th>D??part de</th>
                            <th>Arriv??e ??</th>
                            <th>Totale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>Billet 1</td>
                        <td><?php echo "$prix"; ?></td>
                        <td><?php echo "$depart"; ?></td>
                        <td><?php echo "$arrivee"; ?></td>
                        <td><?php echo "$prix"; ?></td>
                    </tbody>
                </table>

            </div>

            <div class="content">

                <h3 style="color:blue; text-align: center;">D??tails du Passager</h3>
                <form method="post">
                    <div class="row gtr-uniform">
                        <div class="col-6 col-12-xsmall">
                            <label style="text-align: left;">Nom passager</label>
                            <input id="nom-passager" type="text" name="nomPassager" placeholder="Nom passager" aria-label="Card Holder" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <label style="text-align: left;">Pr??nom Passager</label>
                            <input id="prenom-passager" type="text" name="prenomPassager" placeholder="Pr??nom passager" aria-label="Card Holder" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <label style="text-align: left;">Num??ro Passeport</label>
                            <input id="numero-passeport" type="text" name="numeroPassager" placeholder="Num??ro Passeport" aria-label="Card Holder" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <label style="text-align: left;">Adresse</label>
                            <input id="adresse-passager" type="text" name="adressePassager" placeholder="Adresse" aria-label="Card Holder" aria-describedby="basic-addon1">
                        </div>


                        <div class="col-12">
                            <h3 style="color:blue; text-align: center;">D??tails de la carte de cr??dit</h3>
                        </div>

                        <div class="col-12">
                            <label style="text-align: left;">Num??ro de carte</label>
                            <input id="card-number" type="text" placeholder="Num??ro de carte">
                        </div>
                        <div class="col-12">
                            <label style="text-align: left;">Titulaire de la carte</label>
                            <input id="card-holder" type="text" placeholder="Titulaire de la carte">
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <label style="text-align: left;">Date d'expiration</label>
                            <input type="month" placeholder="MM-AA">
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <label style="text-align: left;">CVC</label>
                            <input id="cvc" type="text" placeholder="CVC">
                        </div>
                        <div class="col-12">
                            <ul class="actions">
                                <li><input type="submit" name="submit" value="Proc??der" class="primary" /></li>
                                <li><input type="reset" value="Reset" /></li>
                            </ul>
                        </div>


                    </div>
                </form>

            </div>
        </div> <!-- /container -->
    </section>

    <footer id="footer">
        <div class="inner">
            <div class="content">
                <section>
                    <h3>Service Relation Client??le</h3>
                    <p>Nous sommes ?? votre ??coute 24h/24, 7j/7 sur Messenger, Facebook et Twitter pour faciliter
                        votre
                        voyage. Nous vous aidons o?? que vous soyez</p>
                </section>
                <section>
                    <ul class="alt">
                        <li><a href="index.php">Accueil</a></li>
                        <li>
                            <a href="about.html"></a>Informations
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </section>
                <section>
                    <h4>Visitez nos r??seaux sociaux</h4>
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

</body>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/main.js"></script>

</html>