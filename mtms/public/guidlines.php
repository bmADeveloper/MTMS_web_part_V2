<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MTMS(ICDS)v2.0</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.js"></script>

</head>
<body>
<section class="hero is-fullheight" style="background-color: #e6eaff">
    <div class="hero-head">
        <div class="navbar" style="background-color: #1766A6">
            <div class="navbar-brand">
                <a href="#" class="navbar-item">
                    <a href="#" class="navbar-item" style="color: #f0edee;text-effect: emboss;">
                        <img src="images/icds_logo.png" class="is-128x128" style="filter: invert(100%)"/>
                        &nbsp;&nbsp;&nbsp; MTMS(ICDS)v2.0
                    </a>
                </a>
                <a href="#" class="navbar-burger">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <a/>
            </div>
            <div class="navbar-menu">
                <div class="navbar-end">
                    <a href="index.php" class="navbar-item" style="color: #f0edee">Home</a>
                    <a href="#" class="navbar-item" style="color: #f0edee">Guidlines</a>
                    <a href="#" class="navbar-item" style="color: #f0edee">Contacts</a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column"></div>
                <div class="column">
                    <p class="subtitle"><a href="downloads/mtms.apk">Please Click to download the app...</a></p>
                </div>
                <div class="column"></div>
            </div>
            <div class="columns">
                <div class="column is-1-desktop is-1-mobile"></div>
                <div class="column is-10-desktop is-10-mobile">
                    <div class="fotorama" data-autoplay="true" data-width="100%" data-ratio="1920/1080">
                        <img src="images/Mobile%20based%20Tracking-1.png"/>
                        <img src="images/Mobile%20based%20Tracking-2.png"/>
                        <img src="images/Mobile%20based%20Tracking-3.png"/>
                        <img src="images/Mobile%20based%20Tracking-4.png"/>
                        <img src="images/Mobile%20based%20Tracking-5.png"/>
                        <img src="images/Mobile%20based%20Tracking-6.png"/>
                        <img src="images/Mobile%20based%20Tracking-7.png"/>
                        <img src="images/Mobile%20based%20Tracking-8.png"/>
                        <img src="images/Mobile%20based%20Tracking-9.png"/>

                    </div>
                </div>
                <div class="column"></div>
            </div>
        </div>
    </div>
</section>


<script language="JavaScript">
    $(document).ready(function () {
        $(".navbar-burger").click(function() {

      // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
              $(".navbar-burger").toggleClass("is-active");
              $(".navbar-menu").toggleClass("is-active");

          });

    });
</script>
</body>
</html>