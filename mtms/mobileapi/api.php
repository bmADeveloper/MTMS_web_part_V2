<?php
/**
 * Created by PhpStorm.
 * User: dgdev
 * Date: 16-07-2018
 * Time: 08:33 PM
 */

require '../vendor/autoload.php';

require '../api/security.php';

require 'res.php';

require 'config.php';

$app = new \Slim\App(["settings" => $config]);


$container = $app->getContainer();
$container['db'] = function ($container) {
    try {
        $db = $container['settings']['db'];
        $con = @mysqli_connect($db['servername'], $db['username'], $db['password'], $db['dbname']);
        return $con;
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
};


/*-----------------------------*/
/*------ user login route -----*/
/*-----------------------------*/

$app->post('/login', function ($reqeust, $response, $args) {
    $xss = new security();
    $code = 0;
    $data = array('status' => 'error', 'res_msg' => 'Improper email id or Password...');

    if ($xss->check_email($_POST['email']) && $xss->check_password($_POST['psw'])) {
        $stmt = $this->db->prepare("SELECT user_master.userid FROM user_master WHERE user_master.email=? AND user_master.psw=?");
        $stmt->bind_param("ss", $_POST['email'], $_POST['psw']);
        $stmt->execute();
        $stmt->bind_result($code);
        $stmt->fetch();
        $stmt->close();
        if ($code >= 1) {
            $data = array('status' => 'success', 'res_msg' => $code);
            $_SESSION["id"] = $code;
        } else {
            $data = array('status' => 'failure', 'res_msg' => 'Wrong credentials...');
        }
    }
    return $response->withJson($data);

});


/*---------------User wise centre detail list----------------*/
$app->get('/centrelist', function ($reqeust, $response) {
    $sql = "call getcentrelist(" . $_GET['uid'] . ")";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    $db = null;
    return $response->withJson($data);
});

//------------ receive data from mobile client---------------

$app->post('/uploadvisit', function ($request, $response) {
    $directory = "../public/visitimages/";
    $image = $_FILES['visit_pic']['name'];
    $filename = UploadedFileName();
    $target = $directory . $filename;
    if (move_uploaded_file($_FILES['visit_pic']['tmp_name'], $target)) {
        $Sql = "call save_data($_POST[userid], '$_POST[centreid]', '$_POST[visit_date]', $_POST[visit_lat], $_POST[visit_long], '$filename', '$_POST[own_building]', '$_POST[centre_open]', $_POST[benef_total], $_POST[benef_serve], $_POST[chld_7m_6y_tot], $_POST[chld_7m_6y_Mor_Snacks], $_POST[chld_3y_6y_tot], $_POST[chld_3y_6y_PSE], $_POST[chld_blw_5y_tot], $_POST[chld_blw_5y_weighted], $_POST[chld_blw_5y_mal_mod], $_POST[chld_blw_5y_mal_severe], $_POST[mother_meet], $_POST[register_found], '$_POST[ecce_followed]');";
        if ($this->db->query($Sql)) {
            $r = new ApiResponse("Data posted successfully!");
            return $response->withJson($r);
        } else {
            //$r = new ApiResponse($Sql);
            return $response->withJson("Can't upload record!");
        }
    } else {
        $r = new ApiResponse("Can't upload record!");
        return $response->withJson($r);
    }
});

$app->post('/uploadtest', function ($request, $response) {
    $directory = "../public/visitimages/";
    $image = $_FILES['visit_pic']['name'];
    $filename = UploadedFileName();
    $target = $directory . $filename;
    if (move_uploaded_file($_FILES['visit_pic']['tmp_name'], $target)) {
        $Sql = "INSERT INTO visit_data (userid, centreid, visit_pic) VALUES($_POST[userid], '$_POST[centreid]', '$filename');";
        if ($this->db->query($Sql)) {
            $r = new ApiResponse("Success");
            return $response->withJson($r);
        } else {
            $r = new ApiResponse("Upload not Done!");
            return $response->withJson($r);
        }
    } else {
        $r = new ApiResponse("Failed");
        return $response->withJson($r);
    }
});


function UploadedFileName()
{
    $directory = "../public/visitimages/";
    $extension = ".jpg";
    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $extension);
    return $filename;
}

// ---------------User Efficiency route----------------

$app->post('/efficiency', function ($reqeust, $response) {
    $sql = "call getefficiency(" . $_POST['id'] . ",'" . $_POST['fromdate'] . "','" . $_POST['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    $db = null;
    return $response->withJson($data[0]);
});


$app->run();