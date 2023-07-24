<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'gen_token.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/paypal/backend_php/check-paypal-order.php') 
{
    $data = json_decode(file_get_contents('php://input'), true);

    $base="https://api-m.sandbox.paypal.com";
    $url = $base."/v2/checkout/orders/".$data['orderID'];
    $token=token();
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer '.$token
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POST => false,
    ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error = curl_error($curl);
        echo ("error Exception:".$error."\n");
    }

    curl_close($curl);

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

?>