<?php
die();
    $url = "https://www.pinnacloeducare.com/exam/cron/month-change";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
?>