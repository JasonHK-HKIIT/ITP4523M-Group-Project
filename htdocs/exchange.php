<?php

$exchange_rates = [
    "EUR" => 0.82,
    "HKD" => 7.8,
    "JPY" => 110,
];

header("Content-Type: application/json", true);

if (!extension_loaded("curl"))
{
    http_response_code(500);
    echo json_encode([ "result" => "rejected", "reason" => "cURL extension not loaded" ]);
    exit();
}

if (empty($_GET["amount"]))
{
    http_response_code(400);
    echo json_encode([ "result" => "rejected", "reason" => "amount is required" ]);
    exit();
}
else if (!is_numeric($_GET["amount"]))
{
    http_response_code(400);
    echo json_encode([ "result" => "rejected", "reason" => "amount must be a number" ]);
    exit();
}
else if (empty($_GET["currency"]))
{
    http_response_code(400);
    echo json_encode([ "result" => "rejected", "reason" => "currency is required" ]);
    exit();
}
else if (!array_key_exists($_GET["currency"], $exchange_rates))
{
    http_response_code(400);
    echo json_encode([ "result" => "rejected", "reason" => sprintf("currency must be one of: %s", implode(", ", array_keys($exchange_rates))) ]);
    exit();
}

$curl = curl_init(sprintf("http://%s:8080/cost_convert/%f/%s/%f", $_ENV["HOST_HOSTNAME"] ?? "127.0.0.1", $_GET["amount"], $_GET["currency"], $exchange_rates[$_GET["currency"]]));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
if (curl_errno($curl))
{
    http_response_code(500);
    echo json_encode([ "result" => "rejected", "reason" => curl_error($curl) ]);
    curl_close($curl);
    exit();
}
$response_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
curl_close($curl);

http_response_code($response_code);
echo $response;
