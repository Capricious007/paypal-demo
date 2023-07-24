
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'gen_token.php';

// Create PayPal Order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/paypal/backend_php/create-paypal-order.php') {
    $order = createOrder();
    header('Content-Type: application/json');
    return json_encode($order);
    exit;
}

function createOrder() {
    $base="https://api-m.sandbox.paypal.com";
    $url = $base."/v2/checkout/orders";
    $token= token();
    $intent="CAPTURE";
    //$intent="AUTHORIZE";
    $data = array(
        'intent' => $intent,
        'purchase_units' => array(
            array(
                'items' => array(
                    array(
                        'name' => 'Laughing Buddha',
                        'description' => 'Golden Laughing Buddha',
                        'quantity' => '1',
                        'unit_amount' => array(
                            'currency_code' => 'USD',
                            'value' => '210.00'
                        )
                    )
                ),
                'amount' => array(
                    'currency_code' => 'USD',
                    'value' => '210.00',
                    'breakdown' => array(
                        'item_total' => array(
                            'currency_code' => 'USD',
                            'value' => '210.00'
                        )
                    )
                )
            )
        ),
        'application_context' => array(
            'return_url' => 'http://localhost:8888/pp/pp_index.html',
            'cancel_url' => 'https://example.com/cancel'
        )
    );
    
    $jsonData=json_encode($data);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: Bearer '.$token
        ],
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $jsonData
    ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error = curl_error($curl);
    }

    curl_close($curl);

    header('Content-Type: application/json');
    echo $response;
    exit();
}


// // Capture PayPal Order
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/paypal/backend_php/capture-paypal-order.php') 
// {
//     $data = json_decode(file_get_contents('php://input'), true);

//     $url = 'https://api.example.com/capture-order';
//     $headers = [
//         'Content-Type: application/json',
//     ];
//     $requestData = [
//         'orderID' => $data['orderID'],
//     ];

//     $curl = curl_init();
//     curl_setopt_array($curl, [
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_HTTPHEADER => $headers,
//         CURLOPT_POST => true,
//         CURLOPT_POSTFIELDS => json_encode($requestData),
//     ]);

//     $response = curl_exec($curl);

//     if (curl_errno($curl)) {
//         $error = curl_error($curl);
        
//     }

//     curl_close($curl);

//     header('Content-Type: application/json');
//     echo json_encode($orderData);
//     exit;
// }

// Handle other routes or return error response
// http_response_code(404);
// echo 'Not Found';
?>