<?php
/**
 * @file      gabarit.php
 * @brief     This view is designed to centralize all common graphical component like header and footer (will be call by all views)
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY & Pascal BENZONANA
 * @version   23-MAY-2020
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="view/content/images/icons/favicon.jpg" style="border-radius: 50%"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="view/content/css/util.css">
    <link rel="stylesheet" type="text/css" href="view/content/css/main.css">
    <!--===============================================================================================-->
    <link rel="script" type
    "tex>
    <script src="view/content/js/formControl.js"></script>
</head>
<body class="animsition">
<!-- Header -->
<header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
        <div class="topbar">
            <div class="topbar-social">
                <a href="https://www.instagram.com/paleofestival/" target="_blank"
                   class="social-item fa fa-instagram"></a>
                <a href="https://www.youtube.com/c/Pal%C3%A9oFestivalNyonSuisse/videos" target="_blank"
                   class="social-item fa fa-youtube-play"></a>
            </div>


            <div class="topbar-child2">
					<span class="topbar-email">
                        <?php if (isset($_SESSION['user_email'])) : ?>
                            <?= $_SESSION['user_email']; ?>
                        <?php endif; ?>
					</span>
            </div>
        </div>

        <div class="wrap_header">
            <!-- Logo -->
            <div class="logoPlace">
                <a href="index.php" class="logo">
                    <img src="view/content/images/icons/logo.png" width="140" alt="IMG-LOGO">
                </a>
            </div>
            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="index.php">Accueil</a>
                        </li>

                        <li>

                            <a href="index.php?action=displayEvents">Les événements</a>

                        </li>

                        <?php if (!isset($_SESSION['user_email']) || ((@$_GET['action'] == "logout"))) : ?>
                            <li>
                                <a href="index.php?action=login">Login</a>
                            </li>
                            <li>
                                <a href="index.php?action=register">S'enregistrer</a>
                            </li>
                        <?php else : ?>
                            <?php if ($_SESSION['userType'] == 1) : ?>
                                <li>
                                    <a href="index.php?action=articlesAdmin">Gestion</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="index.php?action=logout">Logout</a>
                            </li>

                        <?php endif; ?>
                        <li>
                            <a href="index.php?action=displayCreateEvents">Créer un événement</a>
                        </li>
                    </ul>
                </nav>
            </div>


            <!-- Header Icon -->
            <div class="header-icons">

                <?php if (!isset($_SESSION['user_id']) || (!isset($_GET['action'])) || ((@$_GET['action'] == "logout"))) : ?>
                    <a href="index.php?action=login" class="header-wrapicon1 dis-block">
                        <img src="view/content/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                    </a>
                <?php else : ?>
                    <a href="index.php?action=profil" class="header-wrapicon1 dis-block ">
                        <img src="<?= $_SESSION['profile_pic'] ?>" class="header-icon1">
                    </a>
                <?php endif; ?>


            </div>
        </div>
    </div>
</header>
<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            <div class="item-slick1 item1-slick1"><img id="mainBanner" src="" class="banner">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37"
                              data-appear="zoomIn">
							<?= $titlebanner ?>
						</span>
                </div>
            </div>

        </div>
    </div>
</section>
<header>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="index.php" class="logo-mobile">
            <img src="view/content/images/icons/logo.png" alt="IMG-LOGO">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">

                <?php if (!isset($_SESSION['userEmailAddress']) || (!isset($_GET['action'])) || ((@$_GET['action'] == "logout"))) : ?>
                    <a href="index.php?action=login" class="header-wrapicon1 dis-block">
                        <img src="view/content/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                    </a>
                <?php else : ?>
                    <a href="index.php?action=logout" class="header-wrapicon1 dis-block">
                        <img src="view/content/images/icons/icon-header-01-log.png" class="header-icon1" alt="ICON">
                    </a>
                <?php endif; ?>

                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    <img src="view/content/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown"
                         alt="ICON">
                    <span class="header-icons-noti">0</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="view/content/images/item-cart-01.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        White Shirt With Pleat Detail Back
                                    </a>

                                    <span class="header-cart-item-info">
											1 x $19.00
										</span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="view/content/images/item-cart-02.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        Converse All Star Hi Black Canvas
                                    </a>

                                    <span class="header-cart-item-info">
											1 x $39.00
										</span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="view/content/images/item-cart-03.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        Nixon Porter Leather Watch In Tan
                                    </a>

                                    <span class="header-cart-item-info">
											1 x $17.00
										</span>
                                </div>
                            </li>
                        </ul>

                        <div class="header-cart-total">
                            Total: $75.00
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="index.php?action=cartDisplay"
                                   class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="index.php?action=checkout"
                                   class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Check Out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu">
        <nav class="side-menu">
            <ul class="main-menu">
                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Livraison gratuite dès 200.-
						</span>
                </li>

                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
                        <span class="topbar-email">
                            <?php if (isset($_SESSION['userEmailAddress'])) : ?>
                                <?= $_SESSION['userEmailAddress']; ?>
                            <?php endif; ?>
                    	</span>
                    </div>
                </li>

                <li class="item-topbar-mobile p-l-10">
                    <div class="topbar-social-mobile">
                        <a href="#" class="social-item fa fa-facebook"></a>
                        <a href="#" class="social-item fa fa-instagram"></a>
                        <a href="#" class="social-item fa fa-pinterest-p"></a>
                        <a href="#" class="social-item fa fa-snapchat-ghost"></a>
                        <a href="#" class="social-item fa fa-youtube-play"></a>
                    </div>
                </li>

                <li class="item-menu-mobile">
                    <a href="index.php">Accueil</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="index.php?action=displayArticles">Nos snows</a>
                </li>

                <?php if (!isset($_SESSION['userEmailAddress']) || (!isset($_GET['action'])) || ((@$_GET['action'] == "logout"))) : ?>
                    <li class="item-menu-mobile">
                        <a href="index.php?action=login">Login</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="index.php?action=register">S'enregistrer</a>
                    </li>
                <?php else : ?>
                    <li class="item-menu-mobile">
                        <a href="index.php?action=logout">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<?= $content; ?>


<!-- Footer -->
<footer class="p-t-45 p-b-43 p-l-45 p-r-45 footer">
    <div class="flex-w p-b-90">
        <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text12 p-b-30">
                BESOIN D'INFO ?
            </h4>

            <div>
                <p class="s-text7 w-size27">
                    <br>
                    Allez sur nos réseaux <br>ou appelez-nous au (+41) 79 856 84 05
                </p>

                <div class="flex-m p-t-30">
                    <a href="https://www.instagram.com/paleofestival/" target="_blank"
                       class="fs-18 color1 p-r-20 fa fa-instagram social-item"></a>
                    <a href="https://www.youtube.com/c/Pal%C3%A9oFestivalNyonSuisse/videos" target="_blank"
                       class="fs-18 color1 p-r-20 fa  fa-youtube-play social-item"></a>
                </div>
            </div>
        </div>


    </div>

</footer>


<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>


<!--===============================================================================================-->
<script type="text/javascript" src="view/content/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="view/content/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="view/content/vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="view/content/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="view/content/vendor/select2/select2.min.js"></script>
<script type="text/javascript" src="view/content/js/style.js">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="view/content/vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="view/content/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="view/content/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="view/content/vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="view/content/vendor/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.block2-btn-addcart').each(function () {
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function () {
            swal(nameProduct, "is added to cart !", "success");
        });
    });

    $('.block2-btn-addwishlist').each(function () {
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function () {
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });
</script>

<!--===============================================================================================-->
<script src="view/content/js/main.js"></script>

</body>
</html>
