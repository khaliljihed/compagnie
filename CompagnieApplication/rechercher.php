<?php
$idUser = $_GET['acces'];
if (isset($_POST['submit'])) {
    if (isset($_POST['villesDepart']) and isset($_POST['villesArrivee']) and isset($_POST['datealler'])) {
        header('location: http://localhost:8001/vol.php?villesDepart=' . $_POST['villesDepart'] . '&villesArrivee=' . $_POST['villesArrivee'] . '&datealler=' . $_POST['datealler'] . '&idUser=' . $idUser);
        ob_end_flush();
    } else $erreur = true;
    if ($erreur) {
        echo "<center><p><b>Invalid request !</b></p></center>";
    }
}
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
        <h1>Réservation de billet</h1>
    </div>

    <section id="main" class="wrapper">
        <div class="inner">
            <div class="content">
                <form method="post">
                    <div class="row gtr-uniform">

                        <div class="col-12" data-validate="Entrer le lieu de départ !">
                            <label style="text-align: left;">ville de départ</label>
                            <div class="select">
                                <select name="villesDepart">
                                    <?php
                                    $mysqli = new mysqli("db", "root", "root", "db");
                                    if ($mysqli->connect_errno) {
                                        echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
                                    }
                                    $result = $mysqli->query("select distinct localisation from aeroport;");
                                    echo  "<option>Départ de</option>";
                                    while ($row = mysqli_fetch_row($result)) {
                                        echo  "<option value =" . $row[0] . ">$row[0]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12" data-validate="Entrer le lieu d'arrivée !">
                            <label style="text-align: left;">ville d'arrivée</label>
                            <div class="select">
                                <select name="villesArrivee">
                                    <?php
                                    $mysqli = new mysqli("db", "root", "root", "db");
                                    if ($mysqli->connect_errno) {
                                        echo "<center><p><b>ERROR:' . $mysqli->error' </b></p></center>";
                                    }
                                    $result = $mysqli->query("select distinct localisation from aeroport;");
                                    echo  "<option>Arrivée à</option>";
                                    while ($row = mysqli_fetch_row($result)) {
                                        echo  "<option value =" . $row[0] . ">$row[0]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12" data-validate="Entrer la date de départ">
                            <label style="text-align: CENTER;">Date Aller</label>
                            <input type="date" name="datealler" id="datealler" required="required">
                        </div>

                        <div>
                            <ul class="actions">
                                <li><input type="submit" name="submit" value="RECHERCHER UN VOL" class="primary" /></li>
                                <li><input type="reset" value="Reset" /></li>
                            </ul>
                        </div>
                    </div>
                </form>

            </div>
        </div> <!-- /container -->
    </section>






    <!-- Testimonials -->
    <section class="wrapper">
        <div class="inner">
            <header class="special">
                <h2>Faucibus consequat lorem</h2>
                <p>In arcu accumsan arcu adipiscing accumsan orci ac. Felis id enim aliquet. Accumsan ac integer
                    lobortis commodo ornare aliquet accumsan erat tempus amet porttitor.</p>
            </header>
            <div class="testimonials">
                <section>
                    <div class="content">
                        <blockquote>
                            <p>Nunc lacinia ante nunc ac lobortis ipsum. Interdum adipiscing gravida odio porttitor
                                sem
                                non mi integer non faucibus.</p>
                        </blockquote>
                        <div class="author">
                            <div class="image">
                                <img src="images/pic01.jpg" alt="" />
                            </div>
                            <p class="credit">- <strong>Jane Doe</strong> <span>CEO - ABC Inc.</span></p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="content">
                        <blockquote>
                            <p>Nunc lacinia ante nunc ac lobortis ipsum. Interdum adipiscing gravida odio porttitor
                                sem
                                non mi integer non faucibus.</p>
                        </blockquote>
                        <div class="author">
                            <div class="image">
                                <img src="images/pic03.jpg" alt="" />
                            </div>
                            <p class="credit">- <strong>John Doe</strong> <span>CEO - ABC Inc.</span></p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="content">
                        <blockquote>
                            <p>Nunc lacinia ante nunc ac lobortis ipsum. Interdum adipiscing gravida odio porttitor
                                sem
                                non mi integer non faucibus.</p>
                        </blockquote>
                        <div class="author">
                            <div class="image">
                                <img src="images/pic02.jpg" alt="" />
                            </div>
                            <p class="credit">- <strong>Janet Smith</strong> <span>CEO - ABC Inc.</span></p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>


    <footer id="footer">
        <div class="inner">
            <div class="content">
                <section>
                    <h3>Service Relation Clientèle</h3>
                    <p>Nous sommes à votre écoute 24h/24, 7j/7 sur Messenger, Facebook et Twitter pour faciliter
                        votre
                        voyage. Nous vous aidons où que vous soyez</p>
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