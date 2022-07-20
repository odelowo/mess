
<?php
/*
Used to manage all  integrations with the Klaviyo. Extends guzzlehttp
*/

require_once __DIR__.'/../../vendor/autoload.php';

class Klaviyo extends Client {

  private static $privateKey = 'pk_1128ba9f64907df9bee8a7a7f27d84e92c';
  private static $publicKey = 'TMezSb';

  public function triggerCustomerEmailVerificationEmail($email, $properties){
    $event = "Customer Email Verification";
    $data = '{"token": "'.$this->publicKey.'", "event": "'.$event.'", "customer_properties": {"$email": "'.$email.'"}, "properties": {';

    foreach ($properties as [$prop, $val]) {
      $data .= '"'.$prop.'":"'.$val.'",';
    }

    $data.='}}';

    $response = $client->request('POST', 'https://a.klaviyo.com/api/track', [
      'form_params' => [
        'data' => $data
      ],
      'headers' => [
        'Accept' => 'text/html',
        'Content-Type' => 'application/x-www-form-urlencoded',
      ],
    ]);
  }
}
//
// $client = new \GuzzleHttp\Client();
//
// $response = $client->request('POST', 'https://a.klaviyo.com/api/track', [
//   'form_params' => [
//     'data' => '{"token": "TMezSb", "event": "Customer Email Verification", "customer_properties": {"$email": "odelowo@live.co.uk"}, "properties": {"vericode": "XXXXXX","vericode_expiry": "YYYYYY", "vericodeURL":"URL"}}'
//   ],
//   'headers' => [
//     'Accept' => 'text/html',
//     'Content-Type' => 'application/x-www-form-urlencoded',
//   ],
// ]);
//
// echo $response->getBody();


?>