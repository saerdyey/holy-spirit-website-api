<?php
require 'connect.php';


// Allow from any origin
if(isset($_SERVER["HTTP_ORIGIN"]))
{
    // You can decide if the origin in $_SERVER['HTTP_ORIGIN'] is something you want to allow, or as we do here, just allow all
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
}
else
{
    //No HTTP_ORIGIN set, so we allow any. You can disallow if needed here
    header("Access-Control-Allow-Origin: *");
}

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 600");    // cache for 10 minutes

if($_SERVER["REQUEST_METHOD"] == "OPTIONS")
{
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT"); //Make sure you remove those you do not want to support

    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    //Just exit with 200 OK with the above headers for OPTIONS method
    exit(0);
}

error_reporting(E_ERROR);
$brgyIdApplication = [];
$sql = "SELECT * FROM `brgy-id-application`";

if ($result = mysqli_query($con, $sql)){
    $cr = 0;
    while($row = mysqli_fetch_assoc($result)){
        $brgyIdApplication[$cr]['application_no'] = $row['application_no'];
        $brgyIdApplication[$cr]['first_name'] = $row['first_name'];
        $brgyIdApplication[$cr]['middle_name'] = $row['middle_name'];
        $brgyIdApplication[$cr]['last_name'] = $row['last_name'];
        $brgyIdApplication[$cr]['mobile_no'] = $row['mobile_no'];
        $brgyIdApplication[$cr]['tel_no'] = $row['tel_no'];
        $brgyIdApplication[$cr]['address1'] = $row['address1'];
        $brgyIdApplication[$cr]['address2'] = $row['address2'];
        $brgyIdApplication[$cr]['employer_name'] = $row['employer_name'];
        $brgyIdApplication[$cr]['length_stay'] = $row['length_stay'];
        $brgyIdApplication[$cr]['birth_date'] = $row['birth_date'];
        $brgyIdApplication[$cr]['father_name'] = $row['father_name'];
        $brgyIdApplication[$cr]['mother_name'] = $row['mother_name'];
        $brgyIdApplication[$cr]['gender'] = $row['gender'];
        $brgyIdApplication[$cr]['civil_status'] = $row['civil_status'];
        $brgyIdApplication[$cr]['contact_person'] = $row['contact_person'];
        $brgyIdApplication[$cr]['relationship'] = $row['relationship'];
        $brgyIdApplication[$cr]['ec_address'] = $row['ec_address'];
        $brgyIdApplication[$cr]['ec_contact'] = $row['ec_contact'];
        $brgyIdApplication[$cr]['classification'] = $row['classification'];
        $brgyIdApplication[$cr]['is_complete'] = $row['is_complete'];
        $cr++;
    }

    echo json_encode($brgyIdApplication);
}
else{
    http_response_code(404);
}
?>