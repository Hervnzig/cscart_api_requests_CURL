<?php
// set post fields
$mydata = [
    // INput your json array
];


$returned_order = array();
$ch = curl_init();
$results = getOrderCreated($ch, $mydata);
var_dump($results);
function getOrderCreated(&$ch, $data_to_send)
{
    for ($i = 0; $i < sizeof($data_to_send); $i++) {
        makeOrder($ch, $data_to_send[$i]);
    }
    return $GLOBALS['returned_order'];
}
curl_close($ch);

function makeOrder(&$ch, $post)
{
    try {
        $data = [
            "user_id" => "4",
            "shipping_id" => "1",
            "payment_id" => "11",
            "timestamp" => $post['timestamp'],
            "products" => $post['product']
        ];
        if ($ch == null) {
            $ch = curl_init();
        }
        curl_setopt($ch, CURLOPT_URL, "http://localhost/cscart/api/stores/1/orders/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept:application/json', 'Authorization:     '));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, true));
        // execute!
        $response = curl_exec($ch);
        $data = json_decode($response);
        $dump = var_dump($data);
        echo $dump;
    } catch (Exception $e) {
        error_log($e . getMessage());
    }
}
