<?php
session_start();

// -----------------------------
// BOOTSTRAPING SLIM FRAMEWORK 
// -----------------------------

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require '../vendor/autoload.php';

require 'security.php';

require 'config.php';

require '../mobileapi/res.php';

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


// -----------------------test----route-------------------------------
$app->get('/hello[/{name}[/{title}]]', function ($request, $response, $args) {

    if (isset($args['name']) && isset($args['title'])) {
        $response->write("Hello " . $args['name'] . " " . $args['title']);
    } elseif (isset($args['name']) && !isset($args['title'])) {
        $response->write("Hello " . $args['name']);
    } else {
        $response->write("Error happend!");
    }

    return $response;
});
// -------------------------------------------------------------------


// -----------------------------
// ------ user login route -----
// -----------------------------

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
            $_SESSION["id"] = $code;
            return $response->withStatus(302)->withHeader('Location', '../public/pages/cdpo_landing_page.php');
        } else {
            return $response->withStatus(302)->withHeader('Location', '../public/pages/401.php');
        }
    } else {
        return $response->withStatus(302)->withHeader('Location', '../public/pages/401.php');
    }
});

// ---------------Get User fullname--------------

$app->get('/user/{id}', function ($reqeust, $response, $args) {
    $sql = "select fullname from user_master where userid = " . $args['id'] . ";";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    $db = null;
    return $response->withJson($data);
});

// ---------------Dashboard route----------------

$app->get('/dashboard/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getdashboarddata(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    $db = null;
    return $response->withJson($data);
});

// ---------------CDPO Efficiency route----------------

$app->get('/efficiency/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getefficiency(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    $db = null;
    return $response->withJson($data);
});

// ---------------visit frequency route----------------

$app->get('/visit/frequency/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getvisitfrequency(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    $db = null;
    return $response->withJson($data);
});


// ---------------own visit route----------------

$app->get('/visit/recent/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getownvisits(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    $db = null;
    return $response->withJson($data);
});

// ---------------SNP frequency route----------------

$app->get('/snp/frequency/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getsnpfrequency(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    $db = null;
    return $response->withJson($data);
});

// ----------------report routes-----------------------


$app->get('/reports/summary/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $exe = $this->db->query("call getCDPOSummery('".$args['fromdate']."','".$args['todate']."')");
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});


$app->get('/reports/subs/{id}', function ($reqeust, $response, $args) {
    $exe = $this->db->query("call getsubordinate(" . $args['id'] . ")");
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});


