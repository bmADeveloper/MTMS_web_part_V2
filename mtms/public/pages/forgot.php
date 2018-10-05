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
    <title> MTMS(ICDS)v2.0 </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>

    <style type="text/css" media="screen">
        body {
            background-color: #e6eaff;
            line-height: 1.0;
        }
    </style>
</head>
<body>
<section class="hero is-fullheight">
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-8 is-offset-2 box">
                    <div class="level">
                        <div class="level-item  has-text-centered">
                            <p class="is-capitalized has-text-weight-bold is-size-4">
                                Reset Password
                            </p>
                        </div>
                    </div>
                    <form id="forgotForm" action="" method="post" enctype="multipart/form-data">
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Email</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded has-icons-left">
                                        <input name="email" class="input" type="email" placeholder="Email">
                                        <span class="icon is-small is-left">
						          <i class="fas fa-envelope"></i>
						        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label"></div>
                            <div class="field-body">
                                <div class="field is-expanded">
                                    <div class="field has-addons">
                                        <p class="control">
                                            <a class="button is-static">
                                                +91
                                            </a>
                                        </p>
                                        <p class="control is-expanded">
                                            <input id="mob" name="mob" class="input" type="tel"
                                                   placeholder="Your mobile number">
                                        </p>
                                    </div>
                                    <p class="help">Do not enter the first zero</p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Date of Birth</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded has-icons-left">
                                        <input class="input" type="date" name="dob">
                                        <span class="icon is-small is-left">
						          <i class="fas fa-calendar-alt"></i>
						        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">New Password</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded has-icons-left">
                                        <input class="input" type="password" name="psw">
                                        <span class="icon is-small is-left">
						          <i class="fas fa-key"></i>
						        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Retype Password</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <p class="control is-expanded has-icons-left">
                                        <input class="input" type="password">
                                        <span class="icon is-small is-left">
						          <i class="fas fa-key"></i>
						        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label">Get OTP</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <div class="field has-addons">
                                            <div class="control">
                                                <input name="otp" class="input" type="text"
                                                       placeholder="Find a repository">
                                            </div>
                                            <div class="control">
                                                <button class="button is-success" id="btnGetOtp">
                                                    Get OTP
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field is-horizontal">
                            <div class="field-label">
                                <!-- Left empty for spacing -->
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <button class="button is-block is-info is-large is-fullwidth" type="submit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
    </div>
</section>

<script src="../js/forgot.js" type="text/javascript" charset="utf-8" async defer></script>
</body>