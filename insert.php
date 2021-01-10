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
//From here, handle the request as it is ok

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);

    //print_r($request);

    
    // Sanitize the post data from json request to PHP variable.
    
    $first_name = $request -> first_name;
    $middle_name = $request -> middle_name;
    $last_name = $request -> last_name;
    $mobile_no = $request -> mobile_no;
    $tel_no = $request -> tel_no;
    $address1 = $request -> address1;
    $address2 = $request -> address2;
    $employer_name = $request -> employer_name;
    $length_stay = $request -> length_stay;
    $birth_date = $request -> birth_date;
    $father_name = $request -> father_name;
    $mother_name = $request -> mother_name;
    $gender = $request -> gender;
    $civil_status = $request -> civil_status;
    $contact_person = $request -> contact_person;
    $relationship = $request -> relationship;
    $ec_address = $request -> ec_address;
    $ec_contact = $request -> ec_contact;
    $classification = $request -> classification;
    $is_complete = $request -> isComplete;

    // Store the post data.
    $sql = "INSERT INTO `brgy-id-application`(
        `first_name`,
        `middle_name`,
        `last_name`,
        `mobile_no`,
        `tel_no`,
        `address1`,
        `address2`,
        `employer_name`,
        `length_stay`,
        `birth_date`,
        `father_name`,
        `mother_name`,
        `gender`,
        `civil_status`,
        `contact_person`,
        `relationship`,
        `ec_address`,
        `ec_contact`,
        `classification`,
        `is_complete`
    ) VALUES (
        '{$first_name}',
        '{$middle_name}',
        '{$last_name}',
        '{$mobile_no}',
        '{$tel_no}',
        '{$address1}',
        '{$address2}',
        '{$employer_name}',
        '{$length_stay}',
        '{$birth_date}',
        '{$father_name}',
        '{$mother_name}',
        '{$gender}',
        '{$civil_status}',
        '{$contact_person}',
        '{$relationship}',
        '{$ec_address}',
        '{$ec_contact}',
        '{$classification}',
        '{$is_complete}'
    )";

    if(mysqli_query($con, $sql)){
        http_response_code(201);
    }else{
        http_response_code(422);
    }
}

?>