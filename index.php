<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Site Metas -->
<title>Appfast - Responsive OnePage HTML5 Template</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="resource/images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="resource/images/apple-touch-icon.png">

<!-- Site CSS -->
<link rel="stylesheet" href="resource/css/style.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="resource/css/bootstrap.min.css">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    .width100 {
        width: 100%;
    }
</style>
</head>
<body class="app_version" data-spy="scroll" data-target="#navbarApp" data-offset="98">

<!-- LOADER -->
<!-- <div id="preloader">
    <img class="preloader" src="../images/loaders/loader-app.gif" alt="">
</div> end loader -->
<!-- END LOADER -->
<div class="top-bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="left-soi">
                    <ul>
                        <li class="social-links"><a href="#"><i class="fa fa-apple"></i></a></li>
                        <li class="social-links"><a href="#"><i class="fa fa-android"></i></a></li>
                        <li class="social-links"><a href="#"><i class="fa fa-windows"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="right-btn">
                    <a href="#" class="btn-radius btn-brd">Get Support</a>
                </div>
            </div>
        </div>
    </div>
</div>
<header class="header header_style_01">
    <nav class="navbar header-nav navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="resource/images/logos/logo-app.png" alt="image"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarApp" aria-controls="navbarApp" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarApp">
                <ul class="navbar-nav">
                    <li><a class="nav-link active" href="#home">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div id="home" class="section lb">
    <div class="container">
        <div class="section-title text-center">
        </div><!-- end title -->

        <div class="row">
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane active fade show" id="tab1">
                        <div class="row text-center">
                            <div class="col-md-12">

                                <?php
                                if(isset($_GET["student"])) {
                                    include("app/student.php");
                                } else {
                                    include("app/create.php");
                                }
                                ?>

                            </div>
                        </div><!-- end row -->
                    </div><!-- end pane -->
                </div><!-- end content -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end section -->

<section class="section nopad cac text-center">
    <a href="#"><h3>Interesting our awesome web design services? Just drop an email to us and get quote for free!</h3></a>
</section>

<footer class="footer">
</footer><!-- end footer -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="resource/js/app.js"></script>
</body>
</html>