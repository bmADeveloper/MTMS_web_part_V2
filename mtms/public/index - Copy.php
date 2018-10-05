<?php
/**
 * User: dgdev
 * Date: 07-07-2018
 * Time: 12:10 AM
 */
session_start();
session_unset();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MTMS(ICDS)v2.0</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <link href="/node_modules/fotorama.css" rel="stylesheet">
    <script src="/node_modules/fotorama.js"></script>

</head>
<body>
<!--is the navbar section-->
<section class="hero" style="background-color: #1766A6">
    <div class="navbar">
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
                <a href="#" class="navbar-item" style="color: #f0edee">Home</a>
                <a href="#" class="navbar-item" style="color: #f0edee">Guidlines</a>
                <a href="#" class="navbar-item" style="color: #f0edee">Notice</a>
                <a href="#" class="navbar-item" style="color: #f0edee">Contacts</a>
            </div>
        </div>
    </div>
    </div>

</section>

<!--this is body section-->
<section class="hero" style="margin-top: 25px;">
    <!--this the notice scroll section-->
    <div class="hero-head">
        <div class="columns is-mobile">
            <div class="column is-mobile"></div>
            <div class="column is-1-desktop is-3-mobile">
               <a href="/" style="alignment: center"> <img src="images/wb_govt_logo.png" class="image is-96x96  "/></a>
            </div>
            <div class="column is-mobile"></div>
        </div>
        <div class="columns is-desktop">
            <div class="column is-12-desktop">
                <h1 class="title" style="text-align: center; color: #1766A6;">Mobile based Tracking & Monitoring System for ICDS</h1>
                <h1 class="subtitle" style="text-align: center;">Ver. 2.0</h1>
            </div>
        </div>
    </div>
    <div class="hero-body">
        <div class="container">
            <div class="columns is-desktop">
                <div class="column is-1"></div>
                <div class="column is-5">
                    <!--Image scroll widget-->
                    <div class="box">
                        <div class="fotorama" data-autoplay="true" data-fit="scaledown">
                            <img src="images/cor-img-1.jpg" class="image is-3by2"/>
                            <img src="images/cor-img-2.jpg" class="image is-3by2"/>
                            <img src="images/cor-img-3.jpg" class="image is-3by2"/>
                        </div>
                    </div>
                </div>
                <div class="column is-1"></div>
                <div class="column is-4">
                    <!--Login widget-->
                    <div class="box">
                        <div class="card">
                            <div class="card-header" style="background-color: #1766A6">
                                <p class="card-header-title" style="color: #f0edee">Login</p>
                            </div>
                            <div class="card-content">
                                <div class="field">
                                    <label class="label">Email</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input is-info" type="email"
                                               placeholder="abc@example.com" id="user_name"/>
                                        <span class="icon is-small is-left">
                                      <i class="fas fa-envelope"></i>
                                    </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Password</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input is-info" type="password"
                                               placeholder="type password..." id="user_password"/>
                                        <span class="icon is-small is-left">
                                      <i class="fas fa-lock"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <a href="#" class="card-footer-item" id="lnkSubmit">Submit</a>
                                <a href="#" class="card-footer-item" id="lnkCancel">Cancel</a>
                            </footer>
                        </div>
                        <div class="box">
                            <a href="#">Forgot password?</a> / <a href="#">Register Yourself.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer" id="navigation_bar">
    <div class="content has-text-centered">
        <img src="images/nic_logo.png"/>
    </div>
</footer>

<script language="JavaScript">
    $(document).ready(function () {
        $("#lnkSubmit").click(function () {
            var formData = {
                'email': $('input#user_name').val(),
                'psw': $('input#user_password').val()
            };
            $.ajax({
                type: 'POST',
                url: '/api/login',
                data: formData,
                datatype: 'json',
                encode: true
            }).done(function (data) {
                if (data['status'] == 'success') {
                    window.location.href = data['res_msg'];
                }
            });
        });


        $("#lnkCancel").click(function () {
            $("#user_name").val('');
            $("#user_password").val('');
        });

    });
</script>
</body>
</html>