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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
</head>
<body>
<!--this is body section-->
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
                <a href="#" class="navbar-burger" data-target="navMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <a/>
            </div>
            <div class="navbar-menu">
                <div class="navbar-end">
                    <a href="#" class="navbar-item" style="color: #f0edee">Home</a>
                    <a href="guidlines.php" class="navbar-item" style="color: #f0edee">Guidlines</a>
                    <a href="#" class="navbar-item" style="color: #f0edee">Contacts</a>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <img src="images/icds_logo.png"/>
                </div>
                <div class="column is-10-desktop">
                    <h1 class="title" style="text-align: center; color: #1766A6;">Mobile based Tracking & Monitoring System</h1>
                    <h1 class="title" style="text-align: center; color: #1766A6;">ICDS, Jalpaiguri</h1>
                    <h1 class="subtitle" style="text-align: center;">Ver. 2.0</h1>
                </div>
                <div class="column">
                    <img src="images/wb_logo.png"/>
                </div>
            </div>
            <div class="columns is-desktop">
                <div class="column is-1"></div>
                <div class="column is-5">
                    <!--Image scroll widget-->
                    <div class="fotorama" data-autoplay="true" data-fit="scaledown">
                        <img src="images/1.jpg" class="image is-3by2"/>
                        <!-- <img src="images/2.jpg" class="image is-3by2"/> -->
                        <img src="images/3.jpg" class="image is-3by2"/>
                        <!-- <img src="images/4.jpg" class="image is-3by2"/> -->
                        <!-- <img src="images/5.jpg" class="image is-3by2"/> -->
                        <!-- <img src="images/6.jpg" class="image is-3by2"/> -->
                        <img src="images/7.jpg" class="image is-3by2"/>
                    </div>

                </div>
                <div class="column is-1"></div>
                <div class="column is-4">
                    <div style="background-color: #1766A6">
                        <p class="card-header-title" style="color: #f0edee">Login</p>
                    </div>

                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input is-info" type="email"
                                   placeholder="abc@example.com" id="user_name"/>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <span class="icon is-small is-right">
                                    </span>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Password</label>
                        <div class="control has-icons-left has-icons-right">
                            <input class="input is-info" type="password"
                                   placeholder="type password..." id="user_password"/>
                                   <span class="icon is-small is-left">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <span class="icon is-small is-right">
                                    </span>
                        </div>
                    </div>
                    <div class="buttons is-pulled-right">
                        <a href="#" class="button is-primary" id="lnkSubmit">Submit</a>
                        <a href="#" class="button is-danger" id="lnkCancel">Cancel</a>
                    </div>
                    <!--                    <div class="has-text-centered">-->
                    <!--                        <a href="#">Forgot password?</a> / <a href="#">Register Yourself.</a>-->
                    <!--                    </div>-->

                </div>
            </div>
            <div class="columns">
            <div class="column is-offset-10">
                <a> Designed & Developed by <img src="images/nic_logo.png" width="80%"/></a>
            </div>
        </div>
        </div>
    </div>
    <div class="hero-foot">
        

    </div>
</section>

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
                }else{
                    alert(data['status']+" : "+data['res_msg']);
                }
            });
        });


        $("#lnkCancel").click(function () {
            $("#user_name").val('');
            $("#user_password").val('');
        });

        $(".navbar-burger").click(function () {
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");
        });

    });
</script>
</body>
</html>