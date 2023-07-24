<?php
function token(){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=client_credentials&ignoreCache=true&return_authn_schemes=true&return_client_metadata=true&return_unconsented_scopes=true',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Basic QWZGQURwMVNZWFlYZ1I2V1ZNTWZ4WUtjbXNNZEhOY1Y0Y2c4d3pTUEZIaFRCOXI2SGNPZTJnY2JGT0J6ejVGQWQ0VllRTC1tc0p1ZWpSUVk6RUVKVWdIdmpFZWpCU0l5djZMOGJxQXZ4cm9ERldiOGp2bEFEb3Z1VDRnUlhaWnJnbU1MRTBpamI1cnpnZHlQdG5fOGpGYUhyc0lRdmJIbC0='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$data=json_decode($response, true);
$token=$data['access_token'];
//echo $token;
return $token;
}
?>