$app->get('/reports/visited/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getvisitedcentres(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/reports/openclose/{id}/{fromdate}/{todate}/{stat}', function ($reqeust, $response, $args) {
    $sql = "call getcentresopen(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "','" . $args['stat'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/reports/snacks/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getmorningsnacks(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/reports/pse/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getpse(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/reports/weighment/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getweighment(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/reports/malnourish/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getmalnourish(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/reports/notvisited/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getnotvisited(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/reports/snp/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getsnpreport(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

//-------setting table routes-------------------------

$app->get('/settings/blocks', function ($reqeust, $response, $args) {
    $sql = "SELECT blockid,block_name FROM block_master";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/settings/project/{bid}', function ($reqeust, $response, $args) {
    $sql = "SELECT project_id,project_name FROM project_master WHERE project_id IN (SELECT projectid FROM centre_master WHERE blockid='" . $args['bid'] . "');";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});


$app->get('/settings/table/{bid}/{pid}', function ($reqeust, $response, $args) {
    $sql = "
        SELECT
            ( SELECT block_master.block_name FROM block_master WHERE block_master.blockid = centre_master.blockid ) AS block_name,
            /*( SELECT gp_master.GP_name FROM gp_master WHERE gp_master.gpid = centre_master.gpid ) AS gp_name,*/
            ( SELECT project_master.project_name FROM project_master WHERE project_master.project_id = centre_master.projectid ) AS project_name,
            centre_master.sectorid,
            centre_master.centre_id,
            centre_master.centre_name,
            ( SELECT user_master.fullname FROM user_master WHERE user_master.userid = centre_master.supid ) AS supervisor,
            ( SELECT user_master.fullname FROM user_master WHERE user_master.userid = centre_master.cdpoid ) AS CDPO 
        FROM
            centre_master 
        WHERE
            centre_master.blockid = '" . $args['bid'] . "' 
            AND centre_master.projectid = '" . $args['pid'] . "'
    ";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

//--------------------Modal routes------------------------------//

$app->get('/modal/sector/{bid}', function ($reqeust, $response, $args) {
    $sql = "SELECT sectorid,sector_name FROM sector_master WHERE sector_master.sectorid IN (SELECT sectorid FROM centre_master WHERE blockid='" . $args['bid'] . "');";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/modal/supervisor/{bid}', function ($reqeust, $response, $args) {
    $sql = "SELECT userid,fullname FROM user_master WHERE userid IN (SELECT supid FROM centre_master WHERE blockid='" . $args['bid'] . "');";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/modal/gp/{bid}', function ($reqeust, $response, $args) {
    $sql = "select gp_master.gpid,gp_master.GP_name from gp_master where gp_master.gpid in (select centre_master.gpid from centre_master where centre_master.blockid = '" . $args['bid'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/modal/cdpo', function ($reqeust, $response, $args) {
    $sql = "SELECT user_master.userid,user_master.fullname FROM user_master WHERE user_master.designation='CDPO' order by user_master.fullname ";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/modal/supervisor', function ($reqeust, $response, $args) {
    $sql = "SELECT user_master.userid,user_master.fullname FROM user_master WHERE user_master.designation='Supervisor' order by user_master.fullname ";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->get('/modal/centrename/{cid}', function ($reqeust, $response, $args) {
    $sql = "select centre_master.centre_name from centre_master WHERE centre_master.centre_id = '" . $args['cid'] . "';";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

$app->post('/modal/update', function ($request, $response) {

    $allPostVars = $request->getParsedBody();
    //$sql = "UPDATE centre_master SET blockid='" . $allPostVars["bcode"] . "',projectid='" . $allPostVars["prjcode"] . "',sectorid='" . $allPostVars["seccode"] . "',supid=" . $allPostVars["supcode"] . ",cdpoid=" . $allPostVars["cdpocode"] . " WHERE centre_id='" . $allPostVars["centcode"] . "';";
    $stmt = $this->db->prepare("UPDATE centre_master SET blockid=?,projectid=?,sectorid=?,supid=?,cdpoid=? WHERE centre_id=?;");
    $stmt->bind_param("sssiis", $allPostVars["bcode"], $allPostVars["prjcode"], $allPostVars["seccode"], $allPostVars["supcode"], $allPostVars["cdpocode"], $allPostVars["centcode"]);
    if ($stmt->execute()) {
        $response = "updated";
    } else {
        $response = "not updated";
    }
    return $response;
});

//----------------------gallary route------------------------------//

$app->get('/gallary/{id}/{fromdate}/{todate}', function ($reqeust, $response, $args) {
    $sql = "call getGallary(" . $args['id'] . ",'" . $args['fromdate'] . "','" . $args['todate'] . "')";
    $exe = $this->db->query($sql);
    $data = $exe->fetch_all(MYSQLI_ASSOC);
    return $response->withJson($data);
});

//-----------------------------registration route-------------------------------//
$app->get('/otp/{mob}', function ($reqeust, $response, $args) {
    $mobile = $args['mob'];
    $sql = "";
    if (preg_match("/^\d{10}+$/", $mobile)) {
        $sql = "select count(userid) as u_count from user_master where mobile = '" . $mobile . "';";
        $exe = $this->db->query($sql);
        $data = $exe->fetch_all(MYSQLI_ASSOC);
        if ($data[0]['u_count'] == 1) {
            $ph_num = $mobile;
            $code = random_str(10, 'abcdefghijklmnopqrstuvwxyz');
            $sender = "MTICDS";
            $numbers = $ph_num;
            $message = $code . " is your One Time Password (OTP) for verification,please OTP to proceed MTMICDS,Jalpaiguri.";
            $message = urlencode($message);
            $data = "username=ICDSOTP&api_key=97bcdb2e220ef8819ab0399e39c725d9&sender=MTICDS&to=$numbers&message=$message";
            $ch = curl_init('http://msg.infoskysolutions.com/API/WebSMS/Http/v2.3.6/api.php?');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            if (substr_compare($result, "success", 0, 7, true) == 0) {
                $q = "update user_master set user_master.otp = '$code' where user_master.mobile = '$numbers';";
                if ($this->db->query($q)) {
                    $r = new ApiResponse("An OTP sent to you registered mobile number!");
                } else {
                    $r = new ApiResponse("Fatal error! Contact Admin...");
                }
            } else {
                $r = new ApiResponse("Can't send OTP to your mobile, please wait for sometimes.");
            }
            curl_close($ch);
        }
    } else {
        return $r = new ApiResponse("Should provide your registered mobile number!");
    }
    return $response->withJson($r);
});

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces [] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}


//------------------------Signup route---------------------------//

$app->post('/signup', function ($request, $response) {
    $directory = "../public/images/";
    $image = $_FILES['profpic']['name'];
    $filename = UploadedFileName();
    $target = $directory . $filename;
    if (move_uploaded_file($_FILES['profpic']['tmp_name'], $target)) {
        $data = $request->getParsedBody();
        $Sql = "UPDATE user_master 
                SET user_master.active = 'Yes',
                    prof_pic = '$filename'
                WHERE
                    user_master.otp = '" . $data['otp'] . "' 
                    AND user_master.mobile = '" . $data['mob'] . "' 
                    AND user_master.email = '" . $data['email'] . "' 
                    AND user_master.dob = '" . $data['dob'] . "';";
        if ($this->db->query($Sql)) {
            $r = new ApiResponse("Your account activated successfully!");
            return $response->withJson($r);
        } else {
            $r = new ApiResponse("Can't Activate, contact admin!");
            return $response->withJson($r);
        }
    } else {
        $r = new ApiResponse("Image may be more than 1.5 mb, please reduce the size!");
        return $response->withJson($r);
    }
});

function UploadedFileName()
{
    $extension = ".jpg";
    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $extension);
    return $filename;
}

$app->post('/forgot',function($request,$response){
    $data = $request->getParsedBody();
    $Sql = "UPDATE user_master 
                SET user_master.psw = '" . $data['psw'] . "'
                WHERE
                    user_master.otp = '" . $data['otp'] . "' 
                    AND user_master.mobile = '" . $data['mob'] . "' 
                    AND user_master.email = '" . $data['email'] . "' 
                    AND user_master.dob = '" . $data['dob'] . "';";
    if ($this->db->query($Sql)) {
        $r = new ApiResponse("Your password updated successfully!");
        return $response->withJson($r);
    } else {
        $r = new ApiResponse("Can't update password, contact admin!");
        return $response->withJson($r);
    }
});

//..................................................................//
//...................Weekly report remind through email.............//
//..................................................................//
$app->get('/send/mail',function($req, $res){
    //.......................................................................................
//    $sql_report="SELECT DATE_SUB(curdate(),INTERVAL 15 DAY) AS past_date,CURDATE() AS today,7 AS DAY,Count(visit_data.centre_open) AS centre_open,Count(visit_data.centreid) AS visit_centre,Sum(visit_data.benef_total) AS total_benfi_during_7_days,Sum(visit_data.benef_serve) AS tota_served_during_7_days,user_master.designation AS designation FROM user_master INNER JOIN visit_data ON user_master.userid=visit_data.userid WHERE visit_data.visit_date BETWEEN date_sub(CURDATE(),INTERVAL 15 DAY) AND CURDATE() AND user_master.designation='DPO'";
//    $stmt1=$this->db>query($sql_report);
//    while($row1=$stmt1->fetch_array(MYSQLI_ASSOC))
//    {
//        $d1=$row1['designation'];
//    }
    //........................................................................................

    $sql = "SELECT user_master.email FROM user_master WHERE user_master.designation='Supervisor' limit 2";
    $stmt = $this->db->query($sql);
    $row = $stmt->fetch_all(MYSQLI_ASSOC); //data store in assoc array
    $db = null;
    $data=array_column($row,'email');   //normal array


    $to=implode(",",$data);   //remove last comma
    // subject
    $subject = 'ICDS Weekly Report Reminder (NIC)';
    // message
    $d1='dpo';
    $message = '
<html>
<head>
  <title>MTMS Weekly Report</title>
</head>
<body>
  <p align="center"><b>Weekly report Details</b></p>
  <table align="center" cellspacing="15" frame="box">
    <tr frame="below">
      <th>Past_date</th><th>Today</th><th>Days</th><th>Centre Open</th><th>Visit Centre</th><th>Total Benfi..</th><th>Served</th><th>Designation</th>
    </tr>
    <tr>
      <td align="center">'.$d1.'</td><td align="center">2018-10-04</td><td align="center">7</td><td align="center">2</td><td align="center">2</td><td align="center">36</td><td align="center">33</td><td align="center">CDPO</td>
    </tr>
  </table>
</body>
</html>
';
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
    $headers .= 'From: ICDS Report Reminder <icds@example.com>' . "\r\n";
    $headers .= 'Cc: icdsachive@example.com' . "\r\n";
    $headers .= 'Bcc: icdscheck@example.com' . "\r\n";

    // Mail it
    if(mail($to, $subject, $message, $headers)){
        $msg=new ApiResponse("Email Send Successfull All Supervisors");
   }
    else{
        $msg=new ApiResponse("Email Send fail All Supervisors");
    }

        return $res->withJson($msg);
    });




$app->run();
?>

