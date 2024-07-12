<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>C3 | Kiaalap - Kiaalap Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS ============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS ============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS ============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS ============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS ============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS ============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS ============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- educate icon CSS ============================================ -->
    <link rel="stylesheet" href="css/educate-custon-icon.css">
    <!-- morrisjs CSS ============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS ============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS ============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS ============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- Chart CSS ============================================ -->
    <link rel="stylesheet" href="css/c3/c3.min.css">
    <!-- style CSS ============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS ============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS ============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

    <div class="all-content-wrapper">

        <!-- custom chart start -->
        <div class="pie-bar-line-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" style="padding: 0;">
                        <div class="sparkline-list" style="width: 100%;">
                            <div class="smart-sparkline-hd" style="width: 100%;">
                                <div class="smart-main-spark-hd" style="width: 100%;">
                                    <h1><span class="c3-ds-n">Mama Wajawazito</span> Walihudhuria Kliniki Leo <span class="c3-ds-n"></span></h1>
                                </div>
                            </div>
                            <div class="smart-sparkline-list" style="width: 100%;">
                                <div id="lineChart" style="width: 100%; height: 250px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- custom chart end -->

        @include('layouts.linechart')
        @include('layouts.bar_graph')

    </div>


    <!-- jquery ============================================ -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS ============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- c3 JS ============================================ -->
    <script src="js/c3-charts/d3.min.js"></script>
    <script src="js/c3-charts/c3.min.js"></script>
    <script src="js/c3-charts/c3-active.js"></script>

</body>

</html>
