<?php
/**
 * Created by PhpStorm.
 * User: dgdev
 * Date: 09-07-2018
 * Time: 07:21 PM
 */

class security
{
    function check_email($agrs01)
    {
        /*
         * Below mentioned regular expression is matching the email with following rules.
         * (1) address must contains @ character.
         * (2) email address allowed the have . - _ as special character in the id.
         * (3) 2 to 5 characters are allowed after the 'dot' in the email id.
        */
        $retval = preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $agrs01);
        return $retval;
    }

    function check_password($agrs01)
    {
        /*
         * Below mentioned regular expression is matching the password with following rules.
         * (1) Password must starts with Capital letter A to Z.
         * (2) Password should be minimum of 8 char length.
         * (3) only !@#$%^&~  are allowed as special character in the password.
        */
        $retval = preg_match("/^[A-Z]+[a-zA-Z0-9!@#$%^&~]{8,}/", $agrs01);
        return $retval;
    }

    function protect_page()
    {
        /*
         * this function is for redirecting to home page, if user is yet to start
         * session with successful login.
        */
        if (!isset($_SESSION['id'])) {
            session_unset();
            session_destroy();
            header("Location:../", true, 301);

        }
    }

    function session_expired()
    {
        /*
         * this function is responsible to check if user's session has
         * expired after long inactivity.
         */
        $expireAfter = 30;
        if (isset($_SESSION['last_action'])) {
            $secondsInactive = time() - $_SESSION['last_action'];
            $expireAfterSeconds = $expireAfter * 60;
            if ($secondsInactive >= $expireAfterSeconds) {
                session_unset();
                session_destroy();
                header("Location:../", true, 301);
            }
        }
        $_SESSION['last_action'] = time();
    }

}