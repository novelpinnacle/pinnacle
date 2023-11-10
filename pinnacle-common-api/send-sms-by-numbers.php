<?php
header("Access-Control-Allow-Origin:http://localhost:4200");
header("Access-Control-Allow-Headers:content-type");
header("Access-Control-Allow-Credentials:true");

$mobile = $_POST["numbers"];
$msg = urlencode($_POST["message"]);

$url = "http://pro.eglsms.in/app/smsapi/index.php?key=25E3C2685481C8&campaign=0&routeid=2&type=text&contacts=$mobile&senderid=SMSDTL&msg=$msg";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$api_status = "";
if (strpos($response, "SMS-SHOOT-ID") !== false)
{
    $api_status = explode("/", $response) [0];
}
else
{
    $api_status = $response;
}
if ($api_status == "SMS-SHOOT-ID")
{
    echo json_encode(["message" => "SMS Sent Successfully", "success" => true]);
}
else
{
    echo json_encode(["message" => $api_status, "success" => false]);
}
?>
