<?php
header("Access-Control-Allow-Origin:http://localhost:4200");
header("Access-Control-Allow-Headers:content-type");
header("Access-Control-Allow-Credentials:true");

$servername = "localhost";
$username = "no18222p_root";
$password = "cashless@2020";

extract($_POST);

try
{
    $conn = new PDO("mysql:host=$servername;dbname=no18222p_pinnacle", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $batchId = 17;

    if ($recipient == "Student")
    {
        $sql = "SELECT GROUP_CONCAT(phone) phones FROM erp_students where batchId = $batchId";
    }
    elseif ($recipient == "Parent")
    {
        $sql = "SELECT GROUP_CONCAT(fmobile) phones FROM `erp_students where batchId = $batchId";
    }
    else
    {
        $sql = "SELECT GROUP_CONCAT(phone,',',fmobile) phones FROM erp_students where batchId=$batchId";
    }

    $result = $conn->query($sql, PDO::FETCH_ASSOC);

    $numbers = $result->fetch();

    $mobiles = "";
    $pattern = "/^[0-9]{10,10}$/i";
    foreach (explode(",", $numbers["phones"]) as $number)
    {
        if (preg_match($pattern, $number))
        {
            $mobiles .= $number . ",";
        }
    }

    $mobiles = rtrim($mobiles, ",");
    sendSMS($mobiles, $message);

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;

function sendSMS($mobiles, $message)
{
    $mobile = $mobiles;
    $msg = urlencode($message);

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
}

?>
